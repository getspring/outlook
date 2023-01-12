<?php

/**
 * 自建页面模板
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<article class="container">
    <div class="row">
        <div class="col-xl-8">
            <div style="background-color: #ffffff;padding: 20px !important;">
                <h2><?php topflg($top) ?><?= $log_title ?></h2>
                <hr>
                <!-- 文章内容 -->
                <div class="markdown">
                    <?= $log_content ?>
                </div>
                <hr>
                <?php blog_comments_post($logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark) ?>
                <?php blog_comments($comments) ?>
            </div>
        </div>
        <?php
        include View::getView('side');
        ?>
    </div>
</article>
<?php
include View::getView('footer');
?>