<?php
if (! isset ( $_ ['user_id'] )) {
	$current_content = "/login.php";
} else {
	if(isset($_GET['content'])){
		$current_content = $_GET['content'];
	} else {
		$current_content = "/home.php";
	}
}
?>