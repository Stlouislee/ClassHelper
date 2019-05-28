<?php
$ddlDate = $_POST["date"];
$task = $_POST["task"];
$ddlTime = date('H:m:s',strtotime($_POST["time"]));
require("dbconfig.php");
$conn = new mysqli($dbServer,$dbUser,$dbpasswd,$dbName);
$sid = $_COOKIE["session"];
$sql = "SELECT * FROM session WHERE sid = \"$sid\"";
$result = $conn->query($sql);
if($result->num_rows ==0){
  //echo "Session Error";
  header("Location:/signout.php");
  exit;
}
$row = $result->fetch_assoc();
$uid = $row["uid"];

$sql = "INSERT INTO todo VALUES (NULL,\"$task\",\"$ddlDate $ddlTime\",0,$uid)";
$conn->query($sql);
header("Location:/web/todo/allTodo.php");
?>