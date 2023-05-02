<?php 

function result($btt){

echo("
    <table id=\"Result\" style=\"display:block;\">
        <tr>
            <td>Product code:</td>
            <td>".$_SESSION['item']['P_code']."</td>
        </tr>
        <tr>
            <td>Name of product:</td>
            <td>".$_SESSION['item']['Name']."</td>
        </tr>
        <tr>
            <td>Number of product: </td>
            <td>".$_SESSION['item']['No_items']."</td>
        </tr>
        <tr>
            <td>Store: </td>
            <td>".$_SESSION['item']['S_id']."</td>
        </tr>
        <tr>
            <td> Placed at:</td>
            <td>".$_SESSION['item']['Location']."</td>
        </tr>");
    if($btt=="check"){
    echo("
        <tr>
            <td><button onclick=\"hide(6);\">ADD</button>
                <button onclick=\"hide(7);\">Take</button>
                <button id=\"print\"
                onclick=\"downloadQRCode();\";>Print</button></td>
        <tr>");}
    
    echo("</table>");
}

function noProduct(){
               echo(" <p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    Found no product by that id! </p>
                    ");}
function noProductAmt($num,$amt){
                echo("  <p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    There is no ".$num." product!<br>
                    There is only ".$amt + $num." items.</p><br>
                    ");}
function existProduct($ch){
    if($ch=="Name")
                echo("<p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    Product Exist! as product code ".
                    $_SESSION['exist']['P_code']." </p>");
    else{
        echo("<p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
        Product Exist! as product Name ".
        $_SESSION['exist']['Name']." </p>"); 
    }}
function negativeAmt(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                    The Amount can't be negative or Zero!</p>)");}
function Lowstock(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                There is low item in the stock! </p>");}
function existStore(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                Store exists! </p>");}
function noStore(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                Found no Store By that id! </p>");}

?>