<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<link rel="dns-prefetch" href="https://cravatar.cn/">
<link rel="dns-prefetch" href="https://cdn.luziyang.cn">
<link rel="shortcut icon" href="<?php $this->options->themeUrl('/assets/img/favicon.ico'); ?>" type="image/x-icon" />
<title><?php $this->archiveTitle(' &raquo; ', '', ' | '); ?>简约文艺的文字博客主题</title>

<link href="<?php $this->options->themeUrl('/assets/css/Phone.css'); ?>" rel="stylesheet"/>
<link href="//at.alicdn.com/t/c/font_3940454_3bz9oipainn.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.css'); ?>" /><!--全站图片灯箱效果-->
<?php $this->header();?>
</head>
<body>
<?php $this->need('custom/Phone/nav.php');?>
<div class="main">
    <div class="content page">

        <?php $this->need('custom/Phone/page_nav.php');?>	
        <div class="header" style="background-image:url('<?php $this->fields->thumb();?>');height:140px;"></div>

        <div class="post_content">
                <?php $this->content(); ?>  
                <div class="wxq">
                    <span>打赏作者<img src="https://cdn.luziyang.cn/blog/web-ui/shang.png"></span>
                    <span>加微信群<img src="https://cdn.luziyang.cn/wx/1.png"/></span>
                </div>
        </div>
        
        <?php $this->need('comments.php'); ?>
    </div>
</div>
    
