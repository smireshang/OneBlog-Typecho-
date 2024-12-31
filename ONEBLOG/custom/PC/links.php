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
    <div class="content page">
         <div class="page_title">
             <h2><?php $this->title() ?></h2>
         </div>   
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
         <h4 class="link-request">
             <span style="color:#ff9900;font-size: 1.1rem;">#&nbsp;</span>
             友链要求
         </h4>
         <p><?php $this->content(); ?></p>
         <?php $this->need('comments.php'); ?>
    </div>
</div>