<?php
class Message {
	public $id;
	public $user;
	public $text;
	public $date;
	function __construct($argv_id, $argv_user, $argv_text, $argv_date) {
		$this->id = $argv_id;
		$this->user = $argv_user;
		$this->text = $argv_text;
		$this->date = $argv_date;
	}
}

// COUNT ALL MESSAGE
$query = "SELECT IdMessage FROM ticketsys_db.Message WHERE idTicket =" . $_GET ['idTicket'];
$res = $conn->query ( $query );
$num_rows = $res->num_rows;

// FETCH MESSAGE
$messages = array ();
$limit = (isset($_GET['limit']))?$_GET['limit']:0;
$offset = 5;

$upper = ($limit + $offset - $num_rows<0)?$limit + $offset:"disabled";
$lower = ($limit -$offset>=0)?$limit - $offset:"disabled";

$query = "Select M.IdMessage, U.Email, M.MessageText, DATE(M.Date) as Date ";
$query .= "FROM ticketsys_db.Message as M JOIN ticketsys_db.User as U ON (U.idUser = M.idUser) ";
$query .= "WHERE M.idTicket = ? LIMIT ?, " .$offset . ";";

$stmt = $conn->prepare ( $query );
if (! $stmt) {
	$conn->error;
}
// Bind vars
if (! $stmt->bind_param ( "ii", $_GET ['idTicket'], $limit )) {
	$stmt->error;
}

// Execute
$stmt->execute ();
$stmt->store_result ();
if ($stmt->bind_result ( $Bind_id, $Bind_User, $Bind_MessageText, $Bind_Date )) {
	
	while ( $stmt->fetch () ) {
		
		$messages [] = new Message ( $Bind_id, $Bind_User, $Bind_MessageText, $Bind_Date );
	}
} else {
	$ticket_error = "show";
}
$stmt->close ();
$conn->close ();
?>