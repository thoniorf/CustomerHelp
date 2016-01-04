<?php
$registration_error = "hidden";
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
		// Encrypt paswd
		$paswd = password_hash($paswd,PASSWORD_BCRYPT);
		// Prepare the statemnt
		$stmt = $conn->prepare ( "Insert into ticketsys_db.User (Email,Passwd) values (?,?);" );
		if (!$stmt) {
			$conn->error;
		}
		// Bind vars
		$stmt->bind_param ( "ss", $email,$paswd);
		// Execute
		$stmt->execute();
		if($stmt->affected_rows == -1) {
			$registration_error = "show";
			
		} else {
			$registration_completed = 'completed';
		}
		$stmt->close();
		$conn->close();
}
?>