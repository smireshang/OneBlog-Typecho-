<?php $this->need('custom/PC/header.php');?>

<div class="header_index"><!--网站顶栏-->
    <div class="index_logo">
        <h1><?php $this->options->title();?><span class="soul">生活志</span></h1>
        <div class="one">"&nbsp;<?php $quotes_file = __DIR__ . '/quotes.txt';$quotes = file($quotes_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);$random_quote = $quotes[array_rand($quotes)];echo $random_quote;?>"</div>
    </div>
    
<?php
// 获取banner开关状态
$switch = $this->options->switch;
if ($switch == 'on') {
    $lunbo = $this->options->Banner ?? '';
    $banner = explode(",", $lunbo, 3); 
    $n = count($banner);
    $link = array();
    $title = array();
    $thumbnails = array(); 
    for ($i = 0; $i < $n; $i++) {
        $cid = $banner[$i]; 
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select()
            ->from('table.contents')
            ->where('cid = ?', $cid)
            ->where('type = ?', 'post')
            ->limit(1));
        if ($row) {
            $post = Typecho_Widget::widget('Widget_Abstract_Contents');
            $post->push($row);
            $link[$i] = $post->permalink;
            $title[$i] = $post->title;
            ob_start(); 
            showThumbnail($post);
            $thumbnails[$i] = ob_get_clean(); 
        }
    }
?>

<div class="banner_banner"><!--顶部的封面图文章-->
    <div class="banner_left">
        <a href="<?php echo $link[0] ?? 'https://oneblog.me'; ?>" title="<?php echo $title[0] ?? 'ONEBLOG主题'; ?>">
            <div class="banner_post_thumb" style="background-image:url('<?php echo $thumbnails[0] ?? ''; ?>')">
                <div class="banner_title_cat"><h1><?php echo $title[0] ?? '请填写文章cid'; ?></h1></div>
            </div>
        </a>
    </div>
    <div class="banner_right">
        <a href="<?php echo $link[1] ?? 'https://oneblog.me'; ?>" title="<?php echo $title[1] ?? 'ONEBLOG主题'; ?>">
            <div class="banner_post_thumb_2" style="background-image:url('<?php echo $thumbnails[1] ?? ''; ?>')">
                <div class="banner_title_cat"><h1><?php echo $title[1] ?? '请填写文章cid'; ?></h1></div>
            </div>
        </a>
        <a href="<?php echo $link[2] ?? 'https://oneblog.me'; ?>" title="<?php echo $title[2] ?? 'ONEBLOG主题'; ?>">
            <div class="banner_post_thumb_2" style="background-image:url('<?php echo $thumbnails[2] ?? ''; ?>')">
                <div class="banner_title_cat"><h1><?php echo $title[2] ?? '请填写文章cid'; ?></h1></div>
            </div>
        </a>
    </div>
</div>


<?php } ?>
</div>


<div class="main">
    <div class="content" id="bloglist" ><!--文章列表-->
        <?php while($this->next()): ?>
        <div class="post">
            <div class="post_title animated fadeInUp">
                <h2><a href="<?php $this->permalink() ?>" ><?php if (isset($this->fields->title)): ?><?php  $this->fields->title();?><?php else: ?><?php $this->title();?><?php endif; ?></a>
                </h2>   
            </div>
            <div class="post_preview  animated fadeInUp">
                <p class="post_abstract"><?php $this->excerpt(80,'...'); ?></p>
                <?php if($this->fields->thumb) { ?>
                <div class="post_img" style="background-image:url('<?php $this->fields->thumb();?>')"></div>
                <?php }elseif($this->options->ListThumb == 'on' && $this->options->RandomIMG !== 'off'){?>
                <div class="post_img" style="background-image:url('<?php showThumbnail($this);?>')"></div>
                <?php }?>
            </div>
            <div class="post_meta animated fadeInUp">
                <span class="post_date"><?php echo time_ago($this->date); ?></span>
                <span class="post_views"><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span class="post_comment"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            </div>
        </div>
        <?php endwhile; ?>
    </div><!--文章列表end-->
    
    <div class="preload" id="no_more"><!--无限加载-->
         <?php $this->pageLink('点击查看更多','next'); ?>
    </div>
    
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
    
</div>
<?php $this->need('custom/PC/footer.php');?>	