<?php
$sid = $_COOKIE["session"];
$crid = $_GET["cid"];

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

$sql = "DELETE FROM course WHERE crid = \"$crid\"";
$conn->query($sql);
header("Location:/web/class/allClass.php");
?>
