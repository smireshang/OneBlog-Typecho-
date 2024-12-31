<div class="footer">
    <div class="navigation">
        <a href="/">首页</a>&nbsp;&nbsp;
        <a href="/about.html">关于</a>&nbsp;&nbsp;
        <a href="/mood.html" >微语</a>&nbsp;&nbsp;
        <a href="/category/photography/" >相册</a>&nbsp;&nbsp;
        <a href="/links.html" >邻居</a>&nbsp;&nbsp;
        <a href="/category/books/">书房</a>&nbsp;&nbsp;
        <a href="/sitemap.xml">地图</a>&nbsp;&nbsp;
        <p class="copyright">
            Copyright&copy;2016-<?php echo date('Y'); ?>&nbsp;&nbsp;All Rights Reserved.&nbsp;&nbsp;Load：<?php echo timer_stop();?><br/>
            Powered by Typecho&nbsp;&nbsp;|&nbsp;&nbsp;Designed by<a href="https://blog.luziyang.cn/oneblog.html" title="主题作者" target="_blank">OneBlog</a>
            <?php if (isset($this->options->ICP)): ?>
                <br/><a href="https://beian.miit.gov.cn/" target="_blank">工信部备案号:<?php $this->options->ICP();?></a>
            <?php endif; ?>
        </p>
        <div class="contact">
            <a href="<?php $this->options->Weibo();?>" target="_blank" title="微博"><i class="iconfont icon-weibo"></i></a>
            <a id="wxmp" title="微信"><i class="iconfont icon-wechat"></i></a>
            <a id="tomail" title="邮箱"><i class="iconfont icon-mail"></i></a>
        </div>
    </div>
</div>

<?php $this->footer();?>


<script src="<?php $this->options->themeUrl('/assets/sdk/jquery.min.js'); ?>"></script><!--基础依赖放在最前面-->
<script src="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.js'); ?>"></script><!--图片灯箱效果-->
<script src="<?php $this->options->themeUrl('/assets/sdk/layer/layer.js'); ?>"></script>
<!--引入layer框架，独立组件，必须放在全局css之前，否则会影响ui-->

<script src="<?php $this->options->themeUrl('/assets/js/oneblog.js'); ?>"></script><!--主题js-->

<?php if (!$this->is('category', 'photography') && !$this->is('category', 'books')) : //如果是相册\书房页面，则不加载评论相关js?>
<script src="<?php $this->options->themeUrl('/assets/js/comments.js'); ?>"></script><!--评论无限加载js-->
<?php endif; ?>


<?php if ($this->is('category', 'photography')): //只在相册页面加载同步功能的js?>
<script src="<?php $this->options->themeUrl('/assets/js/unsplash.js'); ?>"></script><!--更新照片-->
<?php endif; ?>

<script src="<?php $this->options->themeUrl('/assets/js/dreams.js'); ?>"></script><!--筑梦弹框js-->
<script type="text/javascript">//必须放在php文件中
POWERMODE.colorful = true;  // 冒光特效  
POWERMODE.shake = false;    // 抖动特效  
document.body.addEventListener('input', POWERMODE); // 为所有 input 标签都加上特效  
$(document).on('click', '#wxmp', function() {
    layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        shadeClose: true,
        skin: 'layui-layer-nobg', //加上边框
        area: ['auto'], //宽高
        content: '<img id= "mywxmp" style="width:20rem;height:20rem;display:block;" src="<?php $this->options->Weixin();?>">'
            });
	});
	
	
$(document).on('click', '#tomail', function() {    
    layer.msg('博主的私人邮箱为：<?php $this->options->Email();?>',{time:4000});
});    	
	

 $(function () { 
            $("#right_tab").NZ_Menu({
                items: [{
                    name: "返回", event:function(){
                        window.history.back(-1);
                        },icon: "iconfont icon-back"
                }, {
                    name: "刷新", event:function(){
                        window.location.reload();
                        },icon: "iconfont icon-reload"
                }, {
                    name: "小语", event: function () {
                        window.location.href='/mood.html';
                    }, icon: "iconfont icon-mood"
                }, {
                    name: "相册", event: function () {
                        window.location.href='/category/photography/';
                    }, icon: "iconfont icon-pic"
                }, {
                    name: "书房", event: function () {
                        window.location.href='/category/books/';
                    }, icon: "iconfont icon-book"
               }, {
                    name: "留言", event: function () {
                        window.location.href='/about.html';
                    }, icon: "iconfont icon-guestbook"
               }, {
                    name: "首页", event: function () {
                        window.location.href='/';
                    }, icon: "iconfont icon-home"
                }]
            });
        });
        

</script>
<?php if($this->is('page', 'links')){ ?>
<script>
document.body.oncopy = function() {layer.msg('复制成功！');};//友链页面允许复制
</script>
<?php }elseif ($this->user->hasLogin()){} else{?><!--未登录用户禁止一切非常规行为-->
<!--
<script src="//$this->options->themeUrl('assets/js/F12.js'); ?>"></script>
-->
<?php }?>

</body>
</html>