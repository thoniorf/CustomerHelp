<?php
// debug error reporting
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start ();
$host = getenv ( 'host_db' );
$user = getenv ( 'user_db' );
$pswd = getenv ( 'pswd_db' );

$INCLUDES_PATH = "./include";
$TEMPLATES_PATH = "./templates";
$CONTENTS_PATH = "./contents";

?>