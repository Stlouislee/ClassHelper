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

$sql = "SELECT * FROM todo WHERE uid = \"$uid\"";
$result = $conn->query($sql);
function genRow($task,$ddl,$tid){
  return <<<"ROW"
          <tr>
            <td>$task</td>
            <td>$ddl</td>
            <td><i class="material-icons" ><a href="deleteTodo.php?tid=$tid">change_history</a></i></td>
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
background-image:url('/web/images/444.jpg');
background-size:cover
}

</style>

<body>
<div class="container">
      <h1>TODO</h1>
      <table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th>Item Price</th>
          </tr>
        </thead>

        <tbody>
          

          <?php echo $rowContent; ?>



        </tbody>
      </table>


      <h3>Add New Task</h3>
      <form action="addTodo.php" method="POST">
      <div class="input-field">
        <p>Task<input type="text" name="task"></p>
        <p>DDL Date<input type="text" name = "date" class="datepicker"></p>
        <p>DDL Time<input type="text" name = "time" class="timepicker"></p>
      </div>
      <button class="login100-form-btn" type="submit">登 录</button>
      </form>

</div>
</body>
