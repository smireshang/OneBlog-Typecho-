<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="/"><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/friend.jpg';?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1><?php $this->title();?></h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div>
        <?php if (array_key_exists('Links', Typecho_Plugin::export()['activated'])):?>
        <div class="links">
             <?php Links_Plugin::output("
				<li class='link-item'>
					<a href='{url}' target='_blank' rel='nofollow'>
					    <h5>{name}</h5>
					    <div class='link-info'>
					        <span>{description}</span>
					        
					    </div>
					</a>
				</li>
			 ", 0); ?>
        </div>
        <?php else:?>
		<p class="no-note">暂未启用Links插件</p>
		<?php endif;?>
        <div style="margin-top:30px;" class="end">END</div>
    </div>
</div>