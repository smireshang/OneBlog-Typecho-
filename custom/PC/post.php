<?php $this->need('custom/PC/header.php');?>

<div class="main margin-top">
    <div class="post_thumb lazy-load" data-src="<?php $this->fields->thumb();?>">
        <div class="post_title  animated fadeIn">
            <div class="title_cat">
                <?php $this->category(','); ?>
                <h1><?php $this->title() ?></h1>   
            </div>
            <div class="post_info">
                <span><?php $this->date('Y.m.d'); ?></span>
                <span>/</span>
                <span><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span>/</span>
                <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
                <span>/</span>
                <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
            </div>
        </div>
        
    </div>
    <div class="content animated fadeIn">
        <div class="post_content">
            <?php echo AutoLightbox($this->content);?>
        </div>
        <?php if ($this->category == "default") { ?>
            <div class="cc-say">
                本文著作权归作者 [&nbsp;<span><?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?></span>&nbsp;] 享有，未经作者书面授权，禁止以任何目的、任何形式转载，封面图片来源于 [&nbsp;<span><?php echo $this->fields->origin ? $this->fields->origin : '互联网' ;?></span>&nbsp;] ，本声明具有法律效力，作者保留法律范围内的一切权利。
            </div>
        <?php } else { ?>
            <div class="cc-say">
                本文来源于互联网，著作权归作者 [&nbsp;<span><?php $this->fields->author();?></span>&nbsp;] 享有，封面图片来源于 [&nbsp;<span><?php $this->fields->origin();?></span>&nbsp;] ，本文仅供个人学习、研究和欣赏使用，如有异议，请联系站务及时处理。
            </div> 
        <?php } ?>
        <div class="post_footer">
            <div class="tags">
                <?php $this->tags(' ', true, ''); ?>
            </div>

            

            <div class="prev-next">
                <?php
                $prev = thePrev($this); // 调用函数并将函数值给变量
                $next = theNext($this); // 调用函数并将函数值给变量
                // 获取默认的背景图片 URL
                $backgroundImage = isset($this->options->NoPostIMG) && !empty($this->options->NoPostIMG) ? $this->options->NoPostIMG : Helper::options()->themeUrl . '/assets/default/bg.jpg';
                ?>
            
                <?php if ($prev->created < $this->created) : ?><!--判断上一篇文章是否存在-->
                <a class="prev-post lazy-load" href="<?php $prev->permalink(); ?>" title="<?php $prev->title(); ?>" data-src="<?php echo showThumbnail($prev); ?>">
                    <div class="prev-title">
                        <span>上一篇</span>
                        <h3><?php $prev->title(); ?></h3>
                    </div>
                </a>
                <?php else : ?>
                <a class="prev-post lazy-load" href="<?php $this->options->siteUrl(); ?>" title="没有上一篇" data-src="<?php echo $backgroundImage; ?>">
                    <div class="prev-title">
                        <span>上一篇</span>
                        <h3>没有上一篇（点此返回主页）</h3>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ($next->created > $this->created) : ?><!--判断下一篇文章是否存在-->
                <a class="next-post lazy-load" href="<?php $next->permalink(); ?>" title="<?php $next->title(); ?>" data-src="<?php echo showThumbnail($next); ?>">
                    <div class="next-title">
                        <span>下一篇</span>
                        <h3><?php $next->title(); ?></h3>
                    </div>
                </a>
                <?php else : ?>
                <a class="next-post lazy-load" href="<?php $this->options->siteUrl(); ?>" title="没有下一篇" data-src="<?php echo $backgroundImage; ?>">
                    <div class="next-title">
                        <span>下一篇</span>
                        <h3>没有下一篇（点此返回主页）</h3>
                    </div>
                </a>
                <?php endif; ?>
            </div>


        </div>
        <?php $this->need('comments.php'); ?>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>
<?php $this->need('footer.php'); ?>
       

