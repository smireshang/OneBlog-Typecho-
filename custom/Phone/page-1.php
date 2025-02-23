<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="page_1_title">
            <h1><?php $this->title() ?></h1>
        </div>
        <div class="page_info">
            <span><?php $this->date('Y年m月d日'); ?></span>
            <span>/</span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span>/</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            <span>/</span>
            <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
        </div>
        <div class="post_content"><?php echo AutoLightbox($this->content);?></div>
        <?php $this->need('comments.php'); ?>
    </div>
</div>