<?php $this->need('custom/PC/post_header.php');?>
<div class="main margin-top">
    <style>
    .book-bg:before {
        background: url('<?php $this->fields->thumb();?>') no-repeat 100% 75%;
        background-size: cover;
        }
    </style>
        <div class="books-content">
            <div class='book-bg'>
                <div class="book-img"><img src="<?php $this->fields->thumb();?>"/></div>
                <div class="book-info">
                    <h2><?php $this->title();?></h2>
                    <span>作者：<?php $this->fields->author();?></span>
                    <span>类别：<?php $this->fields->bookCat();?></span>
                    <span>出版时间：<?php $this->fields->bookYear();?></span>
                </div>
            </div>
            <div class="usual"> 
                <ul class="idTabs"> 
                    <li><a href="#idTab1" class="selected">读书笔记</a></li> 
                    <li><a href="#idTab2">本书简介</a></li> 
                </ul> 
                <div class="bookcss" id="idTab1"><?php $this->need('custom/PC/booknote.php'); ?></div> 
                <div class="bookcss" id="idTab2"><?php $this->content(); ?> </div> 
            </div>
        </div>
</div>
<?php $this->need('footer.php'); ?>
