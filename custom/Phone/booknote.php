<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>
        <!--评论输入框-->
    
    <?php
    // 获取当前用户信息
    $user = Typecho_Widget::widget('Widget_User');
    
    // 检查用户是否已登录
    if ($user->hasLogin()) {
        // 检查是否允许评论
        if ($this->allow('comment')) {
            // 获取当前用户的组信息
            $currGroup = get_object_vars($this->user)['row']['group'];
            
            // 检查用户组是否为 administrator
            if ($currGroup == "administrator") {?>
            
                <div id="<?php $this->respondId(); ?>" class="respond">
                    <div class="cancel-comment-reply">
                    <?php $comments->cancelReply(); ?>
                    </div>
                	<h3 id="response"><?php _e('▋ 读书笔记'); ?></h3>
                	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                                    <div class="clearfix">
                <div class="comment-textarea">
                     <textarea placeholder="写下读书笔记 / 摘抄句子..." rows="3" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-submit">
                     <div class="submit-left" id="comment-book"><i class="iconfont icon-warn"></i></div>
                     <div class="submit-right"><button type="submit" class="submit"><?php _e('写笔记'); ?></button></div>
                </div>
                
            </div>
                	</form>
                </div>

    <?php } } } ?>
    <!--自定义评论函数-->
    <!--评论列表开始-->
    <?php if ($comments->have()): ?>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="book-list">
        <div id="<?php $comments->theId(); ?>">
            <div class="book-content">
                <div class="book-note-content">
                    <?php $comments->content(); ?>
                </div>
                <div class="comment-book-info">
                    <span><?php $comments->date('Y年m月d日'); ?></span>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>

    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('', ''); ?>
    
    <?php else: ?>
    <p class="no-note">博主暂未发表本书的读书笔记</p>
    
    <?php endif; ?>

    <!--评论列表end-->
    
</div>
