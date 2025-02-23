<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/archives.jpg';?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1><?php $this->title();?></h1> 
                    <span>Blog's Archives</span>
                </div>
            </div>
        </div>
        

        <!--全部文章（除相册和书单）-->
        <section class="archives">
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
            $excludeCategories = array('photos', 'books'); // 隐藏分类
            $articlesByYear = array();
            while ($archives->next()) {
                $categories = $archives->categories;
                $showArticle = true;
                foreach ($categories as $category) {
                    if (in_array($category['slug'], $excludeCategories)) {
                        $showArticle = false;
                        break;
                    }
                }
                if (!$showArticle) continue;
                $year = date('Y', $archives->created);
                if (!isset($articlesByYear[$year])) {
                    $articlesByYear[$year] = array();
                }
                $articlesByYear[$year][] = [
                    'title' => $archives->title,
                    'permalink' => $archives->permalink,
                    'date' => date('m月d日', $archives->created) 
                ];
            }
            foreach ($articlesByYear as $year => $articles) {
                echo '<h3><span>#</span>' . $year . '年</h3>';
                foreach ($articles as $article) {
                    echo '<li><a href="' . $article['permalink'] . '"><span>' . $article['date'] . '</span>&nbsp;&nbsp;' . $article['title'] . '</a></li>';
                }
            }?>
        </section>

        <!-- 全部独立页面 -->
        <section class="archives">
            <h3><span>#</span>页面</h3>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages);
            while ($pages->next()) {
                echo '<li><a href="' . $pages->permalink . '">' . htmlspecialchars($pages->title) . '</a></li>';
            }?>
        </section>

        <!-- 全部分类 -->
        <section class="archives">
            <h3><span>#</span>分类</h3>
            <?php $this->widget('Widget_Metas_Category_List')->to($categories);
            while ($categories->next()) {
                echo '<li><a href="' . $categories->permalink . '">' . htmlspecialchars($categories->name) . '</a></li>';
            }?>
        </section>
        
        <!--全部标签-->
        <section class="archives">
            <h3><span>#</span>标签</h3>
            <div class="tags">
                <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1')->to($tags);
                while ($tags->next()) {
                    echo '<a href="' . $tags->permalink . '">' . htmlspecialchars($tags->name) . '</a>';
                }?>
            </div>
        </section>
        <div class="end" id="no-more">END</div>
    </div>
</div>
