<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$host = getenv('host_db');
$user = getenv('user_db');
$pswd = getenv('pswd_db');

<<<<<<< HEAD
// Create connection
//$conn = new mysqli("localhost", "moderator", "1234");
$conn = new mysqli($host,$user,$pswd);
=======
$conn = new mysqli("127.0.0.1", "moderator", "", "Ticketsys_db");
>>>>>>> fd285205b045914dadafab342cdeb7a284b81b0b

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

