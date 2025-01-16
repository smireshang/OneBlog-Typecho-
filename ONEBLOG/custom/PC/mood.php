<meta name="csrf-token" content="<?php echo Helper::security()->getToken($this->request->getRequestUrl()); ?>">
<meta name="comment-url" content="<?php $this->commentUrl(); ?>">

<div class="mood-header" style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>');">
    <a class="logo" href="/">
        <img src="<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
        <div class="slogan">
            <h1><?php $this->options->title();?></h1>
            <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
        </div>
    </a>
    <div class="login-publish-btn">
        <?php if($this->user->hasLogin()): ?>
            <button id="publish-button">发布</button>
        <?php else: ?>
            <button id="login-button">登录</button>
        <?php endif; ?>
    </div>
</div>

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
            <div class="end" id="no-more" style="display: none;">END</div>
        <?php endif; ?>
    </div>
    <a id="gototop" class="hidden"><img src="<?php $this->options->themeUrl('assets/img/top.png'); ?>"></a><!--返回顶部-->
</div>


<script>
    var loginAction = "<?php echo $this->options->loginAction(); ?>";
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