<!DOCTYPE html>
<html  id="right_tab">
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<link rel="dns-prefetch" href="https://cravatar.cn/">
<link rel="dns-prefetch" href="https://cdn.luziyang.cn">
<link rel="dns-prefetch" href="https://images.unsplash.com">
<link rel="shortcut icon" href="<?php $this->options->themeUrl('/assets/img/favicon.ico'); ?>" type="image/x-icon" />
<title><?php $this->archiveTitle(' &raquo; ', '', ' | '); ?><?php $this->options->title(); ?></title>
<link href="<?php $this->options->themeUrl('/assets/css/PC.css'); ?>" rel="stylesheet"/>
<link href="<?php $this->options->themeUrl('/assets/sdk/animate.compat.css'); ?>" rel="stylesheet"><!--动画效果-->
<link href="//at.alicdn.com/t/c/font_3940454_3bz9oipainn.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.css'); ?>" />
        <meta property="og:url" content="<?php $this->permalink() ?>" />
        <meta property="og:type" content="blog" />
        <meta property="og:release_date" content="<?php $this->date('Y-m-d'); ?>" />
        <meta property="og:title" content="<?php $this->title() ?>" />
        <meta property="og:image" content="<?php $this->fields->thumb();?>" />
        <meta property="og:description" content="<?php $this->excerpt(180,'...'); ?>" />
        <meta property="og:author" content="<?php $this->options->sitename();?>" />
        <meta property="article:published_time" content="<?php $this->date('Y-m-d'); ?>" />
        <meta property="article:modified_time" content="<?php $this->date('Y-m-d'); ?>" />
</head>
<?php $this->header(); ?>
<body>