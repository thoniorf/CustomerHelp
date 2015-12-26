<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$host = getenv('host_db');
$user = getenv('user_db');
$pswd = getenv('pswd_db');

// Create connection
$conn = new mysqli($host,$user,$pswd);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
print"Connected successfully\n";
$result = $conn->query("SELECT * FROM ticketsys_db.User");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["idUser"] . '",';
    $outp .= '"Email":"'   . $rs["Email"]        . '"}'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();

print($outp);
?>

