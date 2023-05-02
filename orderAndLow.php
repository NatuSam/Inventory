<?php 
require("connection.php");
function ordercheck(){
global $con;
$query = "select * from t_out where orders = 'store' limit 6";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    $_SESSION['order'] = mysqli_fetch_assoc($result);
    echo("<div>");
   while (!empty($_SESSION['order'])){
       if (!empty($_SESSION['order'])){
         echo("<table id=\"order\" style=\"display:block; color: white; border:2px solid red;\">
        <tr>
            <td>Product code:</td>
            <td>".$_SESSION['order']['P_code']."</td>
        </tr>
        <tr>
            <td>
                Amount:</td>
            <td>".$_SESSION['order']['Amount']."</td>
        </tr>
        <tr>
            <td> <form method='POST' style=\"display:block\"><button name=\"done\" value=".$_SESSION['order']['T_id']."\">Done </button></form></td>
        </tr>
    </table><br>");
}
$_SESSION['order'] = mysqli_fetch_assoc($result);
}
echo("</div>");
}

}

function orderdone($orderid){
global $con;
$query = "select * from t_out where T_id = '$orderid' limit 1";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    $_SESSION['order'] = mysqli_fetch_assoc($result);
    $Tpcode =  $_SESSION['order']['P_code'];
    $query = "select * from item where P_code = '$Tpcode' limit 1";
    $result = mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);
    $amt = $_SESSION['item']['No_items'] - $_SESSION['order']['Amount'];
    
    $query = " update item set No_items ='$amt' WHERE P_code = '$Tpcode'";
    $result=mysqli_query($con,$query);
    $query = " update t_out set orders ='done' WHERE T_id = '$orderid' AND P_code = '$Tpcode'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where P_code = '$Tpcode' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);
    
    result("order");
}
}
//require("result.php");
function low(){
    global $con;
    $query  = "select * from item where No_items < 10";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        Lowstock();
    }
}
?>