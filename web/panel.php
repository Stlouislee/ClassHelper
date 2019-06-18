<?php

$sid = $_COOKIE["session"];


require("config.php");
$conn = new mysqli($servername, $username, $password);

//Check if the email esists
$sql = "SELECT user.uid, user.uname, session.uid, session.sid FROM ClassHelper.session JOIN ClassHelper.user ON session.uid = user.uid WHERE sid = \"$sid\"";
//echo $sql;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userName = $row["uname"];
$uid =  $row["uid"]

?>

<!DOCTYPE html>
<head>
	<title>P::ClassHelper</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
body
{
background-image:url('images/bg-02.png');
background-size:cover
}
</style>
<body>

<br/>
<br/>

<div class="container">

    <div class="row" >
    <div class="col s12 m6" >
      <div class="card big">
        <div class="card-image">
          <img src="images/3.gif">
          <span class="card-title"><?php echo "Welcome, ".$userName;?></span>
        </div>
        <div class="card-content">
          <p>Spring breeze miles, less than to meet you; Clear blue skies, not as good as you are in my heart. </p>
        </div>
        <div class="card-action">
          <a href="class/allClass.php">Setting</a>
        </div>
      </div>
    </div>

    <?php global $uid;include "class/current.php";?>

    <?php global $uid;include "class/nextclass.php";?>

    <?php global $uid;include "todo/mainTodo.php";?>


  </div>
            







</div>


</body>