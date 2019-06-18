<?php
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

$sql = "INSERT INTO course VALUES (NULL,\"{$_POST["cname"]}\",\"{$_POST["cweek_begin"]}\",\"{$_POST["cweek_end"]}\",\"{$_POST["ctime_begin"]}\",\"{$_POST["ctime_end"]}\",\"{$_POST["clocation"]}\",\"{$_POST["cday"]}\",{$uid})";
$conn->query($sql);
header("Location:/web/class/allClass.php");
?>