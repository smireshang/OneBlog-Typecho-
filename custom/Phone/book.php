<?php $this->need('custom/Phone/header.php');?>
<?php $this->need('custom/Phone/nav.php');?>
<div class="main margin-top">
    <div class="top-menu">
        <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
        <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
        <?php }?>
        <div class="top-sitename"><a href="/"><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
    </div>
    <style>
    .book-bg:before {
        background: url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>') no-repeat 100% 75%;
        background-size: cover;
        }
    </style>
        <div class="books-content">
            <div class='book-bg'>
                <div class="book-img" style="background-image: url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg'; ?>');"></div>
                <div class="book-info">
                    <h2><?php $this->title();?></h2>
                    <span>作者：<?php echo $this->fields->author ? $this->fields->author : '未填写';?></span>
                    <span>类别：<?php echo $this->fields->bookCat ? $this->fields->bookCat : '未填写';?></span>
                    <span>出版时间：<?php echo $this->fields->bookYear ? $this->fields->bookYear : '未填写';?></span>
                </div>
            </div>
            <div class="usual"> 
                <ul class="idTabs"> 
                    <li><a href="#idTab1" class="selected">读书笔记</a></li> 
                    <li><a href="#idTab2">本书简介</a></li> 
                </ul> 
                <div class="bookcss" id="idTab1"><?php $this->need('custom/Phone/booknote.php'); ?></div> 
                <div class="bookcss" id="idTab2">
                    <?php if (empty(trim($this->content))): ?>
                    <p class="no-note">博主很懒，暂未填写本书简介。</p>
                    <?php else: ?>
                    <div class="bookInfo"><?php $this->content(); ?></div>
                    <?php endif; ?>
                </div> 
            </div>
        </div>
</div>
<?php $this->need('footer.php'); ?>