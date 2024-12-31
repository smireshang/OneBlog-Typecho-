<div class="footer">
    
</div>

<?php $this->footer();?>
<script src="<?php $this->options->themeUrl('/assets/sdk/jquery.min.js'); ?>"></script><!--引入layer框架-->
<!--移动端首页轮播图-->
<script src="<?php $this->options->themeUrl('/assets/sdk/layer/layer.js'); ?>"></script><!--引入layer框架-->
<script src="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.js'); ?>"></script><!--图片灯箱效果-->
<script src="<?php $this->options->themeUrl('/assets/sdk/swiper/swiper-bundle.min.js'); ?>"></script><!--引入swiper框架-->
<script src="<?php $this->options->themeUrl('/assets/sdk/iscroll-lite.js'); ?>"></script><!--引入iscroll-->
<script src="<?php $this->options->themeUrl('/assets/js/oneblog_m.js'); ?>"></script><!--主题js-->
<script src="<?php $this->options->themeUrl('/assets/js/comments.js'); ?>"></script><!--评论无限加载js-->

<?php if ($this->is('index')){?> 
    <script>
    var mySwiper = new Swiper('.swiper', {
	autoplay:true,//可选选项，自动滑动
	loop:true,
	pagination: {
      el: '.swiper-pagination',
    },
})
//如果你初始化时没有定义Swiper实例，后面也可以通过Swiper的HTML元素来获取该实例
new Swiper('.swiper')
var mySwiper = document.querySelector('.swiper').swiper
mySwiper.slideNext();
</script>
<?php } ?>

</body>
</html>