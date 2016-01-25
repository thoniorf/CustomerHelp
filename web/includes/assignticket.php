<?php
require_once 'config.php';
if (isset ( $_GET ['idTicket'] )) {
	// Create new connection
	$conn = new mysqli ( $host, $user, $pswd );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	$stmt = $conn->prepare ( "UPDATE ticketsys_db.Ticket SET AssignedTo = ? WHERE idTicket = ? ;" );
	if (!$stmt) {
		$conn->error;
	}
	// Bind vars
	if (! $stmt->bind_param ( "ii",$_SESSION['user_id'], $_GET ['idTicket'] ))
		print $stmt->error;
		// Execute, get results and fetch
	if (! $stmt->execute ()) {
		$ticket_error = "show";
	}
	if($stmt->affected_rows == -1) {
		print "error";
	}
	$stmt->close();
	$conn->close();
	header("refresh:0;url=/index.php?content=view_ticket&idTicket=" . $_GET['idTicket'] );
}
?>