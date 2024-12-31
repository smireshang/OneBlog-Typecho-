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



/*移动端导航条*/
$("#sidebarToggler").click(function () {
    var sideBar = $("#sideBar");
    //我的逻辑上是先判断没有这个class，没有的话就添加，这个添加动作会触发宽度加长的过渡效果
    if (!sideBar.hasClass("addWidth")) {
        $("#sideBar").addClass("addWidth");
    }
    //同理，展开之后要切换，移除这个class来触发减小宽度的过渡效果
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
                    var $res = $(data).find('.grid,.post_all,.book-item'); //从数据中挑出文章数据，请根据实际情况更改
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
            area: ['360px', '300px'], // 调整弹框大小
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