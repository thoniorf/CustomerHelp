<?php
class Ticket{
	public $id;
	public $owner;
	public $subject;
	public $date;
	public $assignedTo;
	public $label;
	
	function __construct($argv_id,$argv_sub,$argv_as,$argv_date,$argv_label,$argv_owner) {
       $this->id = $argv_id;
       $this->subject = $argv_sub;
       $this->date = $argv_date;
       $this->assignedTo = $argv_as;
       $this->label = $argv_label;
       $this->owner = $argv_owner;
   }
		
}

// Create new connection
$conn = new mysqli ( $host, $user, $pswd );

// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}

// COUNT ALL Ticket
$query = "SELECT idTicket FROM ticketsys_db.Ticket;";
$res = $conn->query ( $query );
$num_rows = $res->num_rows;
$limit = (isset($_GET['limit']))?$_GET['limit']:0;
$offset = 5;
// FETCH USER TICKETS
$idd = (isset($_GET['inputId']) && $_GET['inputId'] !== '')?'%' . $_GET['inputId'] . '%':'%';
$query = "SELECT idTicket, Title, M.Username, Date, Label, U.Username FROM ticketsys_db.Ticket ";
$query.="LEFT JOIN ticketsys_db.User as M ON (M.idUser = AssignedTo) ";
$query.="LEFT JOIN ticketsys_db.User as U ON (U.idUser = Owner) ";
$query.="WHERE idTicket LIKE '".$idd."' AND U.Username LIKE ? AND Title LIKE ? AND (AssignedTo IS NULL OR AssignedTo LIKE '%') AND Date >= CAST( ? AS DATE ) AND Label LIKE ? LIMIT " .$limit."," .$offset.";";

$tickets = array();


$title = (!empty($_GET['inputSubject']))?"%" . $_GET['inputSubject'] . "%":'%';
$date = (!empty($_GET['inputDate']))?$_GET['inputDate']:'1970-01-01';
$label = (!empty($_GET['inputLabel']))?"%" . $_GET['inputLabel'] . "%":'%';
$owner = (!empty($_GET['inputOwner']))?"%" . $_GET['inputOwner'] . "%":'%';
$ticket_error = 'hidden';


$stmt = $conn->prepare ($query);
if (!$stmt) {
	$conn->error;
}
// Bind vars
if(!$stmt->bind_param ("ssss", $owner,$title, $date, $label))
{
	$stmt->error;
}

// Execute
if(!$stmt->execute())
	$stmt->error;
$stmt->store_result();

if($stmt->bind_result($Bind_idTicket,$Bind_Title,$Bind_AssignedTo,$Bind_Date,$Bind_Label,$Bind_Owner))
{
	while($stmt->fetch())
	{
		$tickets[]= new Ticket($Bind_idTicket,$Bind_Title,(($Bind_AssignedTo != NULL)?$Bind_AssignedTo:"None"),$Bind_Date,$Bind_Label,$Bind_Owner);
	}
} else {
	$ticket_error = "show";
}
$upper = ($limit + $offset - $num_rows<0)?$limit + $offset:"disabled";
$lower = ($limit -$offset>=0)?$limit - $offset:"disabled";

$stmt->close();
$conn->close();
?>