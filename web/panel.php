<?php

$sid = $_GET["sid"];
$uid = -1;

$servername = "cloud.steder.cc";
$username = "ClassHelper";
$password = "****";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  echo "internal error";
}

//Get uid
$sql = "SELECT user.uid, user.uname, session.uid, session.sid FROM ClassHelper.session JOIN ClassHelper.user ON session.uid = user.uid WHERE sid = \"$sid\"";
//echo $sql;
$result = $conn->query($sql);
if($result->row_num =0){
  echo $result->row_num;
  echo "Session Error";
}else{
  $row = $result->fetch_assoc();
  echo "Welcome, ".$row["uname"];
  echo "<br>";
  echo "<a href=\"signout.php\" class=\"txt2\">Sign out</a>";

}

?>