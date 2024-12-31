<?php
/*copyright ONEBLOG ©鲁子阳 V3.2 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
													   
													   
//主题设置自定义

function themeConfig($form) {
 ?><div class="OneBlog"><h3>ONEBLOG<br>主题设置</h3><div class="setting-tips"><b>提醒：</b><span>除此处设置外，其余数据均调用自定义字段或自带字段。独立页面的封面图均调用页面的<b>自定义字段</b>，分类页面的封面图调用<b>分类描述</b>。</span></div></div><?php
 $slogan = new Typecho_Widget_Helper_Form_Element_Text('slogan', NULL, NULL, _t('网站slogan'), _t('一句话介绍自己！'));
 $form->addInput($slogan);   
 
 $logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, NULL, _t('站点logo'), _t('在这里输入logo地址，注意:请加http://'));
 $form->addInput($logo);  
 
 $Mlogo = new Typecho_Widget_Helper_Form_Element_Text('Mlogo', NULL, NULL, _t('移动端logo'), _t('在这里输入logo地址，注意:请加http://'));
 $form->addInput($Mlogo);  
 
 $Banner = new Typecho_Widget_Helper_Form_Element_Text('Banner', NULL, NULL, _t('首页banner文章cid'), _t('必填，用英文逗号隔开，限3个,必须填cid，否则会有问题！'));
 $form->addInput($Banner);    
 
 $ArticleListBg = new Typecho_Widget_Helper_Form_Element_Text('ArticleListBg', NULL, NULL, _t('移动端文章列表顶部背景'), _t('在这里输入图片地址，注意:请加http://'));
 $form->addInput($ArticleListBg);  
 
 $ICP = new Typecho_Widget_Helper_Form_Element_Text('ICP', NULL, NULL, _t('网站备案号'), _t('如有，请填写网站备案号！'));
 $form->addInput($ICP);   

 $Weibo = new Typecho_Widget_Helper_Form_Element_Text('Weibo', NULL, NULL, _t('微博主页'), _t('请填写微博主页链接！'));
 $form->addInput($Weibo);   

 $Weixin = new Typecho_Widget_Helper_Form_Element_Text('Weixin', NULL, NULL, _t('微信公众号'), _t('请填写微信公众号或微信二维码！'));
 $form->addInput($Weixin);   
 
 $Email = new Typecho_Widget_Helper_Form_Element_Text('Email', NULL, NULL, _t('邮箱'), _t('请填写邮箱地址！'));
 $form->addInput($Email);
 
 $Unsplash_API = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_API', NULL, NULL, _t('Unsplash API'), _t('请填写Unsplash API提供的accessKey，用于同步摄影作品。'));
 $form->addInput($Unsplash_API);
 
 $Unsplash_User = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_User', NULL, NULL, _t('Unsplash作者用户名'), _t('请填写Unsplash用户名，用于同步摄影作品。'));
 $form->addInput($Unsplash_User);
 
 $Unsplash_Cat = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_Cat', NULL, NULL, _t('相册mid'), _t('请填写文章分类为相册的mid，用于同步摄影作品所属分类。'));
 $form->addInput($Unsplash_Cat);
 
 $NoPostIMG = new Typecho_Widget_Helper_Form_Element_Text('NoPostIMG', NULL, NULL, _t('无下一篇文章时的背景图'), _t('请填写图片地址，只会显示在文章详情页的右下方，在没有下一篇时显示占位。'));
 $form->addInput($NoPostIMG); 
 
 
}
 
 //文章自定义字段
function themeFields($layout) { 
  
 	$thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, '', _t('封面图片'), _t('用于文章头图、书籍封面、相册缩略图、页面封面图，建议用小图，注意加!small'));
    $layout->addItem($thumb);  
 
    $origin = new Typecho_Widget_Helper_Form_Element_Text('origin', NULL, NULL, _t('图片来源'), _t('请输入图片的版权所有人名称或网站名（如：Unsplash）'));
    $layout->addItem($origin);  
    
    $author = new Typecho_Widget_Helper_Form_Element_Text('author', NULL, NULL, _t('原创作者'), _t('不填则默认为原创文章，作者为账号本人。建议根据内容权属填写著作权人，书单填写书籍作者，如果是Unsplash同步过来的照片，会自动获取照片作者，无需填写。'));
    $layout->addItem($author);  
    
    /**文章分类为相册时的专用字段**/
 	$photo = new Typecho_Widget_Helper_Form_Element_Text('photo', NULL, NULL, _t('原图'), _t('相册专用字段，在这里填入原图地址，注意加https://'));
    $layout->addItem($photo);
    
 	$Unsplash_ID = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_ID', NULL, NULL, _t('Unsplash图片ID'), _t('相册专用字段,自动识别填写，请勿擅自改动。用于保证图片同步的一致性。'));
    $layout->addItem($Unsplash_ID);

 	$Unsplash_UserID = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_UserID', NULL, NULL, _t('Unsplash作者ID'), _t('相册专用字段,自动识别填写，用于跳转至作者unsplash主页。'));
    $layout->addItem($Unsplash_UserID);


    /**文章分类为书单时的专用字段**/
    
 	$bookYear = new Typecho_Widget_Helper_Form_Element_Text('bookYear', NULL, NULL, _t('出版日期'), _t('书单专用字段，填你所读版本的出版日期，格式：2000年6月'));
    $layout->addItem($bookYear);   
    
    $bookCat = new Typecho_Widget_Helper_Form_Element_Select('bookCat', array(
        '随笔' => '随笔',
        '散文'=> '散文',
        '记事' =>'记事',
        '诗集' => '诗集',
        '其他' => '其他'
        ),'散文', _t('书籍分类'), _t('书单专用字段，书籍的分类'));
    $layout->addItem($bookCat);  //  注册  
    
 }
 
