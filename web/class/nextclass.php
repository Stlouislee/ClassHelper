<?php



//Get current info.
$currentClassNumber = currentClassNumber();
$currentDay = date('w');
$currentWeek = (int)(((time()-1551024000)/86400)/7)+1;
$ccn = currentClassNumber(); 
//Database connection info.
require("dbconfig.php");

//Establish connection
$sql = "SELECT * FROM classList WHERE cday=$currentDay and cweek_begin <=$currentWeek and cweek_end>=$currentWeek and ctime_begin<= $currentClassNumber and ctime_end >= $currentClassNumber and uid = $uid order by classDay,beginNum ASC";
$con = new mysqli($dbServer,$dbUser,$dbpasswd,$dbName);
if($con->connect_error){
  die("Connection Failed".$con->connect_error);
}

$output ="";
$sql = "Select * from ClassHelper.course where cweek_begin <=$currentWeek and cweek_end>=$currentWeek and cday=$currentDay and ctime_begin>$ccn and uid=$uid order by ctime_begin";
mysqli_select_db( $con, 'ClassHelper' );
$result = $con->query($sql);
$jRA = [];
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $output =  $row["cname"]."@".$row["clocation"];
}else $output = "No Class Left Today.";
?>



<div class="col s12 m6">
      <div class="card blue-grey darken-1" style="background-image:url('images/222.jfif');
background-size:cover">
        <div class="card-content white-text">
          <span class="card-title"><b>The next class is</b></span>
          <p><?php echo $output?></p>
        </div>
      </div>
</div>