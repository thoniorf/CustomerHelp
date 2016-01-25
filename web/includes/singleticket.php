<?php
class Ticket {
	public $id;
	public $subject;
	public $date;
	public $edit;
	public $assignedTo;
	public $label;
	public $description;
	public $category;
	public $product;
}

$ticket = new Ticket ();
$ticket_error = 'hidden';
if (! isset ( $_GET ['idTicket'] )) {
	$ticket_error = 'show';
} else {
	$query = "SELECT T.idTicket, T.Title, M.Username, T.Date, T.LastEdit, T.Label, T.Description, C.Name, P.Name FROM ticketsys_db.Ticket as T ";
	// JOIN WITH USER find ticket'sassignment
	$query .= "LEFT JOIN ticketsys_db.User as M ON (M.idUser = T.AssignedTo) ";
	// JOIN WITH CATEGORY find ticket's category
	$query .= "LEFT JOIN ticketsys_db.Category as C ON (C.idCategory = T.Category) ";
	// JOIN WITH PRODUCT find ticket's product
	$query .= "LEFT JOIN ticketsys_db.Product as P ON (P.idProduct = T.Product) ";
	$query .= "WHERE  (T.Owner= ? OR T.AssignedTo = ? OR T.AssignedTo IS NULL ) AND T.idTicket= ? ;";
	
	// Create new connection
	$conn = new mysqli ( $host, $user, $pswd );
	
	// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	// FETCH TICKET
	$stmt = $conn->prepare ( $query );
	if (! $stmt) {
		$conn->error;
	}
	// Bind vars
	if (! $stmt->bind_param ( "iii",$_SESSION['user_id'],$_SESSION['user_id'], $_GET ['idTicket'] )) {
		$stmt->error;
	}
	
	// Execute, Store and Fetch
	$stmt->execute ();
	$stmt->store_result ();
	if ($stmt->bind_result ( $ticket->id, $ticket->subject, $ticket->assignedTo, $ticket->date, $ticket->edit, $ticket->label, $ticket->description, $ticket->category, $ticket->product )) {
		
		while ( $stmt->fetch () ) 
		{
			if ($ticket->assignedTo == NULL) 
			{
				$ticket->assignedTo = "None";
			}
		}
	} 
	else 
	{
		$ticket_error = "show";
	}
	
	$stmt->close ();	
}
?>