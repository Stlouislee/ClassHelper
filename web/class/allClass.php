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

$sql = "SELECT * FROM course WHERE uid = \"$uid\"";
$result = $conn->query($sql);
function genRow($cweekbegin,$cweekend,$cname,$cid){
  return <<<"ROW"
          <tr>
            <td>$cweekbegin-$cweekend</td>
            <td>$cname</td>
            <td><i class="material-icons" ><a href="/web/class/removeClass.php?cid={$cid}">delete_forever</a></i></td>
          </tr>
ROW;
}
$rowContent = "";
for($i = 0;$i<$result->num_rows;$i++){
  $row = $result->fetch_assoc();
  $rowContent = $rowContent.genRow($row["cweek_begin"],$row["cweek_end"],$row["cname"],$row["crid"]);
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
<h1><i class="large material-icons"><a href="/web/panel.php">arrow_back</a></i> Cource Management </h1>
  <div class="row">
    <div class="col s12 m6 l6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">All Classes</span>
          
<table>
        <thead>
          <tr>
              <th>Week Interval</th>
              <th>Class Name</th>
              <th>Remove</th>
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
      <form name="form1" action="addClass.php" method="POST">
      <div class="input-field">
        <p><b>Class Name</b><input type="text" name="cname"></p>
        <p><b>Weekday</b><input type="text" name="cday"></p>
        <p><b>Location</b><input type="text" name="clocation"></p>
        <p><b>Week Begin</b><input type="text" name="cweek_begin"></p>
        <p><b>Week End</b><input type="text" name="cweek_end"></p>
        <p><b>Num Start</b><input type="text" name="ctime_begin"></p>
        <p><b>Num End</b><input type="text" name="ctime_end"></p>

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
