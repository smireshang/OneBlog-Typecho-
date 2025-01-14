/*copyright ONEBLOG ©鲁子阳 V3.2 */
function GetSlideDirection(startX, startY, endX, endY) {  
      var dy = startY - endY;  
      //var dx = endX - startX;  
      var result = 0; 
      if(dy>0) {//向上滑动
              result=1;
      }else{//向下滑动
              result=2;
      }
      return result;  
  } 

//滑动处理  
var startX, startY;  
document.addEventListener('touchstart',function (ev) {  
    startX = ev.touches[0].pageX;  
    startY = ev.touches[0].pageY;    
}, false); 
document.addEventListener('touchend',function (ev) {  
      var endX, endY;  
      endX = ev.changedTouches[0].pageX;  
      endY = ev.changedTouches[0].pageY;  
      var direction = GetSlideDirection(startX, startY, endX, endY);
      switch(direction) {  
          case 0:  
              break;  
          case 1:  
              // 向上
              $(".top-menu").removeClass("scrolled"); 
              break;  
          case 2:  
              // 向下
             $(".top-menu").addClass("scrolled"); 
              break;  
        
          default:             
      }  
  }, false); 

/*评论表单弹框说明*/

$(document).on('click', '#comment-notice', function() {    
    layer.msg('若您的留言审核通过并得到回复，本站将通过官方指定邮箱（onenotice@qq.com）发送邮件通知您，建议您将该邮箱设置为白名单。',{time:7000});
});   

$(document).on('click', '#comment-book', function() {    
    layer.msg('腹有诗书气自华，在书中与伟大的灵魂对话。',{time:5000});
});    

/*移动端导航条*/
$("#sidebarToggler").click(function () {
    var sideBar = $("#sideBar");
    if (!sideBar.hasClass("addWidth")) {
        $("#sideBar").addClass("addWidth");
    }
    else {
        $("#sideBar").removeClass("addWidth");
    }
    var no_Scroll = $(".content");
    if (!no_Scroll.hasClass("no-scroll")) {
        $(".content").addClass("no-scroll");
    }
    else {
       $(".content").removeClass("no-scroll"); 
    }
    var noScroll = $("body");
    if (!noScroll.hasClass("noscroll")) {
        $("body").addClass("noscroll");
    }
    else {
       $("body").removeClass("noscroll"); 
    }
    var Flur = $(".header");
    if (!Flur.hasClass("no-scroll")) {
        $(".header").addClass("no-scroll");
    }
    else {
       $(".header").removeClass("no-scroll"); 
    }
})

$("#close-nav").click(function(){
    $("#sideBar").removeClass("addWidth");
    $(".content").removeClass("no-scroll"); 
    $(".header").removeClass("no-scroll"); 
    $("body").removeClass("noscroll"); 
})


//点击加载更多
jQuery(document).ready(function($) {
    $('.next').click(function() {
        $this = $(this);
        $this.addClass('loading').text('正在努力加载'); 
        var href = $this.attr('href'); 
        if (href != undefined) { 
            $.ajax({ //发起ajax请求
                url: href,
                type: 'get',
                error: function(request) {
                },
                success: function(data) { //请求成功
                    $this.removeClass('loading').text('点击查看更多'); 
                    var $res = $(data).find('.grid,.post_all,.book-item'); //从数据中挑出文章数据，请根据实际情况更改
                    $('#photos,#bloglist,#books').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
                    var newhref = $(data).find('.next').attr('href'); 
                    if (newhref != undefined) {
                        $('.next').attr('href', newhref);
                    } else {
                        $('.next').remove(); //如果没有下一页了，隐藏
                        $('#load-more').html('—&nbsp;&nbsp;&nbsp;暂无更多内容&nbsp;&nbsp;&nbsp;—'); // 显示提示
                    }
                }
            });
        }
        return false;
    });
});


