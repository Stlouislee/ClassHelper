<?php
$sid = $_COOKIE["session"];
$tid = $_GET["tid"];

require("dbconfig.php");
$conn = new mysqli($dbServer,$dbUser,$dbpasswd,$dbName);
$sql = "SELECT * FROM session WHERE sid = \"$sid\"";
$result = $conn->query($sql);
if($result->num_rows ==0){
  //echo "Session Error";
  header("Location:/signout.php");
  exit;
}
$row = $result->fetch_assoc();
$uid = $row["uid"];

$sql = "UPDATE todo SET done = 1 WHERE tid = \"$tid\"";
$conn->query($sql);
header("Location:/web/todo/allTodo.php");
?>
