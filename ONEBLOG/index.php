<?php
/**
 *
 * 一款清新文艺的文字博客主题：那些物质的东西，都会随着时间慢慢销蚀，而我们写下的文字，最趋近于永恒。希望你在用上这款主题之后，不忘初心，坚持把自己的博客写下去。
 * 
 * @package ONEBLOG
 * @author 彼岸临窗
 * @version 3.3
 * @link https://blog.luziyang.cn/oneblog.html
 */
 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$is_ipad = (strpos($agent, 'ipad')) ? true : false;
   if($is_ipad){  //如果客户端是iPad
        $this->need('custom/iPad/index.php');
   }elseif (isMobile()) { //如果客户端是手机
        $this->need('custom/Phone/index.php');
   }else{ //否则都是电脑
        $this->need('custom/PC/index.php'); }
?>
