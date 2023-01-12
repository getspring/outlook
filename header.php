<?php
/*
Template Name:outlook主题
Template Url:http://www.classwall.cn/index.php/archives/252/
Description:一个极简的主题
Author:陈得春
Author Url:http://www.classwall.cn/
*/
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
require_once View::getView('module');
?>
<!doctype html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $site_title ?></title>
    <meta name="keywords" content="<?= $site_key ?>" />
    <meta name="description" content="<?= $site_description ?>" />
    <base href="<?= BLOG_URL ?>" />
    <link rel="shortcut icon" href="<?= BLOG_URL ?>favicon.ico" />
    <link rel="alternate" title="RSS" href="<?= BLOG_URL ?>rss.php" type="application/rss+xml" />
    <!-- bootstrap_V4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- 本地 -->
    <link href="<?= TEMPLATE_URL ?>css/style.css?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" type="text/css" />
    <link href="<?= TEMPLATE_URL ?>css/markdown.css?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" type="text/css" />

    <script>
        // 日历生成和翻页
        function sendinfo(url) {
            $("#calendar").load(url)
        }
    </script>
    <?php doAction('index_head') ?>
</head>

<body>
    <!-- 网站导航 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" style="margin-bottom: 20px;">
        <div class="container">
            <a class="navbar-brand" href="<?= BLOG_URL ?>">
                <img src="https://i.postimg.cc/GpLKh05w/ver-4.jpg" alt="" style="width: 110px;height:20px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: #ffffff;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php blog_navi() ?>
            <?php doAction('index_navi_ext') ?>
        </div>
    </nav>

    <!-- 本地jQuery -->
    <script src="<?= TEMPLATE_URL ?>js/jquery.min.3.5.1.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>