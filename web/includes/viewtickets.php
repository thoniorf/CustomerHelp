<?php
class Ticket{
	public $id;
	public $subject;
	public $date;
	public $assignedTo;
	public $label;
	
	function __construct($argv_id,$argv_sub,$argv_as,$argv_date,$argv_label) {
       $this->id = $argv_id;
       $this->subject = $argv_sub;
       $this->date = $argv_date;
       $this->assignedTo = $argv_as;
       $this->label = $argv_label;
   }
		
}
$query = "SELECT idTicket, Title, M.Email, Date, Label FROM ticketsys_db.Ticket ";
$query.="LEFT JOIN ticketsys_db.User as M ON (M.idUser = AssignedTo) ";
$query.="WHERE Owner= ?  AND Title LIKE ? AND (AssignedTo IS NULL OR AssignedTo LIKE '%') AND Date >= CAST( ? AS DATE ) AND Label LIKE ?;";
$tickets = array();
$title = (!empty($_GET['inputSubject']))?"%" . $_GET['inputSubject'] . "%":'%';
$date = (!empty($_GET['inputDate']))?$_GET['inputDate']:'1970-01-01';
$label = (!empty($_GET['inputLabel']))?"%" . $_GET['inputLabel'] . "%":'%';
$ticket_error = 'hidden';

// Create new connection
$conn = new mysqli ( $host, $user, $pswd );

// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}
$stmt = $conn->prepare ($query);
if (!$stmt) {
	$conn->error;
}
// Bind vars
if(!$stmt->bind_param ("isss", $_SESSION['user_id'], $title, $date, $label))
{
	$stmt->error;
}

// Execute
$stmt->execute();
if($stmt->bind_result($Bind_idTicket,$Bind_Title,$Bind_AssignedTo,$Bind_Date,$Bind_Label))
{

	while($stmt->fetch())
	{
		$tickets[]= new Ticket($Bind_idTicket,$Bind_Title,(($Bind_AssignedTo != NULL)?$Bind_AssignedTo:"None"),$Bind_Date,$Bind_Label);
	}
} else {
	$ticket_error = "show";
}
$stmt->close();
$conn->close();
?>