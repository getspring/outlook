<?php

/**
 * 首页模板
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<main class="container blog-container">
    <div class="row">
        <div class="col-xl-8">
            <?php doAction('index_loglist_top');
            if (!empty($logs)) :
                foreach ($logs as $value) :
            ?>
                    <!-- 卡片模块 -->
                    <div class="card border-light rounded" style="margin-bottom:6px;">
                        <div class="row card-body">
                            <?php if (!empty($value['log_cover'])) : ?>
                                <div class="article_cover col-0 col-sm-4 col-md-4 col-lg-4 col-xl-4 float-left d-none d-sm-block">
                                    <img class="rounded img-fluid" src="<?= $value['log_cover'] ?>" class="rea-width" data-action="zoom" style="width: 100%; height: 100%;">
                                </div>
                            <?php else : ?>
                                <div class="article_cover col-0 col-sm-4 col-md-4 col-lg-4 col-xl-4 float-left d-none d-sm-block">
                                    <!-- 默认封面配置 -->
                                    <img class="rounded img-fluid" src="<?= BLOG_URL ?>/content/templates/outlook/images/article_default.jpg" class="rea-width" data-action="zoom" style="width: 100%; height: 100%;">
                                </div>
                            <?php endif ?>
                            <div class="article_content col-12 col-sm-4 col-md-8 col-lg-8 col-xl-8 float-right">
                                <h5 class="card-title text-truncate">
                                    <!-- 文章标题 -->
                                    <a href="<?= $value['log_url'] ?>">
                                        <?= $value['log_title'] ?>
                                    </a>
                                    <!-- 文章置顶图标 -->
                                    <?php topflg($value['top'], $value['sortop'], isset($sortid) ? $sortid : '') ?>

                                    <!-- 文章分类图标 -->
                                    <?php bloglist_sort($value['logid']) ?>
                                </h5>
                                <!-- 文章摘要 -->
                                <p class="card-text text-truncate markdown" style="font-size: 1rem;">
                                    <?= subContent($value['log_description'], 40, 1) ?>
                                </p>
                                <!-- 文章标签（弃用） -->
                                <!-- <span style="float: right;">调用标签</span> -->
                                <!-- 文章信息模块 -->
                                <small class="float-left" style="font-size: 0.7rem;">
                                    <!-- 文字作者（弃用） -->
                                    <!-- <a href="#">调用作者</a> -->
                                    <span><?= date('Y/n/j', $value['date']) ?></span>
                                    <!-- 编辑按钮 -->
                                    <span class="mh">
                                        <?php editflg($value['logid'], $value['author']) ?>
                                    </span>
                                    <!-- 文章浏览和评论 -->
                                    <span class="bi-chat" href="<?= $value['log_url'] ?>#comments">评论(<?= $value['comnum'] ?>)</span>
                                    <span class="bi-eye" href="<?= $value['log_url'] ?>">阅读(<?= $value['views'] ?>)</span>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            else :
                ?>
                <div class="card border-light mb-3 rounded">
                    <div class="card-body">
                        <p>抱歉,暂无内容</p>
                    </div>
                </div>
            <?php endif ?>
            <div class="pagination bottom-5">
                <?= $page_url ?>
            </div>
        </div>

        <?php include View::getView('side') ?>

    </div>
</main>

<?php include View::getView('footer') ?>