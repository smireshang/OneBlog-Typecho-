<!DOCTYPE html>
<html id="right_tab">
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<link rel="dns-prefetch" href="https://cravatar.cn">
<link rel="dns-prefetch" href="https://images.unsplash.com">
<?php if (!empty($this->options->dnsPrefetch)):
$domains = array_filter(array_map('trim', explode("\n", $this->options->dnsPrefetch)));
foreach ($domains as $domain): ?>
<link rel="dns-prefetch" href="<?php echo $domain; ?>">
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($this->options->Favicon)):?>
<link rel="shortcut icon" href="<?php echo $this->options->Favicon; ?>" type="image/x-icon" />
<?php endif; ?>
<title>
<?php if ($this->is('index')): ?>
<?php $this->options->title(); ?> - <?php echo !empty($this->options->slogan) ? $this->options->slogan() : '自豪地使用OneBlog主题'; ?>
<?php else: ?>
<?php $this->archiveTitle(' &raquo; ', '', ' - '); ?><?php $this->options->title(); ?>
<?php endif; ?>
</title>
<?php if($this->is('page') || $this->is('post')):?>

<?php endif;?>

<link href="<?php $this->options->themeUrl('/assets/css/PC.css?v=3.4.3'); ?>" rel="stylesheet"/>
<link href="<?php $this->options->themeUrl('/assets/sdk/animate.compat.css'); ?>" rel="stylesheet"><!--动画效果-->
<link href="//at.alicdn.com/t/c/font_3940454_171vuozxwlx.css" rel="stylesheet"/><!---图标库 iconfont.cn -->
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.css'); ?>" />
<?php
$NoPostIMG = $this->options->NoPostIMG ? $this->options->NoPostIMG : Helper::options()->themeUrl . '/assets/default/bg.jpg';
$thumb = $this->fields->thumb ? $this->fields->thumb : $NoPostIMG;
$Webthumb = $this->options->Webthumb ? $this->options->Webthumb : $NoPostIMG;
if ($this->is('index')): ?>
<meta property="og:url" content="<?php $this->options->siteUrl(); ?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php $this->options->title(); ?> - <?php echo !empty($this->options->slogan) ? $this->options->slogan() : '自豪地使用OneBlog主题'; ?>" />
<meta property="og:description" content="<?php $this->options->description(); ?>" />
<meta property="og:image" content="<?php echo $Webthumb; ?>" />
<meta property="og:author" content="oneblogx.com" />
<?php else: ?>
<meta property="og:url" content="<?php $this->permalink() ?>" />
<meta property="og:type" content="article" />
<meta property="og:release_date" content="<?php $this->date('Y-m-d'); ?>" />
<meta property="og:title" content="<?php $this->title(); ?>" />
<meta property="og:image" content="<?php echo $thumb; ?>" />
<meta property="og:description" content="<?php $this->excerpt(180, '...'); ?>" />
<meta property="og:author" content="<?php $this->options->sitename(); ?>" />
<meta property="article:published_time" content="<?php $this->date('Y-m-d'); ?>" />
<meta property="article:modified_time" content="<?php $this->date('Y-m-d'); ?>" />
<?php endif; ?>
<?php $this->header();?>
</head>
<body>
