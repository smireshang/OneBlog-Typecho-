<?php $this->header(); ?>
<div class="header" style="background-image:url('<?php $this->fields->thumb();?>')">
        <a class="logo" href="/">
            <img src="<?php $this->options->logo();?>">
            <div class="slogan">
                <h1><?php $this->options->title();?></h1> 
                <span><?php $this->options->slogan();?></span>
            </div>
        </a>
</div><!--网站顶栏需要重新设计-->
<div class="main">
    <div class="content page animated fadeIn">    
        <div class="page_title">
            <h2><?php $this->title() ?></h2>
        </div>   
        <p><?php $this->content(); ?></p>
        <?php $this->need('comments.php'); ?>
    </div>
</div>