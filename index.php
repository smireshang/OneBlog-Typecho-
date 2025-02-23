<?php
/*
 *
 * 一款简约文艺的文字博客主题：那些物质的东西，都会随着时间慢慢销蚀，而我们写下的文字，最趋近于永恒。希望你在用上这款主题之后，不忘初心，坚持把自己的博客写下去。
 * 
 * @package OneBlog
 * @author 彼岸临窗
 * @version 3.4.3
 * @link https://oneblogx.com
 * @Updated: 2025-02-23
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/index.php');
}else{
    $this->need('custom/PC/index.php'); 
}?>
