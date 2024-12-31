/*copyright ONEBLOG ©鲁子阳 V3.2 */

/*自定义鼠标右键*/
(function(a){a.fn.NZ_Menu=function(e){var c={items:[],fatype:"fas",bgcolor:"#fff",showbefore:null,showafter:null,closed:null,};var b=a.extend({},c,e);if(b.items.length===0){alert("没有找到菜单项！");return false}a(this).contextmenu(function(h){var f=a(this);if(f.data("nzmenuid")===null||typeof f.data("nzmenuid")==="undefined"){f.data("nzmenuid",d())}a(".NZ-Menu").each(function(){if(a(this).data("nzmenuid")===f.data("nzmenuid")){a(this).off("animationend webkitAnimationEnd").addClass("NZ-Menu-hidemenu").on("animationend webkitAnimationEnd",function(){a(this).remove()})}});if(typeof b.showbefore==="function"){b.showbefore()}var g=a('<ul class="NZ-Menu"></ul>');var i=a('<li class="hoverlayer"></li>');g.append(i).mouseleave(function(){i.css({opacity:0})}).data("nzmenuid",f.data("nzmenuid"));var j=false;a.each(b.items,function(m,o){var n=a('<li class="NZ-Menu-motion NZ-Menu-showitem">'+o.name+"</li>");if(typeof o.attrlist!=="undefined"&&o.attrlist!==null&&o.attrlist.length>0){for(var k=0;k<o.attrlist.length;k++){n.attr(o.attrlist[k].name,o.attrlist[k].val)}}if(typeof o.classlist!=="undefined"&&o.classlist!==null&&o.classlist.length>0){for(var l=0;l<o.classlist.length;l++){n.addClass(o.classlist[l])}}if(typeof o.icon!=="undefined"&&o.icon!==null&&o.icon!==""){n.append('<i class="'+b.fatype+" "+o.icon+'"></i>');j=true}n.click(function(){o.event()}).mouseenter({e:i},function(p){p.data.e.css({opacity:1,top:a(this).position().top,height:a(this).outerHeight()})}).css({"animation-delay":(0.1*m)+"s"}).on("animationend webkitAnimationEnd",function(p){p.stopPropagation()});g.append(n)});if(j){g.find("li").addClass("item-icon")}a(document.body).append(g);g.css({left:h.pageX,top:h.pageY});g.addClass("NZ-Menu-motion NZ-Menu-showmenu").on("animationend webkitAnimationEnd",function(){if(typeof b.showafter==="function"){b.showafter()}a(this).removeClass("NZ-Menu-showmenu")});a(document).bind("mousedown.nzmenu",function(k){switch(k.which){case 1:a(".NZ-Menu").each(function(l){a(this).off("animationend webkitAnimationEnd").css({"animation-delay":(l*0.1+0.2)+"s"}).addClass("NZ-Menu-hidemenu").on("animationend webkitAnimationEnd",function(){if(typeof b.closed==="function"){b.closed()}a(this).remove()})});a(document).unbind("click.nzmenu");break;case 3:break;case 2:break;default:break}});return false});function d(){return"NZ-MENU-"+"xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(f){var g=Math.random()*16|0,h=f=="x"?g:(g&3|8);return h.toString(16)})}}})(jQuery);


/*评论表单弹框说明*/

$(document).on('click', '#comment-notice', function() {    
    layer.msg('若您的留言审核通过并得到回复，本站将通过官方指定邮箱（onenotice@qq.com）发送邮件通知您，建议您将该邮箱设置为白名单。',{time:7000});
});    

$(document).on('click', '#comment-book', function() {    
    layer.msg('腹有诗书气自华，在书中与伟大的灵魂对话。',{time:5000});
});    

$(document).on('click', '#comment-mood', function() {    
    layer.msg('愿有岁月可回首，且以深情共白头。',{time:5000});
});    

/*初始化图片灯箱效果*/
$('[data-fancybox="gallery"]').fancybox({
    toolbar: true,
    buttons: [
        'fullScreen',
        'thumbs',
        'close'
    ],
    /*图片加载后替换默认的下载链接*/
    afterShow: function(instance, current) {
        var downloadLink = $(current.opts.$orig).data('download');
        
        if (downloadLink) {
            // 查找 FancyBox 的下载按钮并修改其 href 属性
            instance.$refs.toolbar.find('.fancybox-button--download').attr('href', downloadLink);
        }
    }
});


//点击加载更多
jQuery(document).ready(function($) {
    //点击下一页的链接(即那个a标签)
    $('.next').click(function() {
        $this = $(this);
        $this.addClass('loading').text('正在努力加载'); //给a标签加载一个loading的class属性，用来添加加载效果
        var href = $this.attr('href'); //获取下一页的链接地址
        if (href != undefined) { //如果地址存在
            $.ajax({ //发起ajax请求
                url: href,
                //请求的地址就是下一页的链接
                type: 'get',
                //请求类型是get
                error: function(request) {
                    //如果发生错误怎么处理
                },
                success: function(data) { //请求成功
                    $this.removeClass('loading').text('点击查看更多'); //移除loading属性
                    var $res = $(data).find('.grid,.post,.book-item'); //从数据中挑出文章数据，请根据实际情况更改
                    $('#photos,#bloglist,#books').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
                    
                    var newhref = $(data).find('.next').attr('href'); //找出新的下一页链接
                    if (newhref != undefined) {
                        $('.next').attr('href', newhref);
                    } else {
                        $('.next').remove(); //如果没有下一页了，隐藏
                        document.getElementById("no_more").innerHTML = "—&nbsp;&nbsp;&nbsp;暂无更多内容&nbsp;&nbsp;&nbsp;—";
                    }
                }
            });
        }
        return false;
    });
});

/*返回顶部,按钮在页面最底部固定浮动*/

$(document).ready(function(){
	$(window).scroll(function(){
		var scroTop = $(window).scrollTop();
        var awayBtm = $(document).height() - $(window).scrollTop() - $(window).height();
        var minAwayBtm = 270; //距离页面底部的最小距离
		if(scroTop>400){
			$('#gototop').fadeIn(500);
			$("#gototop").removeClass("hidden");
		}else {
			$('#gototop').fadeOut(500);
		}
		if (awayBtm <= minAwayBtm){
		    $("#gototop").addClass("newtotop");		    
		}else {
			$("#gototop").removeClass("newtotop");		    
		}
	});
	$('#gototop').click(function(){
		$("html,body").animate({scrollTop:0},"fast");
	});
});

var mobileHover = function () {
    $('*').on('touchstart', function () {
        $(this).trigger('hover');
    }).on('touchend', function () {
        $(this).trigger('hover');
    });
};


/** 用户登录弹框 **/
document.addEventListener('DOMContentLoaded', function() {
    var loginButton = document.getElementById('login-button');
    
    // 检查页面上是否存在登录按钮
    if (!loginButton) {
        return; // 如果没有登录按钮，则不加载登录代码
    }
    
    var maxAttempts = 5; // 最大尝试次数
    var lockoutMinutes = 180; // 锁定时间，以分钟为单位

    loginButton.addEventListener('click', openLoginPopup);

    function openLoginPopup() {
        if (isLockedOut()) {
            layer.msg(`登录过于频繁，请稍后再试！`);
            return;
        } else {
            clearLoginAttempts(); // 锁定时间过后清零尝试次数
        }

        layer.open({
            type: 1,
            title: ' ',
            area: ['400px', 'auto'],
            skin: 'layui-layer-mood',
            shadeClose: true,
            closeBtn: 1,
            content: `
                <form class="form" id="login-form" method="post">
                    <h3>登录</h3>
                    <div class="flex-column">
                        <label for="name">账号</label>
                        <div class="inputForm">
                            <i class="iconfont icon-zhanghao"></i>
                            <input required class="input" type="text" name="name" id="name" placeholder="请输入账号" />
                        </div>
                    </div>
                    <div class="flex-column">
                        <label for="password">密码</label>
                        <div class="inputForm">
                            <i class="iconfont icon-mima"></i>
                            <input required class="input" type="password" name="password" id="password" placeholder="请输入密码" />
                            <i class="iconfont icon-eye toggle-password" id="toggle-password"></i>
                        </div>
                    </div>
                    <button type="submit" id="submit-button" class="button-submit">登录</button>
                </form>
            `,
            success: function(layero, index) {
                var togglePassword = document.getElementById('toggle-password');
                var passwordInput = document.getElementById('password');

                // 密码可视化切换
                togglePassword.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePassword.classList.replace('icon-eye', 'icon-noeye');
                    } else {
                        passwordInput.type = 'password';
                        togglePassword.classList.replace('icon-noeye', 'icon-eye');
                    }
                });

                var loginForm = document.getElementById('login-form');
                var submitButton = document.getElementById('submit-button');

                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    submitButton.disabled = true;
                    submitButton.textContent = '正在登录，请稍后...';
                    submitButton.classList.add('not-allowed');

                    var formData = new FormData(loginForm);
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', loginAction, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                if (xhr.responseURL.includes('/admin/')) {
                                    clearLoginAttempts(); // 清除尝试次数
                                    location.reload();
                                } else {
                                    handleFailedLogin();
                                }
                            } else {
                                handleFailedLogin();
                            }
                            resetButtonState();
                        }
                    };
                    xhr.onerror = function() {
                        handleFailedLogin();
                        resetButtonState();
                    };
                    xhr.send(formData);
                });
            }
        });
    }

    function handleFailedLogin() {
        var attempts = parseInt(localStorage.getItem('loginAttempts') || '0');
        attempts += 1;
        localStorage.setItem('loginAttempts', attempts);

        if (attempts >= maxAttempts) {
            var lockoutTime = Date.now() + lockoutMinutes * 60 * 1000;
            localStorage.setItem('lockoutTime', lockoutTime);
            var lockoutHours = formatMinutesToHours(lockoutMinutes);
            layer.msg(`尝试次数过多，您已被锁定${lockoutHours}！`, {
                time: 3000 // 错误提示显示时间（毫秒）
            }, function() {
                layer.closeAll(); // 提示显示结束后关闭所有弹框
            });
        } else {
            layer.msg(`账号或密码错误，请检查后重新登录！`, {
                time: 2000 // 错误提示显示时间（毫秒）
            });
        }
    }

    function isLockedOut() {
        var lockoutTime = parseInt(localStorage.getItem('lockoutTime') || '0');
        return Date.now() < lockoutTime;
    }

    function clearLoginAttempts() {
        localStorage.removeItem('loginAttempts');
        localStorage.removeItem('lockoutTime');
    }

    function resetButtonState() {
        var submitButton = document.getElementById('submit-button');
        submitButton.disabled = false;
        submitButton.textContent = '登录';
        submitButton.classList.remove('not-allowed');
    }

    function formatMinutesToHours(minutes) {
        var hours = Math.floor(minutes / 60);
        var remainingMinutes = minutes % 60;
        return remainingMinutes > 0 ? `${hours}小时${remainingMinutes}分钟` : `${hours}小时`;
    }
});
/** 用户登录弹框结束 **/

