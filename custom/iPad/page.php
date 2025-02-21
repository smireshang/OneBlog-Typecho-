<?php $this->header(); ?>
<div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>');">
    <a class="logo" href="<?php $this->options->siteUrl(); ?>">
        <img src="<?php echo $this->options->logoX ? $this->options->logoX : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
        <div class="slogan">
            <h1><?php $this->options->title();?></h1>
            <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
        </div>
    </a>
</div><!--网站顶栏需要重新设计-->
<div class="main">
    <div class="content page animated fadeIn">    
        <div class="page_title">
            <h2><?php $this->title() ?></h2>
        </div>   
        <p><?php echo AutoLightbox($this->content);?></p>
        <?php $this->need('comments.php'); ?>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>