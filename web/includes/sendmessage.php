<?php
// INSERT REPLY
$reply_error = "hidden";
if(!empty($_POST ['inputMessage'])) {
$reply = $_POST ['inputMessage'];
$query = "INSERT into ticketsys_db.Message (idTicket,idUser,MessageText,Date)VALUES(?,?,?,NOW());";

// Filter FIELDS
$reply = filter_var ( $reply, FILTER_SANITIZE_STRING );
$stmt = $conn->prepare ( $query );
if (! $stmt) {
	$conn->error;
}

// Bind vars
if (! $stmt->bind_param( "iis", $_GET['idTicket'], $_SESSION['user_id'], $reply)) {
	$stmt->error;
}

// Execute
$stmt->execute ();
if ($stmt->affected_rows == - 1) {
	$reply_error = "show";
} else {
	$reply_sent = 'sent';
}

$stmt->close ();
$conn->close ();
}
?>