/**动态发布弹框开始**/
$(document).ready(function() {
    $('#publish-button').on('click', function() {
        layer.open({
            type: 1,
            move: false,
            skin: 'layui-layer-publishmood',
            area: ['460px', '300px'], // 调整弹框大小
            title: '发布动态',
            shadeClose: true, // 点击遮罩关闭弹框
            content: '<div style="padding: 20px;"><form method="post" action="' + commentUrl + '" id="comment-form" role="form"><div class="clearfix"><div class="comment-textarea"><textarea rows="3" cols="50" name="text" id="textarea" class="textarea" required></textarea></div><div class="comment-submit"><button type="submit" class="submit">发布</button></div></div></form></div>'
        });
    });
});

/**动态发布弹框结束**/

/***评论点赞以及计数***/
$(document).ready(function() {
    $("#comments").on('click', "a[id^='commentLikeOpt']", function() {
        var coid = $(this).data("coid");
        var recording = $(this).attr("data-recording");
        if(recording){
            alert("你已经点过赞啦！感谢你的喜爱！");
            return;
        }
        $.ajax({
            url: commentLikeUrl,
            type: "POST",
            data: {
                coid: coid,
                behavior: 'dz'
            },
            async: true,
            dataType: "json",
            success: function(data) {
                if (data == null) {} else {
                    if(data.state == 'success'){
                        $('#commentLikeSpan-'+coid).text(data.num);
                        $('#commentLikeI-'+coid).removeClass("icon-like").addClass("icon-liked");
                        $('#commentLikeOpt-'+coid).attr("data-recording", "1");
                    } else {
                        alert(data.message || "点赞失败，请稍后重试");
                    }
                }
            },
            error: function(err) {
                alert("点赞失败，请稍后重试");
            }
        });
    });
});
/***评论点赞结束***/




