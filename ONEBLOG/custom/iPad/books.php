<div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'];?>')">
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
        <div class="page_title"><h2>我的书房</h2></div>   
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