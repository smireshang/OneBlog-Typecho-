<?php 
//详情页
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 

//书单详情页
if ($this->category == "books") {
    if(isMobile()){  //移动端单独编写
        $this->need('custom/Phone/book.php');
    }else{
        $this->need('custom/PC/book.php'); 
    }
    
//相册详情页
}elseif($this->category == "photos"){
    if(isMobile()){  //移动端单独编写
        $this->need('custom/Phone/photography.php');
    }else{
        $this->need('custom/PC/photography.php'); 
    }
    
//有封面图的文章详情页
}elseif($this->fields->thumb){
    if(isMobile()){  //移动端单独编写
        $this->need('custom/Phone/post.php');
    }else{
        $this->need('custom/PC/post.php'); 
    }
    
//无封面图的文章详情页
}else{ 
    if(isMobile()){  //移动端单独编写
        $this->need('custom/Phone/post_no_thumb.php');
    }else{
        $this->need('custom/PC/post_no_thumb.php'); 
    }
}?>
  
  
  
  
