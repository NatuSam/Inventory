<?php
require("connection.php");
function newEmp($Ename,$pos,$pass){
    global $con;
    $query = "insert into employee(Name,Position,Password) VALUES ('$Ename','$pos','$pass')";
    $result = mysqli_query($con, $query);
}


function pReset($Ename,$Epass,$Aname,$Apass){
    global $con;
    $query = "Select * from employee where Name = '$Aname' AND Position = 'Admin' AND Password = '$Apass' ";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)>0){
        $query = "update employee set Password ='$Epass' where Name = '$Ename' ";
        $result = mysqli_query($con, $query);
    }
}

?>