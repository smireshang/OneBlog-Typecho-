<?php
// 获取unplash同步相册开关状态
$Unsplash = $this->options->Unsplash;
$accessKey = $this->options->Unsplash_API;
$Unsplash_user = $this->options->Unsplash_User;
$PhotoMid = $this->options->Unsplash_Cat;
// 是否开启unsplash照片同步
if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) {
    $this->need('unsplash.php');
}?>

<div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/photo.jpg';?>')">
    <a class="logo" href="<?php $this->options->siteUrl(); ?>">
        <img src="<?php echo $this->options->logoX ? $this->options->logoX : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
        <div class="slogan">
            <h1><?php $this->options->title();?></h1>
            <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
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
            <?php if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) { ?>
            <button id="updateBtn">
                <i class="iconfont icon-update"></i>同步照片
            </button>
            <?php } ?>
        </div>
        
        <div id="photos">
            <?php while($this->next()): ?>
            <div class="grid image-shadow blur">
                <div class="grid-item">
                    <a data-fancybox="gallery" data-caption="<?php $this->title(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php echo $this->fields->author ? $this->fields->author() : $this->author(); ?>" href="<?php echo $this->fields->photo ? $this->fields->photo() : $this->fields->thumb(); ?>">
                        <img class="lazy-load" data-src="<?php echo $this->fields->thumb(); ?>" />
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="preload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>
