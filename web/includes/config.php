<?php
session_start();
$host = getenv('host_db');
$user = getenv('user_db');
$pswd = getenv('pswd_db');

$INCLUDE_PATH = "./include";
$TEMPLATES_PATH = "./templates";
$CONTENTS_PATH = "./contents";

if(!isset($_SESSION['session_user'])){
	$current_content = "/login.php";
} else {
	$current_content = "/home.php";
}

?>