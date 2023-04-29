<?php
require("connection.php");

function check($pc){
    global $con;
    $query = "select * from item where P_code = '$pc' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
    $_SESSION['item']=mysqli_fetch_assoc($result);
    result();
    }
    else{
        noProduct();
    }
    
    }
function take( $Tpcode,$num){
global $con;
$amt=$_SESSION['item']['No_items']-$num;
if($num>0 &&$amt>=0){
/*$query = " update item set No_items ='$amt' WHERE P_code = '$Tpcode'";
$result=mysqli_query($con,$query);
$query = "select * from item where P_code = '$Tpcode' limit 1";
$result=mysqli_query($con,$query);
$_SESSION['item']=mysqli_fetch_assoc($result);  */

$date=date("Y-m-d H:i:s");
$query = " insert into T_out(P_code,Amount,date,orders) VALUES ('$Tpcode','$num','$date','store')";
$result=mysqli_query($con,$query);
 //result();
 
}
else if($amt<0){
    noProductAmt($num,$amt);
}
else if($num<=0){
    negativeAmt();
}

}
function take1($Tpcode,$num){  
global $con; 
$query = "select * from item where P_code = '$Tpcode' limit 1";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0&&$num>0){
  $_SESSION['item']=mysqli_fetch_assoc($result);
  $amt = $_SESSION['item']['No_items']-$num;
  if($amt>=0){
   take($_SESSION['item']['P_code'],$num);
  }
  else{
     noProductAmt($num,$amt);
  }
}
else if(!mysqli_num_rows($result)>0){
   noProduct();
}
else if($num<0){
    negativeAmt();
}

}
?>