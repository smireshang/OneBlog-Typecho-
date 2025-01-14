<div class="header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/friend.jpg';?>');">
        <a class="logo" href="/">
            <img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
            <div class="slogan">
                <h1><?php $this->options->title();?></h1>
                <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
            </div>
        </a>
</div>
<div class="main">
    <div class="content page">
        <div class="page_title">
            <h2><?php $this->title() ?></h2>
        </div>
        <?php if (array_key_exists('Links', Typecho_Plugin::export()['activated'])):?>
        <div class="links">
             <?php Links_Plugin::output("
				<li class='link-item'>
					<a href='{url}' target='_blank' rel='nofollow'>
					    <h5>{name}</h5>
					    <div class='link-info'>
					        <span>{description}</span>
					        <img src='{image}' alt='{name}'/>
					    </div>
					</a>
				</li>
			 ", 0); ?>
         </div>
        <?php else:?>
		<p class="no-note">暂未启用Links插件</p>
		<?php endif;?>
        <h4 class="link-request">
            <span style="color:#ff9900;font-size: 1.1rem;">#&nbsp;</span>
             友链要求
        </h4>
        <p><?php $this->content(); ?></p>
        <?php $this->need('comments.php'); ?>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>