<?php 
require("connection.php");
function check($pc){
global $con;
$query = "select * from item where P_code = '$pc' limit 1";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
$_SESSION['item']=mysqli_fetch_assoc($result);
$action=1;
}
else{
    $action=2;
}
return $action;
}
?>
