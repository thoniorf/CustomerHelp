<?php
$error_login = "hidden";
if (isset ( $_POST['inputEmail'] ) && isset ( $_POST['inputPassword'] )) {
	// Create new connection
	$conn = new mysqli ( $host, $user, $pswd );

	// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	// Filter fieds
	$email = filter_var ( $_POST['inputEmail'], FILTER_SANITIZE_STRING );
	$paswd = filter_var ( $_POST['inputPassword'], FILTER_SANITIZE_STRING );
	
	// Prepare the statemnt
	$stmt = $conn->prepare ( "SELECT idUser, Email, Passwd Passwd FROM ticketsys_db.User WHERE Email=?" );
	if (!$stmt) {
		$conn->error;
	}
	// Bind vars
	$stmt->bind_param ( "s", $email);
	// Execute, get results and fetch
	$stmt->execute();
	if ($stmt->bind_result($Bind_idUser,$Bind_Email, $Bind_Passwd)) {
		$stmt->fetch ();
		if (!empty($Bind_idUser) && password_verify($paswd,$Bind_Passwd)) {
			$_SESSION ['user_id'] = $Bind_idUser;
			$_SESSION['user_email'] = $Bind_Email;
		} else {
			$error_login = "show";
		}
	}
	$stmt->close();
	$conn->close();
}
?>