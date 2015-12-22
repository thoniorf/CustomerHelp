<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("127.0.0.1", "moderator", "1234", "Ticketsys_db");

$result = $conn->query("SELECT * FROM User");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["idUser"] . '",';
    $outp .= '"Email":"'   . $rs["Email"]        . '",'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>
