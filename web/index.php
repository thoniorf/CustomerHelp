<?php
require_once './includes/config.php';
require_once $INCLUDES_PATH . '/content_behavior.php';
require_once $TEMPLATES_PATH . '/header.php';
?>
<body>
	<div class="container-fluid">
		<?php
		require_once $TEMPLATES_PATH . '/topbar.php';
		?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php 
    				require_once $CONTENTS_PATH . $current_content;
				?>
            </div>
        </div>
	</div>
</body>
<?php
require_once $TEMPLATES_PATH . '/footer.php';
?>
