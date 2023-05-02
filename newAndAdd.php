<?php
require("connection.php");

function addN($Anpcode,$num){
    global $con;
    $amt=$_SESSION['item']['No_items']+$num;
    if($num>0){
    $query = " update item set No_items ='$amt' WHERE P_code = '$Anpcode'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where P_code = '$Anpcode' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);

    $date=date("Y-m-d H:i:s");
    $query = " insert into T_in(P_code, NorU,Amount,date) VALUES ('$Anpcode','U','$num','$date')";
    $result=mysqli_query($con,$query);
    result("addN");
    }
    elseif($num<=0) {
      negativeAmt();
    }
}

function addN1($Anpcode,$num){
    global $con;   
    $query = "select * from item where P_code = '$Anpcode' limit 1";
    $result1=mysqli_query($con,$query);
      if(mysqli_num_rows($result1)>0){
        $_SESSION['item']=mysqli_fetch_assoc($result1);
        addN($_SESSION['item']['P_code'],$num);
      }
      else {
        noProduct();
      }
      
      
}

function newP($pcode, $name, $num, $store, $place){
    global $con;
    $query = "select * from item where Name = '$name' limit 1";
    $name_result=mysqli_query($con,$query);
    $query = "select * from item where P_code = '$pcode' limit 1";
    $pcode_result=mysqli_query($con,$query);
    $query = "select * from store where S_id = '$store' limit 1";
    $store_result=mysqli_query($con,$query);
    if(mysqli_num_rows($name_result)>0){
        $_SESSION['exist']=mysqli_fetch_assoc($name_result);
        existProduct("Name");
    }
    else if(mysqli_num_rows($pcode_result)>0){
      $_SESSION['exist']=mysqli_fetch_assoc($pcode_result);
      existProduct("P_code");
    }
    else if(mysqli_num_rows($store_result)<=0){
      noStore();
    }
    else{
    $query = "insert into item(P_code,Name, No_items, S_id,Location) VALUES ('$pcode','$name','$num','$store','$place')";
    $result=mysqli_query($con,$query);

    $query = "select * from item where Name = '$name' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
     $_SESSION['item']=mysqli_fetch_assoc($result);
     $date=date("Y-m-d H:i:s");
     $newid= $_SESSION['item']['P_code'];
    $query = " insert into T_in(P_code, NorU,Amount,date) VALUES ('$newid','N','$num','$date')";
    $result=mysqli_query($con,$query);
    result("newP");
    }
   }
}

?>