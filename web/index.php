<?php

// 取出 cookie 值
$expire=time()+60*60*24*30;
if(!$_COOKIE["session"]){
  header("Location:/web/login.html");
}
//echo $_COOKIE["session"];

$sid = $_COOKIE["session"];

$servername = "cloud.steder.cc";
$username = "ClassHelper";
$password = "****";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
//echo "连接成功";

$checkSessionSQL = "SELECT * from session where sid = $sid";
mysqli_select_db( $conn, 'ClassHelper' );
$result = $conn->query($checkSessionSQL);

if ($result->num_rows > 0){ //Vaild Session
  //Begin the panel codes here, or redirect the page
  echo "login success";
}else{
  header("Location:/web/login.html");
  exit;
}
?>