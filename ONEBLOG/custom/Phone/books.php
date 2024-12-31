<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">  
        <?php $this->need('custom/Phone/page_nav.php');?>	
        <div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'];?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1>我的书房</h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div><!--网站顶栏需要重新设计-->
        <div id="books">
            <?php while($this->next()): ?>
            <a href="<?php $this->permalink() ?>" class="book-item">
                <div class="book-thumb" style="background-image:url('<?php $this->fields->thumb();?>')"></div>
                <div class="book-name"><?php  $this->title();?></div>
            </a>
            <?php endwhile; ?>
        </div>
        <div class="preload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
</div>