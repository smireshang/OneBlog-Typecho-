<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <!--自定义评论函数-->
     <!--评论列表开始-->
    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('暂无留言'), _t('▋ 读者留言 '), _t('▋ 读者留言')); ?></h3>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
            $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php if ($comments->levels > 0) { echo ' comment-child';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');} else {echo ' comment-parent';}
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment-author">
                <?php $email=$comments->mail; $imgUrl = getGravatar($email);echo '<img class="avatar" src="'.$imgUrl.'" width="31px" height="31px">'; ?>
                <div class="comment-info">
                    <div class="fn">
                        <?php $comments->author(); ?>
                        <?php dengji($comments->mail);?>
                        <?php if ($comments->status === "waiting") : ?>
                            <em class="waiting">（正在审核中...）</em>
                        <?php endif; ?>
                    </div>
                    <div class="comment-info-bottom">
                        <span><?php $comments->date('Y-m-d H:i'); ?></span>
                        <span class="comment-reply"><?php $comments->reply(); ?></span>       
                    </div>
                </div>
            </div>
            <?php if ($comments->status === "waiting") : ?>
                 <div class="p-waiting"><?php $comments->content(); ?><p>提醒：该评论已提交审核，审核通过才会显示。</p></div>
            <?php else: ?>
                <?php $comments->content(); ?>
            <?php endif; ?>
        </div>
        <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
        <?php } ?>
    </li>
    <?php } ?>

    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('', ''); ?>

    <?php
        // 获取当前页面的文章 CID
        $cid = $this->cid;
        // 查询当前页面的评论总数
        // 查询当前页面的评论总数，只查询 parent 为 0 的评论
        $comment_count = $this->db->fetchRow($this->db->select('COUNT(*) AS count')->from('table.comments')
            ->where('cid = ?', $cid)
            ->where('status = ?', 'approved')
            ->where('parent = ?', 0))['count'];//只查询父级评论，否则会导致分页存在问题
            
        if($comment_count > 6)://注意 这里的数字一定要与主题设置中分页显示的评论数一致，换言之 如果评论数有下一页 则显示加载更多按钮?>
        
        <!-- 添加一个按钮用来加载下一页评论 -->
        <div class="center">
            <button id="load-more-comments">
                <svg t="1712389642749" class="comment-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9075" id="mx_n_1712389642752" width="20" height="20"><path d="M674.133333 878.933333l-98.133333-102.4c128-17.066667 230.4-123.733333 230.4-251.733333 0-123.733333-93.866667-230.4-217.6-251.733333l-89.6-89.6h38.4c196.266667 0 354.133333 153.6 354.133333 341.333333 0 128-76.8 243.2-183.466666 298.666667v85.333333l-34.133334-29.866667z m-93.866666-17.066666c-12.8 0-29.866667 4.266667-46.933334 4.266666-196.266667 0-354.133333-153.6-354.133333-341.333333 0-128 76.8-243.2 183.466667-298.666667V128l55.466666 55.466667 85.333334 85.333333c-132.266667 12.8-234.666667 123.733333-234.666667 256 0 128 98.133333 234.666667 226.133333 251.733333l85.333334 85.333334z" fill="#ff342b" p-id="9076"></path></svg>
                <span class="comment-lable">点击查看更多</span>
            </button>
        </div>
        <?php endif; ?>
        <!-- 添加一个用于显示提示信息的元素 -->
        <div class="center">
            <div id="no-more-comments" style="display: none;">— 已显示全部评论 —</div>
         </div>

   
    
    <?php endif; ?>
    
    <!--评论列表end-->
    
    
    <!--评论输入框-->

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
    	<h3 id="response"><?php _e('▋ 发表留言'); ?></h3>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    	    
        	    <?php if ($this->user->hasLogin() && isset($this->user->group) && $this->user->group == "administrator"): ?>
                <!-- 用户是管理员时的内容 -->
                <?php else: ?>
                <div class="comment-author-info">
                    <div class="comment-md-3">
                        <label for="author"><?php _e('称呼'); ?><span class="required">*</span></label>
                        <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                    </div>	    
                    <div class="comment-md-3">
                        <label for="mail"<?php if ($this->options->commentsRequireMail): ?><?php endif; ?>><?php _e('邮箱'); ?><span class="required">*</span></label>
                        <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>	
                    <div class="comment-md-3 comment-url">
                        <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?><span class="required">*</span></label>
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                </div>
                <?php endif; ?>

    	    
    	    
            <div class="clearfix">
                <div class="comment-textarea">
                     <textarea placeholder="请输入留言内容..." rows="3" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-submit">
                     <div class="submit-left" id="comment-notice"><i class="iconfont icon-warn"></i></div>
                     <div class="submit-right"><button type="submit" class="submit"><?php _e('提交审核'); ?></button></div>
                </div>
                
            </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
