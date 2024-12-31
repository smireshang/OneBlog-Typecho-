
<?php $this->need('custom/Phone/nav.php');?>
<div class="content">
    <div class="top-menu">
        <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
        <div class="top-sitename"><img src="<?php $this->options->Mlogo();?>"></div>
    </div>
    <div class="header" style="background-image:url('<?php echo $this->getPageRow()['description'];?>')">
        <div class="pagetitle">
            <div class="slogan">
                <h1>个人相册</h1> 
                <span>I saw, I read, I write.</span>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="photo">    
            <div id="photos">
                <?php while($this->next()): ?>
                <div class="grid">
                    <div class="grid-item">
                        <a data-fancybox="gallery" data-caption="<?php $this->title();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;© <?php $this->options->sitename();?>&nbsp;&nbsp;版权所有"  href="<?php $this->fields->photo();?>"><img src="<?php $this->fields->thumb();?>" />
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="preload" id="no_more">
                <?php $this->pageLink('点击查看更多','next'); ?>
            </div>
        </div>
    </div>
</div>