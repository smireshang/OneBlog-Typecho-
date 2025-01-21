<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<?php if (!empty($this->options->Favicon)):?>
<link rel="shortcut icon" href="<?php echo $this->options->Favicon; ?>" type="image/x-icon" />
<?php endif; ?>
<title><?php $this->archiveTitle(' &raquo; ', '', ' - '); ?><?php $this->options->title(); ?></title>
<link href="//at.alicdn.com/t/c/font_3940454_by6kunpnght.css" rel="stylesheet"/><!---图标库 iconfont.cn -->
<link href="<?php $this->options->themeUrl('/assets/css/Phone.css'); ?>" rel="stylesheet"/><!--放在最后方便自定义插件样式-->
<?php $this->header();?>
</head>
<body>
<?php $this->need('custom/Phone/nav.php');//左侧菜单?>	
<div class="main">
<div class="top-menu">
    <?php if (array_key_exists('ZeMenu', Typecho_Plugin::export()['activated'])){?>
    <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
    <?php }?>
    <div class="top-sitename"><a href=""><img src="<?php echo $this->options->Mlogo ? $this->options->Mlogo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>"></a></div>
</div>
 
<div class="content-404">
    <div class="img-404"></div>
    <p class="caption-404">404：您所访问的页面不存在或已失效</p>
    <a href="<?php $this->options->siteUrl(); ?>"><i class="iconfont icon-home"></i>&nbsp;首页</a>
</div>
<?php $this->need('custom/Phone/footer.php');?>	