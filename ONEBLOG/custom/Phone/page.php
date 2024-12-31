<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">

        <?php $this->need('custom/Phone/page_nav.php');?>	
        <div class="header" style="background-image:url('<?php $this->fields->thumb();?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1><?php $this->archiveTitle('','',''); ?></h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div><!--网站顶栏需要重新设计-->
        <div class="post_content">
                <?php $this->content(); ?>    
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
</div>
