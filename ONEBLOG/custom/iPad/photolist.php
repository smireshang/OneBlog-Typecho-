<?php
// 获取主题后台填写的 Unsplash API Key
$accessKey = $this->options->Unsplash_API;

if (!$accessKey) {
    die('Unsplash API Key 未设置');
}

if (isset($_GET['sync']) && $_GET['sync'] == '1') {
    // 获取主题后台填写的 Unsplash 用户名
    $username = $this->options->Unsplash_User;
    
    // 设置分页变量
    $page = 1;
    $perPage = 30; // 每页请求的照片数量
    $allPhotos = [];
    $hasMorePhotos = true;

    while ($hasMorePhotos) {
        $url = "https://api.unsplash.com/users/$username/photos?client_id=$accessKey&per_page=$perPage&page=$page";
        $response = @file_get_contents($url);

        if ($response === FALSE) {
            echo '请求超时，这可能是短时间内同步太多次导致的，建议稍等片刻、清除浏览器缓存后再试。';
            break;
        } else {
            $photos = json_decode($response, true);
            
            if ($photos === null || empty($photos)) {
                $hasMorePhotos = false;
            } else {
                $allPhotos = array_merge($allPhotos, $photos);
                $page++;
            }
        }
    }
    
    if (empty($allPhotos)) {
        echo '暂无需要同步的照片。';
    } else {
        // 指定分类ID
        $categoryId = $this->options->Unsplash_Cat; // 替换为你的摄影作品分类ID

        // 作者信息
        $authorId = 1; // 替换为文章默认作者的 uid
        $updated = [];
        $added = [];
        $latest = true;

        // 发布到 Typecho
        foreach ($allPhotos as $photo) {
            $title = $photo['description'] ?: '图片';
            $imageId = $photo['id'];
            $imageUrl = $photo['urls']['full'];
            $thumbnailUrl = $photo['urls']['thumb']; // 获取缩略图 URL
            $authorName = isset($photo['user']['name']) ? $photo['user']['name'] : 'Unknown'; // 获取作者昵称
            $authorUsername = isset($photo['user']['username']) ? $photo['user']['username'] : 'Unknown'; // 获取作者用户名 ID

            // 自定义字段
            $fields = [
                'photo' => $imageUrl,
                'thumb' => $thumbnailUrl, // 添加缩略图字段
                'Unsplash_ID' => $imageId,   // 添加图片ID字段
                'author' => $authorName,   // 添加作者昵称字段
                'Unsplash_UserID' => $authorUsername,   // 添加作者用户名 ID 字段
            ];

            // 文章内容默认为空
            $content = '';

            // 检查是否已存在相同图片ID且未被删除的文章
            $query = $this->db->select()->from('table.contents')
                        ->join('table.fields', 'table.contents.cid = table.fields.cid')
                        ->where('table.fields.name = ?', 'Unsplash_ID')
                        ->where('table.fields.str_value = ?', $imageId)
                        ->where('table.contents.status = ?', 'publish');

            $existingPost = $this->db->fetchRow($query);

            if ($existingPost) {
                // 检查并更新标题、作者昵称和作者用户名 ID
                $updateFields = [];
                if ($existingPost['title'] !== $title) {
                    $updateFields['title'] = $title;
                    $latest = false;
                }
                
                // 更新自定义字段
                foreach ($fields as $name => $value) {
                    $existingField = $this->db->fetchRow($this->db->select()->from('table.fields')
                        ->where('cid = ?', $existingPost['cid'])
                        ->where('name = ?', $name));

                    if ($existingField['str_value'] !== $value) {
                        $this->db->query($this->db->update('table.fields')->rows([
                            'str_value' => $value
                        ])->where('cid = ?', $existingPost['cid'])->where('name = ?', $name));
                        $latest = false;
                    }
                }

                if (!empty($updateFields)) {
                    $this->db->query($this->db->update('table.contents')->rows(array_merge($updateFields, [
                        'modified' => time()
                    ]))->where('cid = ?', $existingPost['cid']));
                    $updated[] = '【'.$title.'】';
                }
            } else {
                // 插入新文章数据
                $this->db->query($this->db->insert('table.contents')->rows([
                    'title' => $title,
                    'text' => $content,
                    'authorId' => $authorId,
                    'type' => 'post',
                    'status' => 'publish',
                    'created' => time(),
                    'modified' => time(),
                    'allowComment' => 1,
                    'allowPing' => 1,
                    'allowFeed' => 1
                ]));

                // 获取插入文章的ID
                $postId = $this->db->fetchRow($this->db->select('MAX(cid) AS cid')->from('table.contents'))['cid'];

                // 更新 slug 字段为文章的 cid
                $this->db->query($this->db->update('table.contents')->rows([
                    'slug' => $postId
                ])->where('cid = ?', $postId));

                // 插入自定义字段
                foreach ($fields as $name => $value) {
                    $this->db->query($this->db->insert('table.fields')->rows([
                        'cid' => $postId,
                        'name' => $name,
                        'type' => 'str',
                        'str_value' => $value
                    ]));
                }

                // 将文章关联到指定分类
                $this->db->query($this->db->insert('table.relationships')->rows([
                    'cid' => $postId,
                    'mid' => $categoryId
                ]));

                // 更新分类的计数器
                $this->db->query('UPDATE ' . $this->db->getPrefix() . 'metas SET count = count + 1 WHERE mid = ' . $categoryId);

                $added[] = '【'.$title.'】';
                $latest = false;
            }
        }

        if ($latest) {
            echo '当前摄影作品已同步到最新。';
        } else {
            $messages = [];
            if (!empty($updated)) {
                $messages[] = implode('', $updated) . ' 等作品信息已更新。<br>';
            }
            if (!empty($added)) {
                $messages[] = implode('', $added) . ' 等作品已成功同步。';
            }
            if (empty($messages)) {
                $messages[] = '当前摄影作品已同步到最新。';
            } else {
                $messages[] = '当前，所有摄影作品已是最新。';
            }
            echo implode('', $messages);
        }
    }
    exit;
}

if (isset($_GET['refresh']) && $_GET['refresh'] == '1') {
    // 生成新的相册内容
    ob_start();
    ?>
    <?php while($this->next()): ?>
    <div class="grid image-shadow blur">
        <div class="grid-item">
            <a data-fancybox="gallery" data-caption="<?php $this->title();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?>"  href="<?php $this->fields->photo();?>">
                <img src="<?php $this->fields->thumb();?>" />
            </a>
        </div>
    </div>
    <?php endwhile; ?>
    <?php
    $newPhotos = ob_get_clean();
    echo $newPhotos;
    exit;
}
?>








<div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'];?>')">
    <a class="logo" href="/">
        <img src="<?php $this->options->logo();?>">
        <div class="slogan">
            <h1><?php $this->options->title();?></h1> 
            <span><?php $this->options->slogan();?></span>
        </div>
    </a>
</div>

<style>

</style>
<!-- 网站顶栏需要重新设计 -->
<div class="main">
    <div class="content page">    
        <div class="page_title">
            <h2>个人相册</h2>
            <button id="updateBtn">
                <i class="iconfont icon-update"></i>同步照片
            </button>
        </div>
        
        <div id="photos">
            <?php while($this->next()): ?>
            <div class="grid image-shadow blur">
                <div class="grid-item">
                    <a data-fancybox="gallery" data-caption="<?php $this->title();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?>"  href="<?php $this->fields->photo();?>">
                        <img src="<?php $this->fields->thumb();?>" />
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="preload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
</div>
