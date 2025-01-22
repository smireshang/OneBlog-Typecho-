<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">  
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href="/"><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/book.jpg';?>')">
            <div class="pagetitle">
                <div class="slogan">
                    <h1>我的书房</h1> 
                    <span>I saw, I read, I write.</span>
                </div>
            </div>
        </div>
        <div id="books">
            <?php while($this->next()): ?>
            <a href="<?php $this->permalink() ?>" class="book-item">
                <div class="book-thumb" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>')"></div>
                <div class="book-name"><?php echo $this->title ? $this->title : '请填写书名';?></div>
            </a>
            <?php endwhile; ?>
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