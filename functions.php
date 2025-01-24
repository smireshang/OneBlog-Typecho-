<?php
/*copyright ONEBLOG ©鲁子阳 V3.3 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
											   
//主题设置自定义
function themeConfig($form) {?>
    <link rel="stylesheet" href="<?php echo Helper::options()->themeUrl('assets/css/theme.css'); ?>" type="text/css" />
    <script src="<?php echo Helper::options()->themeUrl('assets/js/theme.js'); ?>" type="text/javascript"></script>
    <div class="OneBlog"><h3>ONEBLOG 主题设置</h3></div>
    <div id="tab-container">
        <ul id="tab-nav"></ul>
        <div id="tab-content">
            <div id="tab1" class="tab-pane active">
                <h2>OneBlog V3.3</h2>
                <p>本主题精心打磨多年，且持续优化，现免费开源，致敬Typecho以及各路大神的开源精神，也致敬热爱文字和记录的我们。最新版本请前往<b></b>主题官网</b>：<a href="https://oneblog.co/theme/" target="_blank">oneblog.co</a> 获取，开发版本请前往Github仓库：<a href="https://github.com/LawyerLu/OneBlog" target="_blank">OneBlog</a> 查看，记得给★Star。</p>
                <p>本主题仅有微信交流群，其他均不是官方群组。如需加群，请通过官方仓库<a href="https://github.com/LawyerLu/OneBlog" target="_blank">OneBlog</a>或<a href="https://gitcode.com/LawyerLu/OneBlog" target="_blank">国内镜像仓库</a>获取最新群二维码。</p>
                <p>主题图标库（可直接引用，如 "iconfont icon-home"）：</p>
                <div class="icon-list" id="iconList"></div>
            </div>
        </div>
    </div>
    <?php
    
    //—————————————————————————————————————— 基础设置 ——————————————————————————————————————
    
    //PC端logo
    $logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, NULL, _t('PC端LOGO'), _t('请输入logo图片的url,建议填写正方形logo，填写后会显示在独立页面的顶栏。'));
    $form->addInput($logo); 
    
    //网站slogo
    $slogan = new Typecho_Widget_Helper_Form_Element_Text('slogan', NULL, NULL, _t('网站slogan'), _t('一句话介绍网站，填写后会显示在独立页面的顶栏和首页的标题中。'));
    $form->addInput($slogan);  
    
    //网站favicon
    $Favicon = new Typecho_Widget_Helper_Form_Element_Text('Favicon', NULL, NULL, _t('Favicon'), _t('请输入网站favicon图片的url。'));
    $form->addInput($Favicon); 
 
    // 首页杂志效果开关
    $switch = new Typecho_Widget_Helper_Form_Element_Radio('switch', array('on' => '显示','off' => '不显示'),'on', '首页是否显示Banner文章', '选择开启则需要填写下方的文章cid；PC端会在首页顶部显示杂志效果文章，移动端会在首页顶部显示幻灯片自动切换。');
    $form->addInput($switch);
    
    // 首页杂志效果文章
    $Banner = new Typecho_Widget_Helper_Form_Element_Text('Banner', NULL, NULL, _t('首页banner文章cid'), _t('用英文逗号隔开，限3个,填需要显示在banner区域三篇文章的cid。'));
    $form->addInput($Banner);   
    
    // 全站右键菜单
    $Menu = new Typecho_Widget_Helper_Form_Element_Radio('Menu', array('on' => '开启','off' => '不开启'),'off','网站右键菜单', '默认关闭，开启后PC端在博客点击鼠标右键会替换默认的右键菜单，替换为博客的菜单，建议在网站全部调试完毕后再开启');
    $form->addInput($Menu); 
    
    // 文章默认缩略图
    $NoPostIMG = new Typecho_Widget_Helper_Form_Element_Text('NoPostIMG', NULL, NULL, _t('文章默认缩略图'), _t('请填写图片地址，只会显示在文章详情页底部的上下篇封面，在没有设置文章缩略图时显示。'));
    $form->addInput($NoPostIMG); 
    
    $Webthumb = new Typecho_Widget_Helper_Form_Element_Text('Webthumb', NULL, NULL, _t('网站标识图'), _t('请填写图片地址，
    用于网站首页的 Open Graph 信息。'));
    $form->addInput($Webthumb); 
    
    //网站备案号
    $ICP = new Typecho_Widget_Helper_Form_Element_Text('ICP', NULL, NULL, _t('网站备案号'), _t('如有，请填写网站备案号。'));
    $form->addInput($ICP);   
    
    //建站年份
    $Webtime = new Typecho_Widget_Helper_Form_Element_Text('Webtime', NULL, NULL, _t('建站年份'), _t('填写后显示在网站底栏，格式：2016，如果是今年刚建站，请勿填写。'));
    $form->addInput($Webtime);   
    
    //—————————————————————————————————————— 高级设置 ——————————————————————————————————————
    
    // 添加自定义 DNS 预解析域名字段
    $dnsPrefetch = new Typecho_Widget_Helper_Form_Element_Textarea('dnsPrefetch',NULL,NULL,_t('DNS预解析域名'),_t('请输入需要预解析的域名，每行一个。例如：<br>https://oneblog.me<br>https://cdn.oneblog.me')
    );
    $form->addInput($dnsPrefetch);
    
    // 代码块美化
    $BeCode = new Typecho_Widget_Helper_Form_Element_Radio('BeCode', array('on' => '开启','off' => '不开启'),'on','代码块美化', '默认开启，开启后会美化代码区域，技术博客请开启，否则代码块会显示异常，纯生活记录类博客建议关闭。');
    $form->addInput($BeCode); 
    
    // 禁用F12
    $F12 = new Typecho_Widget_Helper_Form_Element_Radio('F12', array('on' => '开启','off' => '不开启'),'off','禁用F12', '默认关闭，开启后未登录用户会禁用浏览器F12调试功能。');
    $form->addInput($F12); 
    
    // 禁用右键
    $RightClick = new Typecho_Widget_Helper_Form_Element_Radio('RightClick', array('on' => '开启','off' => '不开启'),'off','禁用右键', '默认关闭，开启后未登录用户会禁用右键，本功能与主题的右键菜单不冲突。');
    $form->addInput($RightClick); 
    
    // 禁用复制
    $Copy = new Typecho_Widget_Helper_Form_Element_Radio('Copy', array('on' => '开启','off' => '不开启'),'off','禁用复制功能', '默认关闭，开启后未登录用户会禁用复制功能，如果想让友情链接页面允许复制，请将友链slug修改为links。');
    $form->addInput($Copy); 
    
    // 随机高清文艺图片源
    $RandomIMG = new Typecho_Widget_Helper_Form_Element_Radio('RandomIMG', array('oneblog' => '主题图库','off' => '关闭'),'off','随机高清缩略图', '设置后文章外显示随机缩略图，如果想让文章详情页显示封面图，请编辑文章时填写自定义字段[文章封面]。');
    $form->addInput($RandomIMG);  

    // 文章页随机缩略图开关
    $ListThumb = new Typecho_Widget_Helper_Form_Element_Radio('ListThumb', array('on' => '开启','off' => '不开启'),'off','首页/文章列表页随机缩略图', '默认关闭，开启后列表页未设置缩略图的文章将显示随机缩略图，图片源在上方设置，未设置图源不会生效。');
    $form->addInput($ListThumb); 
    
    $Unsplash_API = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_API', NULL, NULL, _t('Unsplash API'), _t('请填写Unsplash API提供的accessKey，用于随机文艺图片的获取以及Unsplash相册的同步'));
    $form->addInput($Unsplash_API);
    
    // Unsplash照片同步
    $Unsplash = new Typecho_Widget_Helper_Form_Element_Radio('Unsplash', array('on' => '开启','off' => '不开启'),'off','Unsplash照片同步', '默认关闭，开启后PC端在相册页面会出现同步Unsplash照片的功能按钮，点击按钮会自动同步指定用户的照片信息到博客后台，如果开启本功能，需要填写Unsplash API、Unsplash作者用户名、相册mid，否则不会生效');
    $form->addInput($Unsplash); 
    
    //Unsplash用户名
    $Unsplash_User = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_User', NULL, NULL, _t('Unsplash作者用户名'), _t('请填写Unsplash用户名，用于同步该用户发布的摄影作品。'));
    $form->addInput($Unsplash_User);
 
    //相册分类mid
    $Unsplash_Cat = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_Cat', NULL, NULL, _t('相册mid'), _t('请填写相册分类的mid，用于同步摄影作品时自动勾选该分类。'));
    $form->addInput($Unsplash_Cat);
    
    // 开启评论者地域显示
    $IpCity = new Typecho_Widget_Helper_Form_Element_Radio('IpCity', array('on' => '开启','off' => '不开启'),'off','评论者地区显示', '默认关闭，开启后在评论列表会显示评论者所处的地区，启用此功能，需要先申请高德key并填写在下方，否则不会生效。');
    $form->addInput($IpCity); 
    
    $Amap_API = new Typecho_Widget_Helper_Form_Element_Text('Amap_API', NULL, NULL, _t('高德地图 应用KEY'), _t('请填写高德地图中申请到的应用KEY，用于显示评论者所属地区。'));
    $form->addInput($Amap_API);
    
    
    //—————————————————————————————————————— 移动端设置 ——————————————————————————————————————
    
    //移动端logo
    $Mlogo = new Typecho_Widget_Helper_Form_Element_Text('Mlogo', NULL, NULL, _t('移动端logo'), _t('填写移动端logo的url地址，建议尺寸：300×115 建议格式：svg'));
    $form->addInput($Mlogo);  
 
    //移动端文章列表顶部背景
    $ArticleListBg = new Typecho_Widget_Helper_Form_Element_Text('ArticleListBg', NULL, NULL, _t('移动端文章列表顶部默认背景'), _t('填写背景图片的url地址，主要用于标签页、分类页等文章列表页顶部背景，如果想单独设置分类页的顶部背景，请在分类描述中填写图片url'));
    $form->addInput($ArticleListBg);  
    
    
    //—————————————————————————————————————— 社交按钮 ——————————————————————————————————————

    $Weibo = new Typecho_Widget_Helper_Form_Element_Text('Weibo', NULL, NULL, _t('微博主页'), _t('请填写微博主页链接。'));
    $form->addInput($Weibo);   
    
    $Weixin = new Typecho_Widget_Helper_Form_Element_Text('Weixin', NULL, NULL, _t('微信公众号'), _t('请填写微信公众号或个人微信的二维码原创图片url，格式为:https://。'));
    $form->addInput($Weixin);   
    
    $Email = new Typecho_Widget_Helper_Form_Element_Text('Email', NULL, NULL, _t('邮箱'), _t('请填写站长邮箱。'));
    $form->addInput($Email);
    
    $Github = new Typecho_Widget_Helper_Form_Element_Text('Github', NULL, NULL, _t('Github'), _t('请填写Github地址。'));
    $form->addInput($Github);
 
}
 
 //文章自定义字段  需要优化提示
function themeFields($layout) { 
  
 	$thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('封面图片'), _t('用于文章头图、书籍封面、相册缩略图、页面封面图，建议用小尺寸图片。'));
    $layout->addItem($thumb);  
 
    $origin = new Typecho_Widget_Helper_Form_Element_Text('origin', NULL, NULL, _t('图片来源'), _t('请输入图片的版权所有人名称或网站名（如：Unsplash）'));
    $layout->addItem($origin);  
    
    $author = new Typecho_Widget_Helper_Form_Element_Text('author', NULL, NULL, _t('作者'), _t('不填则默认为原创文章，作者为账号本人。建议根据内容权属填写著作权人，书单填写书籍作者，如果是Unsplash同步过来的照片，会自动获取照片作者，无需填写。'));
    $layout->addItem($author);  
    
    /**文章分类为相册时的专用字段**/
 	$photo = new Typecho_Widget_Helper_Form_Element_Text('photo', NULL, NULL, _t('原图'), _t('必填，相册专用字段，在这里填入原图地址，未填写则直接调用缩略图。'));
    $layout->addItem($photo);
    
 	$Unsplash_ID = new Typecho_Widget_Helper_Form_Element_Text('Unsplash_ID', NULL, NULL, _t('Unsplash图片ID'), _t('相册专用字段,不要手动填写，自动识别填写，请勿擅自改动，建议隐藏。用于保证图片同步的一致性。'));
    $layout->addItem($Unsplash_ID);

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
    if ($archive->is('category', 'photos')) {
        $archive->parameter->pageSize = 24; // 自定义条数
    }
    
    if ($archive->is('category', 'books')) {
        $archive->parameter->pageSize = 24; // 自定义条数
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
$t = Typecho_Widget::widget('Widget_Archive@1');//@的作用用来区分
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
$t = Typecho_Widget::widget('Widget_Archive@2');//@的作用用来区分，保持唯一性即可
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
    $nothumb = Helper::options()->themeUrl . '/assets/default/bg.jpg';
    $defaultthumb = Helper::options()->NoPostIMG;
    // 如果文章有缩略图，返回缩略图
    if ($widget->fields->thumb) {
        return $widget->fields->thumb();
    }
    // 如果文章内容有图片，返回第一张图片作为缩略图
    $content = $widget->content;
    preg_match_all('/<img.*?src=["\'](.*?)["\']/', $content, $matches);
    if (isset($matches[1][0])) {
        echo $matches[1][0];
        return;
    }
    // 如果开启了随机缩略图
    if (Helper::options()->RandomIMG == 'oneblog'){
        $randomParam = '?t=' . time() . rand(1, 1000);
        echo Helper::options()->themeUrl . '/api/RandomPic.php' . $randomParam;
        return;
    }
    // 如果设置了默认缩略图
    if ($defaultthumb){
        echo $defaultthumb;
        return;
    }
    // 如果没有设置，则显示默认图片
    echo $nothumb;
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


/**表情短代码解析**/
function parseEmojis($content) {
    $emojiPath = '/usr/themes/OneBlog/assets/img/emoji/';
    return preg_replace_callback('/\[emoji:([a-zA-Z0-9_]+)\]/', function($matches) use ($emojiPath) {
        $emojiName = $matches[1];
        return '<img src="' . $emojiPath . $emojiName . '.svg" alt="' . $emojiName . '">';
    }, $content);
}


/**文章内灯箱效果解析**/
function AutoLightbox($content) {
    if (empty($content)) {
        return $content;
    }
    $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';
    if (!preg_match($pattern, $content)) {
        return $content;
    }
    $replacement = '<a data-fancybox="gallery" href="$1"><img class="lazy-load" data-src="$1" src="$1" /></a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}


/**评论来源地区显示***/
function getLocationByIP($ip) {
    $apiKey = Helper::options()->Amap_API;
    if (empty($apiKey)) {
        return '';
    }
    if (strpos($ip, '0.0.0.0') === 0 || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return '';
    }
    $url = "https://restapi.amap.com/v3/ip?ip={$ip}&key={$apiKey}";
    $response = @file_get_contents($url);

    if ($response === FALSE) {
        return '';
    }
    $data = json_decode($response, true);
    if ($data['status'] == '1' && !empty($data['province'])) {
        $province = $data['province'];
        $province = str_replace(['省', '市'], '', $province);
        return $province;
    } else {
        return '';
    }
}