/*选项卡切换*/
/* idTabs ~ Sean Catchpole - Version 2.2 - MIT/GPL */
(function(){var dep={"jQuery":"https://code.jquery.com/jquery-latest.min.js"};var init=function(){(function($){$.fn.idTabs=function(){var s={};for(var i=0;i<arguments.length;++i){var a=arguments[i];switch(a.constructor){case Object:$.extend(s,a);break;case Boolean:s.change=a;break;case Number:s.start=a;break;case Function:s.click=a;break;case String:if(a.charAt(0)=='.')s.selected=a;else if(a.charAt(0)=='!')s.event=a;else s.start=a;break;}}
if(typeof s['return']=="function")
s.change=s['return'];return this.each(function(){$.idTabs(this,s);});}
$.idTabs=function(tabs,options){var meta=($.metadata)?$(tabs).metadata():{};var s=$.extend({},$.idTabs.settings,meta,options);if(s.selected.charAt(0)=='.')s.selected=s.selected.substr(1);if(s.event.charAt(0)=='!')s.event=s.event.substr(1);if(s.start==null)s.start=-1;var showId=function(){if($(this).is('.'+s.selected))
return s.change;var id="#"+this.href.split('#')[1];var aList=[];var idList=[];$("a",tabs).each(function(){if(this.href.match(/#/)){aList.push(this);idList.push("#"+this.href.split('#')[1]);}});if(s.click&&!s.click.apply(this,[id,idList,tabs,s]))return s.change;for(i in aList)$(aList[i]).removeClass(s.selected);for(i in idList)$(idList[i]).hide();$(this).addClass(s.selected);$(id).show();return s.change;}
var list=$("a[href*='#']",tabs).unbind(s.event,showId).bind(s.event,showId);list.each(function(){$("#"+this.href.split('#')[1]).hide();});var test=false;if((test=list.filter('.'+s.selected)).length);else if(typeof s.start=="number"&&(test=list.eq(s.start)).length);else if(typeof s.start=="string"&&(test=list.filter("[href*='#"+s.start+"']")).length);if(test){test.removeClass(s.selected);test.trigger(s.event);}
return s;}
$.idTabs.settings={start:0,change:false,click:null,selected:".selected",event:"!click"};$.idTabs.version="2.2";$(function(){$(".idTabs").idTabs();});})(jQuery);}
var check=function(o,s){s=s.split('.');while(o&&s.length)o=o[s.shift()];return o;}
var head=document.getElementsByTagName("head")[0];var add=function(url){var s=document.createElement("script");s.type="text/javascript";s.src=url;head.appendChild(s);}
var s=document.getElementsByTagName('script');var src=s[s.length-1].src;var ok=true;for(d in dep){if(check(this,d))continue;ok=false;add(dep[d]);}if(ok)return init();add(src);})();


/*打字冒光*/
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["POWERMODE"] = factory();
	else
		root["POWERMODE"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var canvas = document.createElement('canvas');
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	canvas.style.cssText = 'position:fixed;top:0;left:0;pointer-events:none;z-index:999999';
	window.addEventListener('resize', function () {
	    canvas.width = window.innerWidth;
	    canvas.height = window.innerHeight;
	});
	document.body.appendChild(canvas);
	var context = canvas.getContext('2d');
	var particles = [];
	var particlePointer = 0;

	POWERMODE.shake = true;

	function getRandom(min, max) {
	    return Math.random() * (max - min) + min;
	}

	function getColor(el) {
	    if (POWERMODE.colorful) {
	        var u = getRandom(0, 360);
	        return 'hsla(' + getRandom(u - 10, u + 10) + ', 100%, ' + getRandom(50, 80) + '%, ' + 1 + ')';
	    } else {
	        return window.getComputedStyle(el).color;
	    }
	}

	function getCaret() {
	    var el = document.activeElement;
	    var bcr;
	    if (el.tagName === 'TEXTAREA' ||
	        (el.tagName === 'INPUT' && el.getAttribute('type') === 'text')) {
	        var offset = __webpack_require__(1)(el, el.selectionStart);
	        bcr = el.getBoundingClientRect();
	        return {
	            x: offset.left + bcr.left,
	            y: offset.top + bcr.top,
	            color: getColor(el)
	        };
	    }
	    var selection = window.getSelection();
	    if (selection.rangeCount) {
	        var range = selection.getRangeAt(0);
	        var startNode = range.startContainer;
	        if (startNode.nodeType === document.TEXT_NODE) {
	            startNode = startNode.parentNode;
	        }
	        bcr = range.getBoundingClientRect();
	        return {
	            x: bcr.left,
	            y: bcr.top,
	            color: getColor(startNode)
	        };
	    }
	    return { x: 0, y: 0, color: 'transparent' };
	}

	function createParticle(x, y, color) {
	    return {
	        x: x,
	        y: y,
	        alpha: 1,
	        color: color,
	        velocity: {
	            x: -1 + Math.random() * 2,
	            y: -3.5 + Math.random() * 2
	        }
	    };
	}

	function POWERMODE() {
	    { // spawn particles
	        var caret = getCaret();
	        var numParticles = 5 + Math.round(Math.random() * 10);
	        while (numParticles--) {
	            particles[particlePointer] = createParticle(caret.x, caret.y, caret.color);
	            particlePointer = (particlePointer + 1) % 500;
	        }
	    }
	    { // shake screen
	        if (POWERMODE.shake) {
	            var intensity = 1 + 2 * Math.random();
	            var x = intensity * (Math.random() > 0.5 ? -1 : 1);
	            var y = intensity * (Math.random() > 0.5 ? -1 : 1);
	            document.body.style.marginLeft = x + 'px';
	            document.body.style.marginTop = y + 'px';
	            setTimeout(function() {
	                document.body.style.marginLeft = '';
	                document.body.style.marginTop = '';
	            }, 75);
	        }
	    }
	};
	POWERMODE.colorful = false;

	function loop() {
	    requestAnimationFrame(loop);
	    context.clearRect(0, 0, canvas.width, canvas.height);
	    for (var i = 0; i < particles.length; ++i) {
	        var particle = particles[i];
	        if (particle.alpha <= 0.1) continue;
	        particle.velocity.y += 0.075;
	        particle.x += particle.velocity.x;
	        particle.y += particle.velocity.y;
	        particle.alpha *= 0.96;
	        context.globalAlpha = particle.alpha;
	        context.fillStyle = particle.color;
	        context.fillRect(
	            Math.round(particle.x - 1.5),
	            Math.round(particle.y - 1.5),
	            3, 3
	        );
	    }
	}
	requestAnimationFrame(loop);

	module.exports = POWERMODE;


/***/ },
/* 1 */
/***/ function(module, exports) {

	/* jshint browser: true */

	(function () {

	// The properties that we copy into a mirrored div.
	// Note that some browsers, such as Firefox,
	// do not concatenate properties, i.e. padding-top, bottom etc. -> padding,
	// so we have to do every single property specifically.
	var properties = [
	  'direction',  // RTL support
	  'boxSizing',
	  'width',  // on Chrome and IE, exclude the scrollbar, so the mirror div wraps exactly as the textarea does
	  'height',
	  'overflowX',
	  'overflowY',  // copy the scrollbar for IE

	  'borderTopWidth',
	  'borderRightWidth',
	  'borderBottomWidth',
	  'borderLeftWidth',
	  'borderStyle',

	  'paddingTop',
	  'paddingRight',
	  'paddingBottom',
	  'paddingLeft',

	  // https://developer.mozilla.org/en-US/docs/Web/CSS/font
	  'fontStyle',
	  'fontVariant',
	  'fontWeight',
	  'fontStretch',
	  'fontSize',
	  'fontSizeAdjust',
	  'lineHeight',
	  'fontFamily',

	  'textAlign',
	  'textTransform',
	  'textIndent',
	  'textDecoration',  // might not make a difference, but better be safe

	  'letterSpacing',
	  'wordSpacing',

	  'tabSize',
	  'MozTabSize'

	];

	var isFirefox = window.mozInnerScreenX != null;

	function getCaretCoordinates(element, position, options) {

	  var debug = options && options.debug || false;
	  if (debug) {
	    var el = document.querySelector('#input-textarea-caret-position-mirror-div');
	    if ( el ) { el.parentNode.removeChild(el); }
	  }

	  // mirrored div
	  var div = document.createElement('div');
	  div.id = 'input-textarea-caret-position-mirror-div';
	  document.body.appendChild(div);

	  var style = div.style;
	  var computed = window.getComputedStyle? getComputedStyle(element) : element.currentStyle;  // currentStyle for IE < 9

	  // default textarea styles
	  style.whiteSpace = 'pre-wrap';
	  if (element.nodeName !== 'INPUT')
	    style.wordWrap = 'break-word';  // only for textarea-s

	  // position off-screen
	  style.position = 'absolute';  // required to return coordinates properly
	  if (!debug)
	    style.visibility = 'hidden';  // not 'display: none' because we want rendering

	  // transfer the element's properties to the div
	  properties.forEach(function (prop) {
	    style[prop] = computed[prop];
	  });

	  if (isFirefox) {
	    // Firefox lies about the overflow property for textareas: https://bugzilla.mozilla.org/show_bug.cgi?id=984275
	    if (element.scrollHeight > parseInt(computed.height))
	      style.overflowY = 'scroll';
	  } else {
	    style.overflow = 'hidden';  // for Chrome to not render a scrollbar; IE keeps overflowY = 'scroll'
	  }

	  div.textContent = element.value.substring(0, position);
	  // the second special handling for input type="text" vs textarea: spaces need to be replaced with non-breaking spaces - http://stackoverflow.com/a/13402035/1269037
	  if (element.nodeName === 'INPUT')
	    div.textContent = div.textContent.replace(/\s/g, "\u00a0");

	  var span = document.createElement('span');
	  // Wrapping must be replicated *exactly*, including when a long word gets
	  // onto the next line, with whitespace at the end of the line before (#7).
	  // The  *only* reliable way to do that is to copy the *entire* rest of the
	  // textarea's content into the <span> created at the caret position.
	  // for inputs, just '.' would be enough, but why bother?
	  span.textContent = element.value.substring(position) || '.';  // || because a completely empty faux span doesn't render at all
	  div.appendChild(span);

	  var coordinates = {
	    top: span.offsetTop + parseInt(computed['borderTopWidth']),
	    left: span.offsetLeft + parseInt(computed['borderLeftWidth'])
	  };

	  if (debug) {
	    span.style.backgroundColor = '#aaa';
	  } else {
	    document.body.removeChild(div);
	  }

	  return coordinates;
	}

	if (typeof module != "undefined" && typeof module.exports != "undefined") {
	  module.exports = getCaretCoordinates;
	} else {
	  window.getCaretCoordinates = getCaretCoordinates;
	}

	}());

/***/ }
/******/ ])
});
;
/*打字冒光结束*/

