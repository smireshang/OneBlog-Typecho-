<?php 
//详情页
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
//如果是书单
if ($this->category == "books") {
    $this->need('/custom/is/book.php');
//如果是相册
}elseif($this->category == "photography"){
    $this->need('/custom/is/photography.php');
//有头图的文章
}elseif($this->fields->thumb){
    $this->need('/custom/is/post.php');    
//无头图的文章
}else{ 
    $this->need('/custom/is/post_no_thumb.php');    
}?>
  
  
  
  
