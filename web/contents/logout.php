<?php
session_unset();
session_destroy();
header("refresh:3;url=index.php");
?>
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
<p>
<strong>You are now logged out.</strong>, and will be
redirected. If not, return to the <a href="index.php">main page</a>
</p>
</div>
</div>