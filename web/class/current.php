<?php

function checkIsBetweenTime($start,$end){
    $date= date('H:i');
    $curTime = strtotime($date);//当前时分
    $assignTime1 = strtotime($start);//获得指定分钟时间戳，00:00
    $assignTime2 = strtotime($end);//获得指定分钟时间戳，01:00
    $result = 0;
    if($curTime>$assignTime1&&$curTime<$assignTime2){
        $result = 1;
    }
    return $result;
}

function currentClassNumber(){
  if(checkIsBetweenTime("0:00","8:00")==1){ return 0.5;}
  if(checkIsBetweenTime("8:00","8:40")==1){ return 1;}
  if(checkIsBetweenTime("8:40","8:50")==1){ return 1.5;}
  if(checkIsBetweenTime("8:50","9:30")==1){ return 2;}
  if(checkIsBetweenTime("9:30","9:40")==1){ return 2.5;}
  if(checkIsBetweenTime("9:40","10:20")==1) {return 3;}
  if(checkIsBetweenTime("10:20","10:40")==1){ return 3.5;}
  if(checkIsBetweenTime("10:40","11:20")==1){ return 4;}
  if(checkIsBetweenTime("11:20","11:30")==1){ return 4.5;}
  if(checkIsBetweenTime("11:30","12:10")==1){ return 5;}
  if(checkIsBetweenTime("12:10","12:50")==1){ return 5.5;}
  if(checkIsBetweenTime("12:50","13:30")==1){ return 6;}
  if(checkIsBetweenTime("13:30","13:40")==1){ return 6.5;}
  if(checkIsBetweenTime("13:40","14:20")==1){ return 7;}
  if(checkIsBetweenTime("14:20","14:30")==1){ return 7.5;}
  if(checkIsBetweenTime("14:30","15:10")==1){ return 8;}
  if(checkIsBetweenTime("15:10","15:20")==1){ return 8.5;}
  if(checkIsBetweenTime("15:20","16:00")==1){ return 9;}
  if(checkIsBetweenTime("16:00","16:10")==1){ return 9.5;}
  if(checkIsBetweenTime("16:10","16:50")==1){ return 10;}
  if(checkIsBetweenTime("16:50","17:00")==1) {return 10.5;}
  if(checkIsBetweenTime("17:00","17:40")==1) {return 11;}
  if(checkIsBetweenTime("17:40","19:00")==1){ return 11.5;}
  if(checkIsBetweenTime("19:00","19:40")==1){ return 12;}
  if(checkIsBetweenTime("19:40","19:50")==1){ return 12.5;}
  if(checkIsBetweenTime("19:50","20:30")==1){ return 13;}
  if(checkIsBetweenTime("20:30","20:40")==1) {return 13.5;}
  if(checkIsBetweenTime("20:40","21:20")==1){ return 14;}
  if(checkIsBetweenTime("21:20","23:59")==1){ return 14.5;}
  return 15;
}

function endTime($classEndNum){
  switch($classEndNum){
    case 1: return "8:40";
    case 2: return "9:30";
    case 3: return "10:20";
    case 4: return "11:20";
    case 5: return "12:10";
    case 6: return "13:30";
    case 7: return "14:20";
    case 8: return "15:10";
    case 9: return "16:00";
    case 10: return "16:50";
    case 11: return "17:40";
    case 12: return "19:40";
    case 13: return "20:30";
    case 14: return "21:20";
    dafault: return "Wrong Class Number";
  }
}


//Get current info.
$currentClassNumber = currentClassNumber();
$currentDay = date('w');
$currentWeek = (int)(((time()-1551024000)/86400)/7)+1;

//Database connection info.
require("dbconfig.php");

//Establish connection
$sql = "SELECT * FROM course WHERE cday=$currentDay and cweek_begin <=$currentWeek and cweek_end>=$currentWeek and ctime_begin<= $currentClassNumber and ctime_end >= $currentClassNumber and uid = $uid order by cday,ctime_begin ASC";
$con = new mysqli($dbServer,$dbUser,$dbpasswd,$dbName);
if($con->connect_error){
  die("Connection Failed".$con->connect_error);
}

$output ="";
mysqli_select_db( $con, 'ClassHelper' );
$result = $con->query($sql);
if($result->num_rows>0){
  $row = $result->fetch_assoc();
  if(is_int($currentClassNumber)){
    $output =  "Current: ".$row["cname"].",end at ".endTime($row["ctime_end"]);
  }else $output = "Break Time of ".$row["cname"];
}else $output = "No ongoing class.";
?>

<div class="col s12 m6">
      <div class="card blue-grey darken-1" style="background-image:url('images/333.jpg');
background-size:cover">
        <div class="card-content white-text">
          <span class="card-title"><b>Current Class</b></span>
          <p style="font-style:italic;"><?php echo $output;?></p>
          <p align="right"><a class="btn-floating waves-effect waves-light blue" href="#"><i class="material-icons">book</i></a></p>
                              

        </div>
      </div>
</div>