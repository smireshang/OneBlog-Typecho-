<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1><?php $this->archiveTitle('','',''); ?></h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div>
        <div class="post_content">
                <?php echo AutoLightbox($this->content);?>   
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
</div>
