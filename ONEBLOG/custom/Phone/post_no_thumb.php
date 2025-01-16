<?php $this->need('custom/Phone/header.php');?>
<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content no_thumb">
        <div class="top-menu">
            <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
            <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
            <?php }?>
            <div class="top-sitename"><a href=""><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
        </div>
        <div class="post">
            <div class="post_category">
                <?php $this->category(','); ?>
            </div>
            <div class="post_title">
                <h2><a href="<?php $this->permalink() ?>" ><?php $this->title();?></a></h2>   
                <span class="post_date"><?php $this->dateWord(); ?></span>
                <span class="post_views"><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span class="post_comment"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
                <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
            </div>
            <div class="post_content">
                <?php $this->content(); ?>    
            </div>
            <?php if ($this->category == "default") { ?>
            <div class="cc-say">
                本文著作权归作者 [&nbsp;<span><?php echo $this->fields->author ? $this->fields->author : $this->author();?></span>&nbsp;] 享有，未经作者书面授权，禁止以任何目的、任何形式转载，本声明具有法律效力，作者保留法律范围内的一切权利。
            </div>
            <?php } else { ?>
            <div class="cc-say">
                本文来源于互联网，著作权归 [&nbsp;<span><?php echo $this->fields->author ? $this->fields->author : '原作者';?></span>&nbsp;] 享有，本文仅供个人学习、研究和欣赏使用，如有异议，请联系站务及时处理。
            </div> 
            <?php } ?>
            <div class="post_footer">
                <div class="tags">
                    <?php $this->tags(' ', true, ''); ?>
                </div>
            
            <?php $this->related(5)->to($relatedPosts); ?>
            <div class="relation">
                <?php $justone = 1; ?>
                <?php while ($relatedPosts->next()):
                if ($justone == 1) { //循环中该文本只执行一次
                    $justone = 2;?>
                    <div class="youlike"><span>▋ 猜你喜欢</span></div>
                <?php } ?>
                <div class="relate-post" style="background-image:url('<?php echo showThumbnail($relatedPosts); ?>')">
                    <a href="<?php $relatedPosts->permalink(); ?>"  title="<?php $relatedPosts->title(); ?>">
                        <h2 class="prev-title"><?php $relatedPosts->title(); ?></h2>
                    </a> 
                </div>
                <?php endwhile; ?>
            </div>
            </div>
            <?php $this->need('comments.php'); ?> 
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>