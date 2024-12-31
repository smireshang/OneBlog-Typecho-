<?php 
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$is_ipad = (strpos($agent, 'ipad')) ? true : false;
   if($is_ipad){  //如果客户端是iPad
        $this->need('/custom/iPad/dreams.php');
   }elseif (isMobile()) { //如果客户端是手机
        $this->need('/custom/Phone/dreams.php');
   }else{ //否则都是电脑
        $this->need('/custom/PC/dreams.php'); }
?>