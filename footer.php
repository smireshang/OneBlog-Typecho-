<?php if(isMobile()){  //移动端单独编写
    $this->need('/custom/Phone/footer.php');
}else{ 
    $this->need('/custom/PC/footer.php'); 
}?>