<?php
$categories = array();
$products = array();
$ticket_error = 'hidden';
// Create new connection
$conn = new mysqli ( $host, $user, $pswd );

// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}


	
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

if(isset($_POST['inputSubject'],$_POST['inputCategory'],$_POST['inputProduct'],$_POST['inputDescription']))
{	
	$date = date("Y-m-d H:i:s");
	$owner = $_SESSION['user_id'];
	// Filter fieds
	$subject = filter_var ( $_POST['inputSubject'], FILTER_SANITIZE_STRING );
	$product = filter_var ( $_POST['inputProduct'], FILTER_SANITIZE_STRING );
	$category = filter_var ( $_POST['inputCategory'], FILTER_SANITIZE_STRING );
	$description = filter_var ( $_POST['inputDescription'], FILTER_SANITIZE_STRING );

	// Prepare the statemnt
	$stmt = $conn->prepare ( "Insert into ticketsys_db.Ticket (Title,Description,Category,Product,Owner,AssignedTo,Date,Label) values (?,?,?,?,?,NULL,?,'Open');" );
	if (!$stmt) {
		$conn->error;
	}
	// Bind vars
	if(!$stmt->bind_param ( "ssssss", $subject,$description,$category,$product,$owner,$date))
		print $stmt->error;
	// Execute, get results and fetch 
	if(!$stmt->execute()){
		
	} else {
		$ticket_error = "show";
	}
	if($stmt->affected_rows == -1) {
		$ticket_error = "show";
	} else {
		$addticket_status="sent";
	}
	$stmt->close();
	unset($subject,$product,$category);
}
		
$conn->close();
?>