/*
* 无插件阅读数，cookie保证阅读量真实性
* 大于一千，转化为k,大于一万转化为W,最多显示10W+
*/

function num2tring($num) {
	if ($num >= 100000) {
		$num = '10w+';
	} elseif ($num >= 10000) {
        $num = round($num / 10000 * 100) / 100 ;
        $num = round($num,1).' w';//四舍五入保留一位小数
    } elseif($num >= 1000) {
        $num = round($num / 1000 * 100) / 100 ;
        $num = round($num,1). ' k';//四舍五入保留一位小数
    } else {
        $num = $num;
    }
    return $num;
}

function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    $newViews = $row['views'];
    $newViews = num2tring($newViews);
    echo $newViews;
}



//文章发表时间格式化
function time_ago($date) {
    $timestamp = strtotime($date->format('Y-m-d H:i:s'));
    $current_time = time();
    $time_diff = $current_time - $timestamp;

    if ($time_diff < 60) {
        return $time_diff . "秒前";
    } elseif ($time_diff < 3600) {
        return floor($time_diff / 60) . "分钟前";
    } elseif ($time_diff < 86400) {
        return floor($time_diff / 3600) . "小时前";
    } elseif ($time_diff < 2592000) { // 30天以内
        return floor($time_diff / 86400) . "天前";
    } elseif ($time_diff < 31536000) { // 1年内
        return floor($time_diff / 2592000) . "个月前";
    } elseif ($time_diff < 94608000) { // 3年内
        return floor($time_diff / 31536000) . "年前";
    } else {
        return $date->format('Y/m/d'); // 超过3年显示具体日期
    }
}


/**
 * 加载时间
 * @return bool
 */
function timer_start() {
    global $timestart;
    $mtime     = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime     = explode( ' ', microtime() );
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r         = $timetotal < 1 ? $timetotal  . " s" : $timetotal . " s";
    if ( $display ) {
        echo $r;
    }
    return $r;
}



/*相册\书单页面展示更多图片以及评论点赞*/
function themeInit($archive) {
    if ($archive->is('category', 'photography')) {
        $archive->parameter->pageSize = 12; // 自定义条数
    }
    
    if ($archive->is('category', 'books')) {
        $archive->parameter->pageSize = 12; // 自定义条数
    }
    
    //创建一个点赞路由
    if ($archive->request->is("commentLike=dz")) {
    //功能处理函数 - 评论点赞
        commentLikes($archive);
    }
 
}


function isMobile()//判断是否为手机端
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
    // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

//文章字数统计
function  art_count ($cid){
$db=Typecho_Db::get ();
$rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
echo mb_strlen($rs['text'], 'UTF-8');
}

/** 评论者认证等级 */

function dengji($i){
    $db=Typecho_Db::get();
    $mail=$db->fetchAll($db->select(array('COUNT(cid)'=>'rbq'))->from('table.comments')->where('mail = ?', $i)->where('authorId = ?','0'));
    foreach ($mail as $sl){
    $rbq=$sl['rbq'];}
    if($rbq<1){
    echo '<span class="level">博主</span>';
    }elseif ($rbq<3 && $rbq>0) {
    echo '<span class="level-1">访客</span>';
    }elseif ($rbq<10 && $rbq>=3) {
    echo '<span class="level-2">读者</span>';
    }elseif ($rbq<20 && $rbq>=10) {
    echo '<span class="level-3">好友</span>';
    }elseif ($rbq<30 && $rbq>=20) {
    echo '<span class="level-4">铁粉</span>';
    }elseif ($rbq<40 && $rbq>=30) {
    echo '<span class="level-5">挚友</span>';
    }elseif ($rbq>=40) {
    echo '<span class="level-6">知己</span>';
    }
}

