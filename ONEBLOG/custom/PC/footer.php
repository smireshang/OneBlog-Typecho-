<div class="footer">
    <div class="navigation">
        <?php //自定义菜单
        if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){
            $menuarray=ZeMenu_Plugin::zemenu();
            foreach ($menuarray as $item) {
                echo "<a href=\"$item[a]\">$item[name]</a>&nbsp;&nbsp;";
            }
        }?>
        <p class="copyright">
            Copyright&copy;<?php if (!empty($this->options->Webtime)): echo $this->options->Webtime().'-'; ?><?php endif; ?><?php echo date('Y'); ?>&nbsp;&nbsp;All Rights Reserved.&nbsp;&nbsp;Load：<?php echo timer_stop();?><br/>
            Powered by Typecho&nbsp;&nbsp;|&nbsp;&nbsp;Designed by<a id="author-info" href="https://oneblog.me/" title="主题" target="_blank">OneBlog</a>
            <?php if (!empty($this->options->ICP)): ?>
                <br/><a href="https://beian.miit.gov.cn/" target="_blank">工信部备案号:<?php $this->options->ICP(); ?></a>
            <?php endif; ?>
        </p>
        <div class="contact">
            <?php if (!empty($this->options->Weibo)): ?>
                <a href="<?php $this->options->Weibo();?>" target="_blank" title="微博"><i class="iconfont icon-weibo"></i></a>
            <?php endif; ?>
            <?php if (!empty($this->options->Weixin)): ?>
                <a id="wxmp" title="微信公众号"><i class="iconfont icon-wechat"></i></a>
            <?php endif; ?>
            <?php if (!empty($this->options->Email)): ?>
                <a id="tomail" title="邮箱"><i class="iconfont icon-mail"></i></a>
            <?php endif; ?>
            <?php if (!empty($this->options->Github)): ?>
                <a href="<?php $this->options->Github();?>" target="_blank" title="Github"><i class="iconfont icon-github"></i></a>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php $this->footer();?>
<script src="<?php $this->options->themeUrl('/assets/sdk/jquery.min.js'); ?>"></script><!--基础依赖放在最前面-->
<script src="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.js'); ?>"></script><!--图片灯箱效果-->
<script src="<?php $this->options->themeUrl('/assets/sdk/layer/layer.js'); ?>"></script>?
<?php if ($this->is('post') || $this->is('page')): ?>
<?php if ($this->options->BeCode == 'on'):?>
<!--代码高亮逻辑-->
<script src="<?php $this->options->themeUrl('/assets/sdk/highlightjs/highlight.min.js'); ?>"></script>
<script defer>
document.addEventListener('DOMContentLoaded', function () {
    const codeBlocks = document.querySelectorAll('pre code');
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                hljs.highlightElement(entry.target);
                observer.unobserve(entry.target); 
            }
        });
    }, {
        rootMargin: '0px',
        threshold: 0.1 // 当代码块进入视口 10% 时触发，减少资源占用
    });

    codeBlocks.forEach(function (codeBlock) {
        observer.observe(codeBlock); 
        codeBlock.style.filter = 'none'; // 显示高亮后的代码块
    });
});
</script>
<?php endif;?>
<?php endif;?>

<script src="<?php $this->options->themeUrl('/assets/js/oneblog.js'); ?>"></script><!--主题js-->
<?php if (!$this->is('category', 'photos') && !$this->is('category', 'books')) : //如果是相册\书房页面，则不加载评论相关js?>
<script src="<?php $this->options->themeUrl('/assets/js/comments.js'); ?>"></script><!--评论无限加载js-->
<?php endif; ?>

<?php $Unsplash = $this->options->Unsplash; if ($this->is('category', 'photos') && $Unsplash == 'on'): ?>
<script src="<?php $this->options->themeUrl('/assets/js/unsplash.js'); ?>"></script><!--更新照片-->
<?php endif; ?>

<!-- 版权信息 -->
<div id="copyright-info" style="display: none;">
<p>开源不易，请尊重作者版权，保留基本的版权信息。</p>
</div>

<script type="text/javascript">//必须放在php文件中
POWERMODE.colorful = true;  // 冒光特效  
POWERMODE.shake = false;    // 抖动特效  
document.body.addEventListener('input', POWERMODE); // 为所有 input 标签都加上特效  
$(document).on('click', '#wxmp', function() {layer.open({type: 1,title: false,closeBtn: 0,shadeClose: true,skin: 'layui-layer-nobg',area: ['auto'], content: '<img id= "mywxmp" style="width:20rem;height:20rem;display:block;" src="<?php $this->options->Weixin();?>">'});});
$(document).on('click', '#tomail', function() {layer.msg('博主的私人邮箱为：<?php $this->options->Email();?>',{time:4000});});    	
</script>

<?php $Menu = $this->options->Menu;if ($Menu == 'on') { ?>
<script>
var $menuarray = <?php echo json_encode($menuarray); ?>;
$(function () {var newItems = [
{name: "返回",event: function() {window.history.back(-1);},icon: "iconfont icon-back"}, 
{name: "刷新",event: function() {window.location.reload();},icon: "iconfont icon-reload"}];
// 动态生成菜单项
for (var i = 0; i < $menuarray.length; i++) {var item = $menuarray[i];newItems.push({name: item.name,event: (function(item) {return function(){window.location.href = item.a;};})(item),icon: item.icon});}$("#right_tab").NZ_Menu({items: newItems});});
</script>
<?php } ?>

<?php if($this->user->hasLogin()){}else{?><!--登录用户不作任何限制-->
<?php if ($this->options->Copy == 'on' || $this->options->RightClick == 'on' || $this->options->F12 == 'on'): ?>
<script type="text/javascript">
var disableCopy = <?php echo $this->options->Copy == 'on' ? 'true' : 'false'; ?>;
var disableRightClick = <?php echo $this->options->RightClick == 'on' ? 'true' : 'false'; ?>;
var disableF12 = <?php echo $this->options->F12 == 'on' ? 'true' : 'false'; ?>;
var isLinksPage = <?php echo $this->is('page', 'links') ? 'true' : 'false'; ?>;
</script>
<script src="<?php $this->options->themeUrl('assets/js/F12.js'); ?>"></script>
<?php endif; ?>
<?php }?>

</body>
</html>