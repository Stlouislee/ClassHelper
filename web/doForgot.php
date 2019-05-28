<?php

$email = $_POST["email"];

require("config.php");
$conn = new mysqli($servername, $username, $password);

//Check if the email esists
$sql = "SELECT * FROM ClassHelper.user WHERE email=\"$email\"";
$result = $conn->query($sql);
if($result->num_rows==0){
  header("Location:/web/forgot.php?prompt=Application has been sent.");
  exit;
}

//Get UID
$row = $result->fetch_assoc();
$uid =  $row["uid"];
$key = md5(time()).md5($row["uname"]);

//Insert forgot record to the database
$sql = "INSERT INTO ClassHelper.forgot VALUES(\"$uid\",\"$key\")";
$conn->query($sql);
//echo $sql;

//Start Sending Email


$str = <<<EOD
Dear $username,
You has requested a password reset on ClassHelper.\n
The key used to verify the reset is $key \n
Please visit http://demo.redets.ga/web/resetPwd.php to reset your password.
EOD;


$to = $email;         // 邮件接收者
$subject = "Password Reset";                // 邮件标题
$body = $str;  // 邮件正文
$from = "classhelper@mail.steder.cc";   // 邮件发送者

require_once "Mail.php";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtpdm.aliyun.com',
        'port' => '465',
        'auth' => true,
        'username' => 'classhelper@mail.steder.cc', //your gmail account
        'password' => '****' // your password
    ));

// Send the mail
$mail = $smtp->send($to, $headers, $body);
header("Location:/web/resetPwd.php?prompt=Application has been sent.");
exit;

?>
