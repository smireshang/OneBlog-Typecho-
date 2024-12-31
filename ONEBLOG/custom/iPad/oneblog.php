<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<link rel="dns-prefetch" href="https://cravatar.cn/">
<link rel="dns-prefetch" href="https://cdn.luziyang.cn">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="icon" href="<?php $this->options->themeUrl('/assets/img/favicon.ico'); ?>" type="image/x-icon" />

<title><?php $this->archiveTitle(' &raquo; ', '', ' | '); ?>简约文艺的文字博客主题</title>
<link href="<?php $this->options->themeUrl('/assets/sdk/animate.compat.css'); ?>" rel="stylesheet"><!--动画效果-->

<link href="//at.alicdn.com/t/c/font_3940454_3bz9oipainn.css" rel="stylesheet"/><!--阿里巴巴图库项目名 彼岸临窗-->

<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.css'); ?>" /><!--全站图片灯箱效果-->

<link href="<?php $this->options->themeUrl('/assets/css/PC.css'); ?>" rel="stylesheet"/>
<?php $this->header();?>
</head>
<body>
<div class="header" style="background-image:url('<?php $this->fields->thumb();?>');height:300px;">

</div><!--网站顶栏需要重新设计-->
<div class="main">
    <div class="content page animated fadeIn">    
        <div class="page_title">
            <h2><?php $this->title() ?></h2>
        </div>   
        <p><?php $this->content(); ?></p>
        <div class="wxq">
            <span>打赏作者<img src="https://cdn.luziyang.cn/blog/web-ui/shang.png"></span>
            <span>加微信群<img src="https://cdn.luziyang.cn/wx/1.png"/></span>
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
</div>
