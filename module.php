<?php

/**
 * 侧边栏组件、页面模块
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<?php
/**
 * 侧边栏：链接
 */
function widget_link($title)
{
    global $CACHE;
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <?php foreach ($link_cache as $value) : ?>

                    <a href="<?= $value['url'] ?>" target="_blank" class="list-group-item list-group-item-action">
                        <?= $value['link'] ?>
                    </a>

                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：个人资料
 */
function widget_blogger($title)
{
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:" . $user_cache[1]['mail'] . "\">" . $user_cache[1]['name'] . "</a>" : $user_cache[1]['name'] ?>
    <div class="card text-center border-0 rounded" style="margin-bottom: 1rem!important;">
        <div class="card-body">
            <h5><?= $title ?></h5>
            <hr>
            <h5 class="card-title font-weight-bold"><?= $name ?></h5>
            <?php if (!empty($user_cache[1]['photo']['src'])) : ?>
                <img class="rounded-circle w-50 p-3" src="<?= BLOG_URL . $user_cache[1]['photo']['src'] ?>" alt="blogger">
            <?php endif ?>
            <p class="card-text"><?= $user_cache[1]['des'] ?></p>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：日历
 */
function widget_calendar($title)
{ ?>
    <!-- new -->
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <!-- 调用 sendinfo函数,就会向如下写入内容 -->
                <div id="calendar"></div>
                <script>
                    sendinfo('<?= Calendar::url() ?>', 'calendar');
                </script>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：标签
 */
function widget_tag($title)
{
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags') ?>
    <!-- new -->
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>
            <hr>
            <div>
                <!-- 标签内容 -->
                <?php foreach ($tag_cache as $value) : ?>
                    <button class="btn btn-outline-primary btn-sm" style="font-size:<?= $value['fontsize'] ?>pt; line-height:30px;">
                        <a href="<?= Url::tag($value['tagurl']) ?>" title="<?= $value['usenum'] ?> 篇文章" class='tags-side'><?= $value['tagname'] ?></a>
                    </button>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：分类
 */
function widget_sort($title)
{
    global $CACHE;
    $sort_cache = $CACHE->readCache('sort') ?>
    <!-- new -->
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <?php
                foreach ($sort_cache as $value) :
                    if ($value['pid'] != 0) continue;
                ?>
                    <li class="list-unstyled">
                        <a href="<?= Url::sort($value['sid']) ?>"><?= $value['sortname'] ?>&nbsp;&nbsp;<?= (($value['lognum']) > 0) ? '(' . ($value['lognum']) . ')' : '' ?></a>
                        <?php if (!empty($value['children'])) : ?>
                            <ul>
                                <?php
                                $children = $value['children'];
                                foreach ($children as $key) :
                                    $value = $sort_cache[$key];
                                ?>
                                    <li class="list-unstyled">
                                        <a href="<?= Url::sort($value['sid']) ?>">--&nbsp;&nbsp;<?= $value['sortname'] ?>
                                            &nbsp;&nbsp;(<?= $value['lognum'] ?>)</a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：最新评论
 */
function widget_newcomm($title)
{
    global $CACHE;
    $com_cache = $CACHE->readCache('comment');
    $isGravatar = Option::get('isgravatar');
?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <?php
                foreach ($com_cache as $value) :
                    $url = Url::comment($value['gid'], $value['page'], $value['cid']);
                ?>
                    <div href="#" class="list-group-item list-group-item-action ">
                        <div class="d-flex w-100 justify-content-between">
                            <?php if ($isGravatar == 'y') : ?>
                                <img style="width: 15%;height: 15%;" class="rounded-circle" src="<?= getGravatar($value['mail']) ?>" alt="commentator">
                            <?php endif ?>
                            <span class="mb-1"><?= $value['name'] ?></span>
                            <small><?= smartDate($value['date']) ?></small>
                        </div>
                        <small><a href="<?= $url ?>"><?= $value['content'] ?></a></small>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：最新文章
 */
function widget_newlog($title)
{
    global $CACHE;
    $newLogs_cache = $CACHE->readCache('newlog');
?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <?php foreach ($newLogs_cache as $value) : ?>
                    <a href="<?= Url::log($value['gid']) ?>" class="list-group-item list-group-item-action"><?= $value['title'] ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：热门文章
 */
function widget_hotlog($title)
{
    $index_hotlognum = Option::get('index_hotlognum');
    $Log_Model = new Log_Model();
    $hotLogs = $Log_Model->getHotLog($index_hotlognum) ?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <?php foreach ($hotLogs as $value) : ?>
                    <a href="<?= Url::log($value['gid']) ?>" class="list-group-item list-group-item-action"><?= $value['title'] ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：搜索
 */
function widget_search($title)
{ ?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>

            <hr>
            <div class="list-group">
                <form class="form-inline my-2 my-lg-0" name="keyform" method="get" action="<?= BLOG_URL ?>index.php">
                    <input name="keyword" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                        <i class="bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：归档
 */
function widget_archive($title)
{
    $bar_id = "36";
    global $CACHE;
    $record_cache = $CACHE->readCache('record');
?>
    <div class="card border-light mb-3 rounded">
        <div class="card-body">
            <h5 style="border-left: 5px solid #007bff; padding: 0px 10px;"><?= $title ?></h5>
            <hr>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    查看归档
                </button>
                <div class="dropdown-menu">
                    <?php foreach ($record_cache as $value) : ?>
                        <a class="dropdown-item" href="#" value="<?= Url::record($value['date']) ?>"><?= $value['record'] ?>&nbsp;(<?= $value['lognum'] ?>)</a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
/**
 * 侧边栏：自定义组件
 */
function widget_custom_text($title, $content)
{ ?>
    <div class="widget shadow-theme">
        <div class="widget-title m">
            <h3><?= $title ?></h3>
        </div>
        <ul class="unstyle-li">
            <?= $content ?>
        </ul>
    </div>
<?php } ?>
<?php
/**
 * 页顶：导航
 */
function blog_navi()
{
    global $CACHE;
    $navi_cache = $CACHE->readCache('navi');
?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            foreach ($navi_cache as $value) :
                if ($value['pid'] != 0) {
                    continue;
                }
                if ($value['url'] == 'admin' && (!User::isVistor())) :
            ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BLOG_URL ?>admin/">管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BLOG_URL ?>admin/account.php?action=logout">退出</a>
                    </li>
                <?php
                    continue;
                endif;
                $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
                $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
                $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'active' : '';
                ?>
                <?php if (!empty($value['children']) || !empty($value['childnavi'])) : ?>
                    <li class="nav-item dropdown">
                        <?php if (!empty($value['children'])) : ?>
                            <a class="nav-link dropdown-toggle" id="nav_link" href="<?= $value['url'] ?>" <?= $newtab ?> role="button" data-toggle="dropdown" aria-expanded="false">
                                <?= $value['naviname'] ?>
                            </a>
                            <div class="dropdown-menu">
                                <?php foreach ($value['children'] as $row) {
                                    echo '<a class="dropdown-item" href="' . Url::sort($row['sid']) . '">' . $row['sortname'] . '</a>';
                                } ?>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($value['childnavi'])) : ?>
                            <a class="nav-link dropdown-toggle" <?= $newtab ?> id="nav_link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <?= $value['naviname'] ?>
                            </a>
                            <div class="dropdown-menu">
                                <?php foreach ($value['childnavi'] as $row) {
                                    $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                                    echo '<a class="dropdown-item" href="' . $row['url'] . "\" $newtab >" . $row['naviname'] . '</a>';
                                } ?>
                            </div>
                        <?php endif ?>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $value['url'] ?>" <?= $newtab ?>><?= $value['naviname'] ?></a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
        <!-- 搜索框 -->
        <form class="form-inline my-2 my-lg-0" name="keyform" method="get" action="<?= BLOG_URL ?>index.php">
            <input name="keyword" class="form-control mr-sm-2 rounded-0" type="search" placeholder="Search" aria-label="Search" style="border-color: #007bff;border-width: 1px;">
            <button class="btn btn-outline-primary my-2 my-sm-0 rounded-0" type="submit" style="border-color: #007bff;border-width: 1px;">
                <i class="bi-search"></i>
            </button>
        </form>
    </div>
<?php } ?>
<?php
/**
 * 文章列出卡片：置顶标志
 */
function topflg($top, $sortop = 'n', $sortid = null)
{
    $ishome_flg = '<a href="#" class="badge badge-danger">置顶</a>';
    $issort_flg = '<span title="分类置顶" class="log-topflg" >分类置顶</span>';
    if (blog_tool_ishome()) {
        echo $top == 'y' ? $ishome_flg : '';
    } elseif ($sortid) {
        echo $sortop == 'y' ? $issort_flg : '';
    }
}

?>
<?php
/**
 * 文章详情页：编辑链接
 */
function editflg($logid, $author)
{
    $editflg = User::haveEditPermission() || $author == UID ? '&nbsp;&nbsp;&nbsp;<a href="' . BLOG_URL . 'admin/article.php?action=edit&gid=' . $logid . '" target="_blank">编辑</a>' : '';
    echo $editflg;
}

?>
<?php
/**
 * 文章详情页：分类
 */
function blog_sort($blogid)
{
    global $CACHE;
    $log_cache_sort = $CACHE->readCache('logsort');
?>
    <?php if (!empty($log_cache_sort[$blogid])) { ?>
        <a href="<?= Url::sort($log_cache_sort[$blogid]['id']) ?>" title="分类：<?= $log_cache_sort[$blogid]['name'] ?>"><?= $log_cache_sort[$blogid]['name'] ?></a>
    <?php } else { ?>
        <a href="#" title="未分类">无</a>
<?php }
} ?>
<?php
/**
 * 首页文章列表：分类
 */
function bloglist_sort($blogid)
{
    global $CACHE;
    $log_cache_sort = $CACHE->readCache('logsort');
?>
    <?php if (!empty($log_cache_sort[$blogid])) { ?>
        <span>
            <a href="<?= Url::sort($log_cache_sort[$blogid]['id']) ?>" class="badge badge-primary"><?= $log_cache_sort[$blogid]['name'] ?></a>
        </span>

<?php }
} ?>
<?php
/**
 * 首页文章列表和文章详情页：标签
 */
function blog_tag($blogid)
{
    $tag_model = new Tag_Model();
    $tag_ids = $tag_model->getTagIdsFromBlogId($blogid);
    $tag_names = $tag_model->getNamesFromIds($tag_ids);
    if (!empty($tag_names)) {
        $tag = '标签:';
        foreach ($tag_names as $key => $value) {
            $tag .= "	<a href=\"" . Url::tag(rawurlencode($value)) . "\" class='tags' title='标签' >" . htmlspecialchars($value) . '</a>';
        }
        echo $tag;
    }
}

?>
<?php
/**
 * 首页文章列表和文章详情页：作者
 */
function blog_author($uid)
{
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="' . Url::author($uid) . "\" $title>$author</a>";
}

?>
<?php
/**
 * 文章详情页：相邻文章
 */
function neighbor_log($neighborLog)
{
    extract($neighborLog) ?>
    <?php if ($prevLog) : ?>
        <button type="button" class="btn btn-outline-primary float-left"><a href="<?= Url::log($prevLog['gid']) ?>" title="<?= $prevLog['title'] ?>">上一篇</a></button>
    <?php endif ?>
    <?php if ($nextLog) : ?>
        <button type="button" class="btn btn-outline-primary float-right"><a href="<?= Url::log($nextLog['gid']) ?>" title="<?= $nextLog['title'] ?>">下一篇</a></button>
    <?php endif ?>
<?php } ?>
<?php
/**
 * 文章详情页：评论列表
 */
function blog_comments($comments)
{
    extract($comments);
    if ($commentStacks) : ?>
        <div class="comment-header"><b>评论：</b></div>
    <?php endif ?>
    <?php
    $isGravatar = Option::get('isgravatar');

    foreach ($commentStacks as $cid) :
        $comment = $comments[$cid];
        $comment['poster'] = $comment['url'] ? '<a href="' . $comment['url'] . '" target="_blank">' . $comment['poster'] . '</a>' : $comment['poster'];
    ?>
        <div class="comment" id="<?= $comment['cid'] ?>">
            <?php if ($isGravatar == 'y') : ?>
                <div class="avatar"><img src="<?= getGravatar($comment['mail']) ?>" alt="avatar" /></div>
                <div class="comment-infos">
                    <div class="arrow"></div>
                    <b><?= $comment['poster'] ?> </b><span class="comment-time"><?= $comment['date'] ?></span>
                    <div class="comment-content"><?= $comment['content'] ?></div>
                    <div class="comment-reply">
                        <button class="com-reply comment-replay-btn">回复</button>
                    </div>
                </div>
            <?php else : ?>
                <div class="comment-infos-unGravatar">
                    <b><?= $comment['poster'] ?> </b><span class="comment-time"><?= $comment['date'] ?></span>
                    <div class="comment-content"><?= $comment['content'] ?></div>
                    <div class="comment-reply">
                        <button class="com-reply comment-replay-btn">回复</button>
                    </div>
                </div>
            <?php endif ?>
            <?php blog_comments_children($comments, $comment['children']) ?>
        </div>
    <?php endforeach ?>
    <div id="pagenavi">
        <?= $commentPageUrl ?>
    </div>
<?php } ?>
<?php
/**
 * 文章详情页：子评论
 */
function blog_comments_children($comments, $children)
{
    $isGravatar = Option::get('isgravatar');
    foreach ($children as $child) :
        $comment = $comments[$child];
        $comment['poster'] = $comment['url'] ? '<a href="' . $comment['url'] . '" target="_blank">' . $comment['poster'] . '</a>' : $comment['poster'];
?>
        <div class="comment comment-children" id="<?= $comment['cid'] ?>">
            <?php if ($isGravatar == 'y') : ?>
                <div class="avatar"><img src="<?= getGravatar($comment['mail']) ?>" alt="commentator" /></div>
                <div class="comment-infos">
                    <div class="arrow"></div>
                    <b><?= $comment['poster'] ?> </b><span class="comment-time"><?= $comment['date'] ?></span>
                    <div class="comment-content"><?= $comment['content'] ?></div>
                    <?php if ($comment['level'] < 4) : ?>
                        <div class="comment-reply">
                            <button class="com-reply comment-replay-btn">回复</button>
                        </div><?php endif ?>
                </div>
            <?php else : ?>
                <div class="comment-infos-unGravatar">
                    <b><?= $comment['poster'] ?> </b><span class="comment-time"><?= $comment['date'] ?></span>
                    <div class="comment-content"><?= $comment['content'] ?></div>
                    <?php if ($comment['level'] < 4) : ?>
                        <div class="comment-reply">
                            <button class="com-reply comment-replay-btn">回复</button>
                        </div><?php endif ?>
                </div>
            <?php endif ?>
            <?php blog_comments_children($comments, $comment['children']) ?>
        </div>
    <?php endforeach ?>
<?php } ?>
<?php
/**
 * 文章详情页：评论表单
 */
function blog_comments_post($logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark)
{
    $isNeedChinese = Option::get('comment_needchinese');
    if ($allow_remark == 'y') : ?>
        <div id="comment-place">
            <div class="comment-post" id="comment-post">
                <div class="cancel-reply" id="cancel-reply" style="display:none">
                    <button class="comment-replay-btn">取消回复</button>
                </div>
                <form class="commentform" method="post" name="commentform" action="<?= BLOG_URL ?>index.php?action=addcom" id="commentform" is-chinese="<?= $isNeedChinese ?>">
                    <input type="hidden" name="gid" value="<?= $logid ?>" />
                    <textarea class="form-control log_comment" name="comment" id="comment" rows="10" tabindex="4" required></textarea>
                    <?php if (User::isVistor()) : ?>
                        <div class="comment-info" id="comment-info">
                            <input class="form-control com_control comment-name" id="info_n" autocomplete="off" type="text" name="comname" maxlength="49" value="<?= $ckname ?>" size="22" tabindex="1" placeholder="昵称*" required />
                            <input class="form-control com_control comment-mail" id="info_m" autocomplete="off" type="text" name="commail" maxlength="128" value="<?= $ckmail ?>" size="22" tabindex="2" placeholder="邮件地址" />
                            <input class="form-control com_control comment-url" id="info_u" autocomplete="off" type="text" name="comurl" maxlength="128" value="<?= $ckurl ?>" size="22" tabindex="3" placeholder="个人主页" />
                        </div>
                    <?php endif ?>

                    <span class="com_submit_p">
                        <input class="btn" <?php if ($verifyCode != "") { ?> type="button" data-toggle="modal" data-target="#myModal" <?php } else { ?> type="submit" <?php } ?> id="comment_submit" value="发布评论" tabindex="6" />
                    </span>
                    <?php if ($verifyCode != "") { ?>
                        <!-- 验证窗口 -->
                        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="display: table-cell;">
                                    <div class="modal-header" style="border-bottom: 0px;">
                                        输入验证码
                                    </div>
                                    <?= $verifyCode ?>
                                    <div class="modal-footer" style="border-top: 0px;">
                                        <button type="button" class="btn" id="close-modal" data-dismiss="modal">关闭</button>
                                        <button type="submit" class="btn" id="comment_submit2">提交</button>
                                    </div>
                                </div>
                            </div>
                            <div class="lock-screen"></div>
                        </div>
                        <!-- 验证窗口(end) -->
                    <?php } ?>
                    <input type="hidden" name="pid" id="comment-pid" value="0" tabindex="1" />
                </form>
            </div>
        </div>
    <?php endif ?>
<?php } ?>
<?php
/**
 * 判断函数：是否是首页
 */
function blog_tool_ishome()
{
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL) {
        return true;
    } else {
        return FALSE;
    }
}

?>