<?php

/**
 * 页面底部信息
 */
if (!defined('EMLOG_ROOT')) {
	exit('error!');
}
?>



<footer class="card border-light  shadow" style="margin-top: 20px;">
	<div class="container text-center">
		<?php
		if (!empty($icp)) {
			echo '<div><a href="https://beian.miit.gov.cn/" target="_blank">' . $icp . '</a></div>';
		}
		?>
		<!-- 底部信息 -->
		<?= $footer_info ?>
		<?php doAction('index_footer') ?>
		<!-- 增删网站底部信息 -->
		<p>theme by <a href="http://www.classwall.cn/index.php/archives/252/">outlook</a></p>
	</div>
</footer>
<script src="<?= TEMPLATE_URL ?>js/common_tpl.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= TEMPLATE_URL ?>js/zoom.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
</body>

</html>