/**触底自动加载下一页**/
document.addEventListener('DOMContentLoaded', function() {
    let isLoading = false; // 防止重复加载
    const loadMoreButton = document.getElementById('load-more');
    const contentContainer = document.getElementById('bloglist') || document.getElementById('books') || document.getElementById('photos');   // 兼容相册和书单

    if (!loadMoreButton || !contentContainer) return; // 如果缺少必要元素，直接退出

    window.addEventListener('scroll', function() {
        // 判断是否滚动到底部
        if (isLoading || !loadMoreButton) return;

        const loadMoreButtonRect = loadMoreButton.getBoundingClientRect();
        if (loadMoreButtonRect.top <= window.innerHeight) {
            isLoading = true;
            loadMoreButton.click(); // 模拟点击加载更多按钮
        }
    });

    // 监听加载更多按钮的点击事件
    loadMoreButton.addEventListener('click', function(event) {
        event.preventDefault();
        const nextPageUrl = loadMoreButton.querySelector('a')?.href; // 使用可选链操作符避免报错
        if (!nextPageUrl) {
            loadMoreButton.innerHTML = '<div class="end">END</div>'; // 显示提示
            return;
        }

        fetch(nextPageUrl)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newPosts = doc.getElementById('bloglist')?.innerHTML || doc.getElementById('books')?.innerHTML || doc.getElementById('photos')?.innerHTML; // 兼容相册和书单
                const newLoadMoreButton = doc.getElementById('load-more');

                if (newPosts) {
                    contentContainer.innerHTML += newPosts; // 追加新内容
                }
                if (newLoadMoreButton) {
                    loadMoreButton.innerHTML = newLoadMoreButton.innerHTML; // 更新加载更多按钮
                } else {
                    loadMoreButton.innerHTML = '<div class="end">END</div>'; // 显示提示
                }

                isLoading = false;
            })
            .catch(error => {
                console.error('Error loading more posts:', error);
                isLoading = false;
            });
    });
});


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
$(document).ready(function () {
    $('#publish-button').on('click', function () {
        // 获取 CSRF Token 和评论接口 URL
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const commentUrl = document.querySelector('meta[name="comment-url"]').getAttribute('content');

        layer.open({
            type: 1,
            move: false,
            skin: 'layui-layer-publishmood',
            area: ['360px', '300px'], // 调整弹框大小
            title: '发布动态',
            shadeClose: true, // 点击遮罩关闭弹框
            content: `
                <div style="padding: 20px;">
                    <form id="comment-form" method="post" action="${commentUrl}" role="form">
                        <div class="clearfix">
                            <div class="comment-textarea">
                                <textarea rows="3" cols="50" name="text" id="textarea" class="textarea" required></textarea>
                            </div>
                            <input type="hidden" name="_" value="${csrfToken}">
                            <div class="comment-submit">
                                <button type="button" id="submit-button" class="submit">发布</button>
                            </div>
                        </div>
                    </form>
                </div>
            `
        });

        // 发布按钮点击事件
        $('#submit-button').on('click', function () {
            const textContent = $('#textarea').val();
            if (!textContent) {
                layer.msg('请输入内容！');
                return;
            }

            // 使用 AJAX 提交表单
            const formData = $('#comment-form').serialize(); // 获取表单数据，包括隐藏的 _token
            $.ajax({
                url: commentUrl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response && response.error) {
                        layer.msg(response.error, { icon: 2 });
                    } else {
                        layer.closeAll(); 
                        layer.msg('发布成功！'); 
                        
                        // 延迟2秒后刷新页面
                        setTimeout(function() {
                            location.reload(); 
                        }, 1500); // 延迟1.5s刷新页面

                    }
                },
                error: function () {
                    layer.msg('发布失败，请稍后重试！', { icon: 2 });
                }
            });
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

/**首页轮播图初始化**/
if (window.location.pathname === '/' || window.location.pathname === '/index') {
    var mySwiper = new Swiper('.swiper', {
        autoplay: true, // 可选选项，自动滑动
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },
    });
    new Swiper('.swiper');
    var mySwiper = document.querySelector('.swiper').swiper;
    mySwiper.slideNext();
}

/**开源不易，请尊重作者的版权，保留本信息**/
function showConsoleInfo() {
    const version = '3.3';
    const copyright = '自豪地使用OneBlog主题';
    console.log(
        `\n%c ${copyright} Version ${version} `,
        'padding: 1px 5px;font-size: 12px;background: #222222;color: #ebb561;',
    );
    console.log('开源不易，请尊重作者版权，保留基本的版权信息。');
}
// 调用函数
showConsoleInfo();


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

const _0x23e4=['YXBwbHk=','Y29uc3RydWN0b3I=','Y29tcGlsZQ==','Z2V0RWxlbWVudEJ5SWQ=','YXV0aG9yLWluZm8=','dHJpbQ==','dGV4dENvbnRlbnQ=','T25lQmxvZw==','Ym9keQ==','aW5uZXJIVE1M','CiAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvcHlyaWdodC1pbmZvIj4KICAgICAgICAgICAgICAgIOW8gOa6kOS4jeaYk++8jOivt+WwiumHjeS9nOiAheeJiOadg++8jOS/neeVmeWfuuacrOeahOeJiOadg+S/oeaBr+OAggogICAgICAgICAgICA8L2Rpdj4KICAgICAgICA=','b25sb2Fk'];const _0x2265=function(_0x23e440,_0x226521){_0x23e440=_0x23e440-0x0;let _0x576480=_0x23e4[_0x23e440];if(_0x2265['DVczPF']===undefined){(function(){const _0x199af4=function(){let _0x5150b2;try{_0x5150b2=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(_0x2ffa37){_0x5150b2=window;}return _0x5150b2;};const _0x351656=_0x199af4();const _0x3769d6='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x351656['atob']||(_0x351656['atob']=function(_0x4b0c56){const _0x4f038c=String(_0x4b0c56)['replace'](/=+$/,'');let _0x47873c='';for(let _0x2944f7=0x0,_0x4c0632,_0x2af0d5,_0xac3541=0x0;_0x2af0d5=_0x4f038c['charAt'](_0xac3541++);~_0x2af0d5&&(_0x4c0632=_0x2944f7%0x4?_0x4c0632*0x40+_0x2af0d5:_0x2af0d5,_0x2944f7++%0x4)?_0x47873c+=String['fromCharCode'](0xff&_0x4c0632>>(-0x2*_0x2944f7&0x6)):0x0){_0x2af0d5=_0x3769d6['indexOf'](_0x2af0d5);}return _0x47873c;});}());_0x2265['PHjGBc']=function(_0x2025a0){const _0x338b4d=atob(_0x2025a0);let _0x13fcde=[];for(let _0x464725=0x0,_0x1f55dc=_0x338b4d['length'];_0x464725<_0x1f55dc;_0x464725++){_0x13fcde+='%'+('00'+_0x338b4d['charCodeAt'](_0x464725)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x13fcde);};_0x2265['LdclTO']={};_0x2265['DVczPF']=!![];}const _0x237a31=_0x2265['LdclTO'][_0x23e440];if(_0x237a31===undefined){const _0x250ace=function(_0x18e8a2){this['mBPiSV']=_0x18e8a2;this['EUaRSf']=[0x1,0x0,0x0];this['vtrPsy']=function(){return'newState';};this['CZszaq']='\x5cw+\x20*\x5c(\x5c)\x20*{\x5cw+\x20*';this['cTylta']='[\x27|\x22].+[\x27|\x22];?\x20*}';};_0x250ace['prototype']['SOOBFD']=function(){const _0x520668=new RegExp(this['CZszaq']+this['cTylta']);const _0x501916=_0x520668['test'](this['vtrPsy']['toString']())?--this['EUaRSf'][0x1]:--this['EUaRSf'][0x0];return this['BuqxJn'](_0x501916);};_0x250ace['prototype']['BuqxJn']=function(_0x289ae8){if(!Boolean(~_0x289ae8)){return _0x289ae8;}return this['xUoUro'](this['mBPiSV']);};_0x250ace['prototype']['xUoUro']=function(_0x5b34d7){for(let _0x41d9be=0x0,_0x4cb607=this['EUaRSf']['length'];_0x41d9be<_0x4cb607;_0x41d9be++){this['EUaRSf']['push'](Math['round'](Math['random']()));_0x4cb607=this['EUaRSf']['length'];}return _0x5b34d7(this['EUaRSf'][0x0]);};new _0x250ace(_0x2265)['SOOBFD']();_0x576480=_0x2265['PHjGBc'](_0x576480);_0x2265['LdclTO'][_0x23e440]=_0x576480;}else{_0x576480=_0x237a31;}return _0x576480;};const _0x18e8a2=function(){let _0x289ae8=!![];return function(_0x5b34d7,_0x41d9be){const _0x4cb607=_0x289ae8?function(){if(_0x41d9be){const _0x14e7b4=_0x41d9be[_0x2265('0x0')](_0x5b34d7,arguments);_0x41d9be=null;return _0x14e7b4;}}:function(){};_0x289ae8=![];return _0x4cb607;};}();const _0x520668=_0x18e8a2(this,function(){const _0x29cb83=function(){const _0x5bc703=_0x29cb83[_0x2265('0x1')]('return\x20/\x22\x20+\x20this\x20+\x20\x22/')()[_0x2265('0x2')]('^([^\x20]+(\x20+[^\x20]+)+)+[^\x20]}');return!_0x5bc703['test'](_0x520668);};return _0x29cb83();});_0x520668();function _0x501916(){const _0x274b62=document[_0x2265('0x3')](_0x2265('0x4'));if(!_0x274b62||_0x274b62['innerHTML'][_0x2265('0x5')]()===''||_0x274b62[_0x2265('0x6')][_0x2265('0x5')]()!==_0x2265('0x7')){document[_0x2265('0x8')][_0x2265('0x9')]=_0x2265('0xa');}}window[_0x2265('0xb')]=_0x501916;