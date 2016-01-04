<?php
require_once './includes/config.php';
require_once $INCLUDES_PATH . '/content_behavior.php';
require_once $TEMPLATES_PATH . '/header.php';
?>
<body>
	<div class="container-fluid">
		<?php
		require_once $TEMPLATES_PATH . '/topbar.php';
		require_once $CONTENTS_PATH . $current_content;
		?>
	</div>
</body>
<?php
require_once $TEMPLATES_PATH . '/footer.php';
?>
