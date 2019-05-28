<?php
$key = $_POST["key"];
$newPwd = $_POST["pwd"];

require("config.php");
$conn = new mysqli($servername, $username, $password);

//Check if the email esists
$sql = "SELECT * FROM ClassHelper.forgot WHERE resetkey=\"$key\"";
$result = $conn->query($sql);
if($result->num_rows==0){
  header("Location:/web/resetPwd.php?warnMsg=No key matched.");
  exit;
}

//Get UID
$row = $result->fetch_assoc();
$uid = $row["uid"];

//Remove the key in database
$sql = "DELETE FROM ClassHelper.forgot WHERE uid = \"$uid\"";
$conn->query($sql);

//Update Password
$sql = "UPDATE ClassHelper.user SET upasswd = \"$newPwd\" WHERE uid = \"$uid\"";
$conn->query($sql);
header("Location:/web/login.php?prompt=Your new password is applied.");
exit;

?>