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
<?php $this->need('custom/Phone/nav.php');?>
<div class="content">
    <div class="top-menu">
        <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
        <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
        <?php }?>
        <div class="top-sitename"><a href="/"><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
    </div>
    <div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/photo.jpg';?>')">
        <div class="pagetitle">
            <div class="slogan">
                <h1>个人相册</h1> 
                <span>I saw, I read, I write.</span>
            </div>
            <?php if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) { ?>
            <button id="updateBtn" class="colorful">
                <span class="sp"><i class="iconfont icon-update"></i>&nbsp;同步照片</span>
            </button>
            <?php } ?>
        </div>
    </div>
    <div class="photo-main">
        <div class="photo">    
            <div id="photos">
            <?php while($this->next()): ?>
                <div class="grid">
                    <div class="grid-item">
                        <a data-fancybox="gallery" data-caption="<?php $this->title(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php echo $this->fields->author ? $this->fields->author() : $this->author(); ?>" href="<?php echo $this->fields->photo ? $this->fields->photo() : $this->fields->thumb(); ?>">
                            <img class="lazy-load" data-src="<?php echo $this->fields->thumb(); ?>" />
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
        <div class="page-navigator" style="display: none;">
            <?php $this->pageNav('', ''); ?>
        </div>

        <!-- 加载动画 -->
        <div id="loading-spinner" style="display: none;">
            <div class="spinner"></div>加载中...
        </div>
    </div>
</div>