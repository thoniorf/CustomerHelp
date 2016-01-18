<?php
$ticket_error = 'hidden';
// Create new connection
$conn = new mysqli ( $host, $user, $pswd );

// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}
// EDIT INFORMATIONS
if(isset($_POST['inputSubject'],$_POST['inputCategory'],$_POST['inputProduct'],$_POST['inputDescription'],$_GET['idTicket']))
{
	// FILTER VARS
	$subject = filter_var ( $_POST['inputSubject'], FILTER_SANITIZE_STRING );
	$product = filter_var ( $_POST['inputProduct'], FILTER_SANITIZE_STRING );
	$category = filter_var ( $_POST['inputCategory'], FILTER_SANITIZE_STRING );
	$description .= filter_var ( $_POST['inputDescription'], FILTER_SANITIZE_STRING );
	
	// Prepare the statemnt
	$stmt = $conn->prepare ( "UPDATE ticketsys_db.Ticket SET Title = ?,Description = ?,Category = ?,Product = ?, LastEdit = NOW() WHERE idTicket= ?;" );
	if (!$stmt) {
		$conn->error;
	}
	// Bind vars
	if(!$stmt->bind_param ( "ssssi", $subject,$description,$category,$product,$_GET['idTicket']))
		print $stmt->error;
		// Execute, get results and fetch
		if(!$stmt->execute()){
			$ticket_error = "show";
		}
		if($stmt->affected_rows == -1) {
			$ticket_error = "show";
		} else {
			$editticket_status="sent";
		}
		$stmt->close();
		unset($subject,$product,$category);
}
if(isset($_GET['idTicket']))
{
$categories = array();
$products = array();
// Prepare on Category
$stmt = $conn->prepare ( "SELECT idCategory, Name FROM ticketsys_db.Category" );
if (!$stmt) {
	$conn->error;
}
$stmt->execute();
if($stmt->bind_result($Bind_idCategory,$Bind_Name))
{
	while($stmt->fetch())
	{
		$categories[$Bind_idCategory] = $Bind_Name;
	}
}
$stmt->close();

// Prepare on Product
$stmt = $conn->prepare ( "SELECT idProduct, Name FROM ticketsys_db.Product" );
if (!$stmt) {
	$conn->error;
}
$stmt->execute();
if($stmt->bind_result($Bind_idProduct,$Bind_Name))
{
	while($stmt->fetch())
	{
		$products[$Bind_idProduct] = $Bind_Name;
	}
} else {
	$ticket_error = "show";
}
$stmt->close();

// FETCH TICKET
$query = "SELECT T.idTicket, T.Title,T.Description, T.Category, T.Product FROM ticketsys_db.Ticket as T ";
$query .= "WHERE T.Owner= ? AND T.idTicket= ? ;";
$stmt = $conn->prepare ( $query );
if (! $stmt) {
	$conn->error;
}
// Bind vars
if (! $stmt->bind_param ( "ii", $_SESSION ['user_id'], $_GET ['idTicket'] )) {
	$stmt->error;
}

// Execute, Store and Fetch
$stmt->execute ();
$stmt->store_result ();
if ($stmt->bind_result ( $Bind_id, $Bind_subject, $Bind_description, $Bind_category, $Bind_product )) {

	while ( $stmt->fetch () )
	{
		$ticket_subject = $Bind_subject;
		$ticket_description = $Bind_description;
		$ticket_category = $Bind_category;
		$ticket_product = $Bind_product;
	}
}
else
{
	$ticket_error = "show";
}
$stmt->close ();
$conn->close();
}
else 
{
	$ticket_error = "show";
}
function compareOption($ticket_op,$cur_op){
	if($ticket_op === $cur_op){
		return "selected";
	}
	return "";
}
?>