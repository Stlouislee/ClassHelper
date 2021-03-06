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

$sql = "SELECT * FROM todo WHERE done = 0 and uid = \"$uid\"";
$result = $conn->query($sql);
function genRow($task,$ddl,$tid){
  return <<<"ROW"
          <tr>
            <td>$task</td>
            <td>$ddl</td>
            <td><i class="material-icons" ><a href="/web/todo/removeTodo.php?tid=$tid">change_history</a></i></td>
          </tr>
ROW;
}
$rowContent = "";
for($i = 0;$i<$result->num_rows;$i++){
  $row = $result->fetch_assoc();
  $rowContent = $rowContent.genRow($row["task"],$row["ddl"],$row["tid"]);
}
?>

<!DOCTYPE html>
<head>
	<title>Panel::ClassHelper</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {"autoClose":true,"format":"yyyy-mm-dd"});
  });

    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems, {"twelveHour":false});
  });
  </script>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<style>
body
{
background-image:url('/web/images/bg-02.png');
background-size:cover
}

</style>

<body>
<div class="container">
<h1><i class="large material-icons"><a href="/web/panel.php">arrow_back</a></i> TODO </h1>
  <div class="row">
    <div class="col s12 m6 l6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">All Task</span>
          
<table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          

          <?php echo $rowContent; ?>



        </tbody>
      </table>


        </div>
      </div>
    </div>

    <div class="col s12 m6 l6">
      <div class="card white">
        <div class="card-content">
          <span class="card-title"><b>Add</b></span>
          <p>
      <form name="form1" action="addTodo.php" method="POST">
      <div class="input-field">
        <p><b>Task</b><input type="text" name="task"></p>
        <p><b>DDL Date</b><input type="text" name = "date" class="datepicker"></p>
        <p><b>DDL Time</b><input type="text" name = "time" class="timepicker"></p>
      </div>
      </form>
      </p>
        </div>
        <div class="card-action">
          <a href="javascript:document.form1.submit();">Add</a>
        </div>
      </div>
    </div>
  </div>
         

      
      




</div>
</body>
