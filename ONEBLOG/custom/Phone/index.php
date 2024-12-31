<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/nav.php');?>	
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
<div class="main" onload="loaded()">
<?php $this->need('custom/Phone/page_nav.php');?>	
<?php if ($this->is('index')){?>
<!--如果是首页，则显示轮播图-->
<div class="swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <a href="<?php echo $link[0]; ?>" style="background-image:url('<?php echo $img[0]; ?>')">
                <h2><?php echo $title[0]; ?></h2>
            </a>
        </div>
        <div class="swiper-slide">
            <a href="<?php echo $link[1]; ?>" style="background-image:url('<?php echo $img[1]; ?>')">
                <h2><?php echo $title[1]; ?></h2>
            </a>
        </div>
        <div class="swiper-slide">
            <a href="<?php echo $link[2]; ?>" style="background-image:url('<?php echo $img[2]; ?>')">
                <h2><?php echo $title[2]; ?></h2>
            </a>
        </div>
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>
<!--如果是首页，则只显示最新一篇文章end-->
<?php }else{?>
 <!--首页以外的文章列表显示页面标题-->
<div class="header" style="background-image:url('<?php $this->options->ArticleListBg();?>')">
        <div class="pagetitle">
            <div class="slogan">
                <h1>
                <?php $this->archiveTitle(array(
                    'category'  =>  _t('%s'),
                    'search'    =>  _t('%s'),
                    'tag'       =>  _t('%s专栏'),
                    'author'    =>  _t('%s')
                    ), '', ''); ?>
                </h1> 
                <span>I saw, I read, I write.</span>
            </div>
        </div>
</div><!--网站顶栏需要重新设计-->
<?php } ?>
<script>
    var myScroll;
    function loaded() {
        myScroll = new IScroll('#bloglist');
    }
    //上拉加载下一页效果待实现
    
</script>

    <div class="content" id="bloglist" ><!--文章列表-->    
        <?php while($this->next()): ?>
            <div class="post_all">
                <div class="post_title_all">
                    <h2><a href="<?php $this->permalink() ?>" ><?php if (isset($this->fields->title)): ?><?php  $this->fields->title();?><?php else: ?><?php $this->title();?><?php endif; ?></a>
                    </h2>   
                </div>
                <div class="post_preview_all">
                    <p class="post_abstract"><?php $this->excerpt(40,'...'); ?></p>
                    <?php if($this->fields->thumb) { ?><!--如是有图文章，则显示缩略图-->
                    <div class="post_img" style="background-image:url('<?php $this->fields->thumb();?>')"></div>
                    <?php } ?>
                    
                </div>
                <div class="post_meta_all">
                    <span class="post_date"><?php echo time_ago($this->date); ?></span>
                    <span class="post_views"><?php get_post_view($this) ?>&nbsp;阅读</span>
                    <span class="post_comment"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
                </div>
            </div>
        <?php endwhile;?>
    </div> 
    <div class="preload" id="no_more"><!--无限加载-->
         <?php $this->pageLink('点击查看更多','next'); ?>
    </div>

</div>

<?php $this->need('custom/Phone/footer.php');?>	