<?php
require_once './config.php';

$conn = new mysqli($host,$user,$pswd);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// Filter fieds
$email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_STRING);
$paswd = filter_var($_POST['inputPassword'], FILTER_SANITIZE_STRING);
// Encrypt passwd
$paswd = password_hash($paswd,PASSWORD_BCRYPT);
// Prepare the statemnt
$stmt = $conn->prepare("SELECT idUser FROM ticketsys_db.User WHERE Email=? AND Passwd=?;");
if(!$stmt){
	$conn->error;
}
// Bind vars
$stmt->bind_param("ss", $email, $paswd);
// Execute, get results and fetch
$stmt->execute();
if($stmt->bind_result($Bind_idUser)){
	$stmt->fetch();
	// If Bind_idUser is not null set user_id session
		$_SESSION['user_id'] = $Bind_idUser;
		header( "refresh:5;url=../index.php" ); 
}
// If false login failed
else
{
		
}
?>
