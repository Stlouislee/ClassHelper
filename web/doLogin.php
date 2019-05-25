<?php

$servername = "cloud.steder.cc";
$username = "ClassHelper";
$password = "****";
// 创建连接
$conn = new mysqli($servername, $username, $password);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
//echo "连接成功";

print_r($_POST);
$testLogin = $_POST["id"];
$testPasswd = $_POST["pwd"];

//echo $testLogin;
//echo $testPasswd;

$loginSQL = "SELECT * from ClassHelper.user where uname = \"$testLogin\" and upasswd = \"$testPasswd\"";

$result = $conn->query($loginSQL);
if ($result->num_rows > 0){
  echo "Login Success";
  $row = $result->fetch_assoc();
  $uid = $row["uid"];
  echo $uid;
  $newsid = time();
  echo $newsid;
  $newsidSQL =  "INSERT INTO `session` (`sid`, `stime`, `uid`) VALUES ('$newsid',  CURRENT_TIMESTAMP, '$uid')";
  echo $newsidSQL;
  mysqli_select_db( $conn, 'ClassHelper' );
  $conn->query($newsidSQL);
  $expire=time()+60*60*24*30;
  setcookie("session", $newsid, $expire);
  header("Location:/web/index.php");
  exit;


} else {
  echo "Fail to login";
  print_r($result);
}
?>