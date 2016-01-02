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
$stmt = $conn->prepare("SELECT * FROM ticketsys_db.User WHERE Email=? AND Passwd=?;");
if(!$stmt){
	$conn->error;
}
// Bind vars
$stmt->bind_param("ss", $email, $paswd);
// Execute, get results and fetch
$stmt->execute();
$result = $stmt->get_result();
$row = $row->fetch_assoc();
// If row is not null set user_id session
if($row != null){
	$_SESSION['user_id'] = $row['idUser'];
	print "<script>window.location.reload();<script>";
}
// If null login failed
else
{
		
}
?>