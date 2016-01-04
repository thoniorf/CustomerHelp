<?php
if (!isset( $_SESSION['user_id'])) {
	$current_content = "/login.php";
	if(isset($_GET['content']) && $_GET['content'] == 'registration'){
		$current_content ='/' .  $_GET['content'] . '.php';
	}
} else {
	if(isset($_GET['content'])){
		$current_content ='/' .  $_GET['content'] . '.php';
	} else {
		$current_content = "/home.php";
	}
}
?>