<?php
require("connection.php");
function take( $Tpcode,$num){
global $con;
$amt=$_SESSION['item']['No_items']-$num;
if($num>0 &&$amt>=0){
$query = " update item set No_items ='$amt' WHERE P_code = '$Tpcode'";
$result=mysqli_query($con,$query);
$query = "select * from item where P_code = '$Tpcode' limit 1";
$result=mysqli_query($con,$query);
$_SESSION['item']=mysqli_fetch_assoc($result);

$date=date("Y-m-d H:i:s");
$query = " insert into T_out(P_code,Amount,date) VALUES ('$Tpcode','$num','$date')";
$result=mysqli_query($con,$query);
$action=1;
}
else if($amt<0){
    $action=3;
}
else if($num<=0){
    $action=5;
}
return $action;
}
function take1($Tpcode,$num){  
global $con; 
$query = "select * from item where P_code = '$Tpcode' limit 1";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0&&$num>0){
  $_SESSION['item']=mysqli_fetch_assoc($result);
  if($_SESSION['item']['No_items']-$num>=0){
  $action = take($_SESSION['item']['P_code'],$num);
  }
  else{
    $action=3;
  }
}
else if(!mysqli_num_rows($result)>0){
    $action=2;
}
else if($num<0){
    $action = 5;
}
return $action;
}
?>