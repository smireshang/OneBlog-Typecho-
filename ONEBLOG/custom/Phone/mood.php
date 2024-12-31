<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('custom/Phone/nav.php');?>
<div class="content mood">
<div class="top-menu">
    <div id="sidebarToggler" class="nav"><i class="iconfont icon-nav"></i></div>
    <div class="top-sitename"><img src="<?php $this->options->Mlogo();?>"></div>
</div>
<div class="header" style="background-image:url('<?php $this->fields->thumb();?>')">
        <div class="pagetitle">
            <div class="slogan">
                <h1>萤窗小语</h1> 
                <span>I saw, I read, I write.</span>
            </div>
            
            <div class="login-publish-btn">
                <?php if($this->user->hasLogin()): ?>
                    <button id="publish-button">发布</button>
                <?php else: ?>
                    <button id="login-button">登录</button>
                <?php endif; ?>
            </div>
            
        </div>
</div><!--网站顶栏需要重新设计-->

<div class="mood-box">
    <div id="comments">
        <?php $this->comments()->to($comments); ?>
        <?php if ($comments->have()): ?>
            <ul class="comment-list">
                <?php while($comments->next()): ?>
                    <?php threadedComments($comments, $this->user); ?>
                <?php endwhile; ?>
            </ul>
            <?php $comments->pageNav('', ''); ?>
            <?php
                $cid = $this->cid;
                $comment_count = Typecho_Db::get()->fetchRow(Typecho_Db::get()->select('COUNT(*) AS count')->from('table.comments')
                    ->where('cid = ?', $cid)
                    ->where('status = ?', 'approved'))['count'];
                if($comment_count > 6):
            ?>
                <div class="center">
                    <button id="load-more-comments">
                        <svg t="1712389642749" class="comment-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9075" id="mx_n_1712389642752" width="20" height="20">
                            <path d="M674.133333 878.933333l-98.133333-102.4c128-17.066667 230.4-123.733333 230.4-251.733333 0-123.733333-93.866667-230.4-217.6-251.733333l-89.6-89.6h38.4c196.266667 0 354.133333 153.6 354.133333 341.333333 0 128-76.8 243.2-183.466666 298.666667v85.333333l-34.133334-29.866667z m-93.866666-17.066666c-12.8 0-29.866667 4.266667-46.933334 4.266666-196.266667 0-354.133333-153.6-354.133333-341.333333 0-128 76.8-243.2 183.466667-298.666667V128l55.466666 55.466667 85.333334 85.333333c-132.266667 12.8-234.666667 123.733333-234.666667 256 0 128 98.133333 234.666667 226.133333 251.733333l85.333334 85.333334z" fill="#ff342b" p-id="9076"></path>
                        </svg>
                        <span class="comment-lable">点击查看更多</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="center">
                <div id="no-more-comments" style="display: none;">— 已显示全部动态 —</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    var loginAction = "<?php echo $this->options->loginAction(); ?>";
    var commentUrl = "<?php $this->commentUrl(); ?>";
    var commentLikeUrl = "<?php Helper::options()->index("?commentLike=dz"); ?>";
</script>


<?php
function threadedComments($comments, $user) { ?>
    <li class="animated fadeIn">
        <div id="<?php echo $comments->theId(); ?>">
            <div class="mood-author-info">
                <?php $email = $comments->mail; $imgUrl = getGravatar($email); echo '<img class="mood-avatar" src="' . $imgUrl . '" width="31px" height="31px">'; ?>
                <div class="mood-details">
                    <span class="mood-author"><?php echo $comments->author(); ?></span>
                    <span class="mood-date"><?php echo $comments->date('Y-m-d H:i'); ?></span>
                </div>
            </div>
            <div class="mood-content">
                <?php echo $comments->content(); ?>
            </div>
            <div class="mood-actions">
                <!-- 评论点赞次数 -->
                <?php 
                    $commentLikes = commentLikesNum($comments->coid); 
                    $commentLikesNum = $commentLikes['likes'];
                    $commentLikesRecording = $commentLikes['recording'];
                ?>
                <div class="commentLike">
                    <a class="commentLikeOpt" id="commentLikeOpt-<?php echo $comments->coid; ?>" href="javascript:;" data-coid="<?php echo $comments->coid; ?>" data-recording="<?php echo $commentLikesRecording; ?>">
                        <i id="commentLikeI-<?php echo $comments->coid; ?>" class="<?php echo $commentLikesRecording ? 'iconfont icon-liked' : 'iconfont icon-like'; ?>"></i>
                        <span id="commentLikeSpan-<?php echo $comments->coid; ?>"><?php echo $commentLikesNum; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </li>
<?php } ?>
</div>
