<div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/book.jpg';?>')">
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
        <div class="page_title"><h2>我的书房</h2></div>   
        <div id="books">
            <?php while($this->next()): ?>
            <a href="<?php $this->permalink() ?>" class="book-item">
                <div class="book-thumb" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>')"></div>
                <div class="book-name"><?php echo $this->title ? $this->title : '请填写书名';?></div>
            </a>
            <?php endwhile; ?>
        </div>
        <div class="preload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>