<?php
$newUserName = $_POST["id"];
$newEmail = $_POST["email"];
$newPasswd = $_POST["pwd"];

//Database Info:

$servername = "cloud.steder.cc";
$username = "ClassHelper";
$password = "****";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    header("Location:/web/signup.php?warnMsg=$conn->connect_error");
    exit;
} 


//Check User Name
$sql = "SELECT * from ClassHelper.user WHERE uname=\"$newUserName\"";
$result = $conn->query($sql);
if ($result->num_rows > 0){ //User name already exist
  header("Location:/web/signup.php?warnMsg=User%20Name: $newUserName%20is%20already%20registered");
  exit;
}

//Check Email
$sql = "SELECT * from ClassHelper.user WHERE email=\"$newEmail\"";
$result = $conn->query($sql);
if ($result->num_rows > 0){ //User name already exist
  header("Location:/web/signup.php?warnMsg=Email: $newEmail%20is%20already%20registered");
  exit;
}

//If all those check passed
$sql = "INSERT INTO ClassHelper.user VALUES (NULL,\"$newUserName\",\"$newPasswd\",\"$newEmail\")";
echo $sql;
$conn->query($sql);
header("Location:/web/login.php?warnMsg=Registered Successfully");


//header("Location:/web/signup.php?warnMsg=$sql");

echo $newUserName.$newEmail.$newPasswd;
?>