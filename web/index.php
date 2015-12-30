<?php
	require_once $INCLUDE_PATH . '/config.php';
	require_once $TEMPLATES_PATH . '/header.php';
?>
<body>
	<div class="container">
		<?php
			require_once $TEMPLATES_PATH . '/topbar.php';
			require_once $CONTENTS_PATH . $current_content;
		?>
	</div>
</body>
<?php 
	require_once $TEMPLATES_PATH . '/footer.php';
?>