<?php
require("connection.php");

function newP($pcode, $name, $num, $store, $place){
    global $con;
    
    $query = "select * from item where Name = '$name' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        
        $_SESSION['exist']=mysqli_fetch_assoc($result);
        existProduct();
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
    result();
    }
   }
}
?>