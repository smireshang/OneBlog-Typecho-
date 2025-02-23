<div class="main margin-top">
    <div class="content page animated fadeIn">
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
        <p><?php echo AutoLightbox($this->content);?></p>
        <?php $this->need('comments.php'); ?>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>