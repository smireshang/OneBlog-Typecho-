<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">
        <div class="top-menu">
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
                <div class="top-sitename"><img src="<?php $this->options->Mlogo();?>"></div>
        </div>
        <div class="header" style="background-image:url('<?php $this->fields->thumb();?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1>友链</h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div><!--网站顶栏需要重新设计-->
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
        <div style="margin-top:30px;" class="end">END</div>
    </div>
</div>