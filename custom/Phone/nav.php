<!-- 移动端侧栏菜单-->
<div id="sideBar" class="sidebarClass">
    <div class="right-show">
        <div class="close">
            <span id="close-nav"><i class="iconfont icon-cancel"></i></span>
        </div>
        <ul>
        <?php //自定义菜单
        if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){
            $menuarray=ZeMenu_Plugin::zemenu();
            foreach ($menuarray as $item) {
                echo "<li><a href=\"$item[a]\"><i class=\"$item[icon]\"></i>$item[name]</a></li>";
            }
        }?>
        </ul>
    </div>
    <div class="nav-footer">
        <span>©<?php if (!empty($this->options->Webtime)): echo $this->options->Webtime().'-'; ?><?php endif; ?><?php echo date('Y'); ?>&nbsp;&nbsp;<a href="<?php echo $this->options->siteUrl; ?>"><?php echo $this->options->title; ?></a></span>
        <span>Designed by <a id="author-info" href="https://oneblog.co" title="主题" target="_blank">OneBlog</a></span>
    </div>
</div>