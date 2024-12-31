<?php $this->need('custom/PC/header.php');?>
<?php //重新设计的banner电脑顶栏
$lunbo = $this->options->Banner;
$hang = explode(",", $lunbo,3);
$n=count($hang);
for($i=0;$i<$n;$i++){
    $this->widget('Widget_Archive@hang'.$i, 'pageSize=999&type=post', 'cid='.$hang[$i])->to($ji);
    $link[$i] = $ji->permalink;
    $title[$i] = $ji->title;
    $img[$i] = $ji->fields->thumb;
}
?>
<div class="header_index"><!--网站顶栏重新设计效果20220506-->
    <div class="index_logo">
        <h1><?php $this->options->title();?><span class="soul">生活志</span></h1>
        <div class="one">"&nbsp;<?php $quotes_file = __DIR__ . '/quotes.txt';$quotes = file($quotes_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);$random_quote = $quotes[array_rand($quotes)];echo $random_quote;?>"</div>
    </div>
    <div class="banner_banner"><!--顶部的封面图文章-->
            <div class="banner_left">
                <a href="<?php echo $link[0]; ?>" title="<?php echo $title[0]; ?>">
                <div class="banner_post_thumb" style="background-image: url('<?php echo $img[0]; ?>')">
                        <div class="banner_title_cat"><h1><?php echo $title[0]; ?></h1></div>
                </div>
                </a>
            </div>
            <div class="banner_right">
                <a href="<?php echo $link[1]; ?>" title="<?php echo $title[1]; ?>">
                <div class="banner_post_thumb_2" style="background-image: url('<?php echo $img[1]; ?>')">
                        <div class="banner_title_cat"><h1><?php echo $title[1]; ?></h1></div>
                </div>
                </a>
                <a href="<?php echo $link[2]; ?>" title="<?php echo $title[2]; ?>">
                <div class="banner_post_thumb_2" style="background-image: url('<?php echo $img[2]; ?>')">
                        <div class="banner_title_cat"><h1><?php echo $title[2]; ?></h1></div>
                </div>
                </a>
            </div>
    </div>
</div>


<div class="main">
    <div class="content" id="bloglist" ><!--文章列表-->
        <?php while($this->next()): ?>
        <div class="post">
            
            <div class="post_title animated fadeInUp">
                <h2><a href="<?php $this->permalink() ?>" ><?php if (isset($this->fields->title)): ?><?php  $this->fields->title();?><?php else: ?><?php $this->title();?><?php endif; ?></a>
                </h2>   
            </div>
            <div class="post_preview  animated fadeInUp">
                <p class="post_abstract"><?php $this->excerpt(80,'...'); ?></p>
                <?php if($this->fields->thumb) { ?><!--如是有图文章，则显示缩略图-->
                <div class="post_img" style="background-image:url('<?php $this->fields->thumb();?>')"></div>
                <?php }?>
            </div>
            <div class="post_meta animated fadeInUp">
                <span class="post_date"><?php echo time_ago($this->date); ?></span>
                <span class="post_views"><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span class="post_comment"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>

            </div>
        </div>
        <?php endwhile; ?>
    </div><!--文章列表end-->
    
    <div class="preload" id="no_more"><!--无限加载-->
         <?php $this->pageLink('点击查看更多','next'); ?>
    </div>
    
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
    
</div>
<?php $this->need('custom/PC/footer.php');?>	