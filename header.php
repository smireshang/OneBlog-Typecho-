<?php 
if(isMobile()){  //移动端单独编写
    $this->need('/custom/Phone/header.php');
}else{
    $this->need('/custom/PC/header.php');
}?>