//获取Gravatar头像 QQ邮箱取用qq头像
function getGravatar($email, $s = 96, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
preg_match_all('/((\d)*)@qq.com/', $email, $vai);
if (empty($vai['1']['0'])) {
    $url = 'https://cravatar.cn/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
}else{
    $url = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$vai['1']['0'].'&spec=100';
}
return  $url;
}


//下一篇
function theNext($widget)
{
$t = Typecho_Widget::widget('Widget_Archive@1');//@的作用我之前也有讲过，就是用来区分的，这里的$t就是定义的$this
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.created <= ?', time())
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);//sql查询下一篇文章
$db->fetchAll($sql, array($t, 'push'));//这个代码就是如何将查询结果封到$this里的
return $t;//返回变量
}
//上一篇
function thePrev($widget)
{
$t = Typecho_Widget::widget('Widget_Archive@2');//@的作用我之前也有讲过，就是用来区分的，@后面参数随便只要和上边的不一样就行
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.created <= ?', time())
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);//sql查询上一篇文章
$db->fetchAll($sql, array($t, 'push'));
return $t;//返回变量
}

//获取文章缩略图，没有显示默认图片
function showThumbnail($widget)
{
    $mr = 'https://cdn.luziyang.cn/blog/pagebg/default.jpg!small';
    if ($widget->fields->thumb) {
        return $widget->fields->thumb();
    } else {
        echo $mr;
    }
}



// 评论点赞
/* 获取评论点赞数量 */
function commentLikesNum($coid, &$record = NULL)
{
    $db = Typecho_Db::get();
    $callback = array(
        'likes' => 0,
        'recording' => false
    );

    //  判断点赞数量字段是否存在
    if (array_key_exists('likes', $data = $db->fetchRow($db->select()->from('table.comments')->where('coid = ?', $coid)))) {
        //  查询出点赞数量
        $callback['likes'] = $data['likes'];
    } else {
        //  在文章表中创建一个字段用来存储点赞数量
        $db->query('ALTER TABLE `' . $db->getPrefix() . 'comments` ADD `likes` INT(10) NOT NULL DEFAULT 0;');
    }

     //获取记录点赞的 Cookie
     //判断记录点赞的 Cookie 是否存在
    if (empty($recording = Typecho_Cookie::get('__typecho_comment_likes_record'))) {
        //  如果不存在就写入 Cookie
        Typecho_Cookie::set('__typecho_comment_likes_record', '[]');
    } else {
        $callback['recording'] = is_array($record = json_decode($recording)) && in_array($coid, $record);
    }

    //  返回
    return $callback;
}

/* 评论点赞处理 */
function commentLikes($archive)
{
    
    // 状态
    $archive->response->setStatus(200); 
    
    
    //评论id
    $_POST['coid'];
    
    /**
     * 行为
     * dz  进行点赞
     * ct  进行踩踏
    **/
    $_POST['behavior'];
    
    
    //判断是否为登录 true 为已经登录
    $loginState = Typecho_Widget::widget('Widget_User')->hasLogin();
    
    $res1 = commentLikesNum($_POST['coid'], $record);
    
    $num = 0;
    
    if(!empty($_POST['coid']) && !empty($_POST['behavior'])){
    
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        $coid = (int)$_POST['coid'];
        
        if (!array_key_exists('likes', $db->fetchRow($db->select()->from('table.comments')))) {
        $db->query('ALTER TABLE `' . $prefix . 'comments` ADD `likes` INT(30) DEFAULT 0;');
        }
        
        //先获取当前赞
        $row = $db->fetchRow($db->select('likes')->from('table.comments')->where('coid = ?', $coid));
        
        $updateRows = $db->query($db->update('table.comments')->rows(array('likes' => (int) $row['likes'] + 1))->where('coid = ?', $coid));

    
        if($updateRows){
            $num = $row['likes'] + 1;
            $state =  "success";
            
            //  添加点赞评论的 coid
            array_push($record, $coid);
            //  保存 Cookie
            Typecho_Cookie::set('__typecho_comment_likes_record', json_encode($record));
        }else{
            $num = $row['likes'];
            $state =  "error";
        }
        
    }else{
        $state = 'Illegal request';
    }  

    //返回一个jsonv数据state数据
    $archive->response->throwJson(array(
       "state" => $state,
       "num" => $num
    ));    

}


/**微语页面评论后端php代码**/


?>

