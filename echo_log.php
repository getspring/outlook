<?php

/**
 * 阅读文章页面
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div class="container">
    <article class="col-xl-12 rounded" style="background-color: #ffffff;padding: 20px !important;">
        <h2><?php topflg($top) ?><?= $log_title ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="font-size: 12px;">
                <li class="breadcrumb-item">时间：<a href="#"><?= date('Y-n-j H:i', $date) ?></a></li>
                <li class="breadcrumb-item">作者：<a href="#"><?php blog_author($author) ?></a></li>
                <li class="breadcrumb-item">分类：<a href="#"><?php blog_sort($logid) ?></a></li>
                <!-- 调用文章编辑按钮 -->
                <li class="breadcrumb-item"><?php editflg($logid, $author) ?></li>
            </ol>
        </nav>
        <hr>
        <!-- 文章内容 -->
        <div class="markdown">
            <?= $log_content ?>
        </div>
        <hr>
        <!-- 文章标签 -->
        <p class="top-5">
            <?php blog_tag($logid) ?>
        </p>
        <!-- 相关文章挂载点 -->
        <?php doAction('log_related', $logData) ?>

        <!-- 邻近文章：上一篇下一篇 -->
        <div class="clearfix">
            <?php neighbor_log($neighborLog) ?>
        </div>

        <!-- 调用评论框 -->
        <?php blog_comments_post($logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark) ?>
        <!-- 调用评论列表 -->
        <?php blog_comments($comments) ?>
        <div style="clear:both;"></div>

    </article>
</div>

<?php include View::getView('footer') ?>