<!DOCTYPE html>
<html id="right_tab">
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<?php if (!empty($this->options->Favicon)):?>
<link rel="shortcut icon" href="<?php echo $this->options->Favicon; ?>" type="image/x-icon" />
<?php endif; ?>
<title><?php $this->archiveTitle(' &raquo; ', '', ' - '); ?><?php $this->options->title(); ?></title>
<link href="<?php $this->options->themeUrl('/assets/css/PC.css'); ?>" rel="stylesheet"/>
<link href="//at.alicdn.com/t/c/font_3940454_by6kunpnght.css" rel="stylesheet"/><!---图标库 iconfont.cn -->
<?php $this->header();?>
</head>
<body>

<div class="header_index"><!--网站顶栏-->
    <div class="index_logo">
        <h1><?php $this->options->title();?><span class="soul">生活志</span></h1>
        <div class="one">"&nbsp;迷失的人迷失了，相逢的人会再相逢。"</div>
    </div>
    <div class="content-404">
        <div class="img-404"></div>
        <p class="caption-404">404：您所访问的页面不存在或已失效</p>
        <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
    </div>

</div>
<?php $this->need('custom/PC/footer.php');?>	