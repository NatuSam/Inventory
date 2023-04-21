<?php 
require "connection.php";
function low(){
    global $con;
    $query  = "select * from item where No_items < 10";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $low = 6;
    }
    else{
        $low =  7;
    }
    return $low;
}
?>