<?php
// debug error reporting
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start ();
$host = getenv ( 'host_db' );
$user = getenv ( 'user_db' );
$pswd = getenv ( 'pswd_db' );

$INCLUDES_PATH = "./includes";
$TEMPLATES_PATH = "./templates";
$CONTENTS_PATH = "./contents";

function buildURI($type,...$argvs) {
	$uri = $_SERVER['PHP_SELF']."?";
	if($type === "GET") {
		foreach ($argvs as $var) {
			if (isset($_GET[$var])) {
				$uri.=$var . "=" . $_GET[$var] . "&";
			}
		}
	} else {
		die("Type isn't corrent.");
	}
	return $uri;
}
?>
