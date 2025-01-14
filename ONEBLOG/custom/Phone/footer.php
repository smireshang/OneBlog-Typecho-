<?php $this->footer();?>
<script src="<?php $this->options->themeUrl('/assets/sdk/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/sdk/layer/layer.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/sdk/iscroll-lite.js'); ?>"></script>
<?php if ($this->is('index')):?> 
<script src="<?php $this->options->themeUrl('/assets/sdk/swiper/swiper-bundle.min.js'); ?>"></script>
<?php endif; ?>

<?php $Unsplash = $this->options->Unsplash; if ($this->is('category', 'photos') && $Unsplash == 'on'): ?>
<script src="<?php $this->options->themeUrl('/assets/js/unsplash.js'); ?>"></script><!--更新照片-->
<?php endif; ?>

<script src="<?php $this->options->themeUrl('/assets/js/oneblog_m.js'); ?>"></script>
<?php if ($this->is('post') || $this->is('page')): ?>
<script src="<?php $this->options->themeUrl('/assets/js/comments.js'); ?>"></script>
<?php endif; ?>


</body>
</html>