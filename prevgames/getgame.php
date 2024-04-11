<?php
session_start();
require_once("database.php");

$db= $conn;
$tableName="checkers";
$columns= ['id', 'gameId', 'player1', 'player2', 'time','date'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{
$id = $_SESSION['player']['id'];
$query = "SELECT * FROM $tableName WHERE player1 = $id or player2 = $id";
$result = $db->query($query);

if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>
