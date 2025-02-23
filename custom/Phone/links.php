<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/friend.jpg';?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1><?php $this->title();?></h1> 
                    <span>My online friends</span>
                </div>
            </div>
        </div>
        <?php if (array_key_exists('Links', Typecho_Plugin::export()['activated'])):?>
         <!--新版本样式-->
         <div class="links">
             <?php Links_Plugin::output("
				<li class='link'>
					<a href='{url}' target='_blank' rel='nofollow'>
					    <img src='{image}' alt='{name}'/>
					    <div class='link-info'>
					        <h3>{name}</h3>
					        <span title='{description}'>{description}</span>
					    </div>
					</a>
				</li>
			 ", 0); ?>
         </div>
        <?php else:?>
		<p class="no-note">暂未启用Links插件</p>
		<?php endif;?>
        <div class="end">END</div>
    </div>
</div>