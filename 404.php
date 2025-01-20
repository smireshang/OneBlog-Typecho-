<?php $this->need('header.php'); ?>
<div class="header" style="background-image:url('<?php $this->options->index_bg();?>');background-position: center top;">
        <a class="logo" href="/">
            <img src="<?php $this->options->logo();?>">
            <div class="slogan">
                <h1><?php $this->options->sitename();?></h1> 
                <span><?php $this->options->slogan();?></span>
            </div>
        </a>
</div><!--网站顶栏需要重新设计-->
<div class="main">
    <div class="content page">    
        <div class="content-404">
            <div class="img-404"></div>
            <p class="caption-404">页面找不到了！呜呜呜~</p>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>