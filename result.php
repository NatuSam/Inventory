<?php 

function result(){
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
        </tr>
        <tr>
            <td><a href=\"#\" class=\"resOp\" onclick=\"hide(6);\">ADD</a></td>
            <td><a href=\"#\" class=\"resOp\" onclick=\"hide(7);\">Take</a></td>
            <td> <a href=\"#\" onclick=\"QRCode();\">Print</a></td>
    </table>
"
); }

function noProduct(){
               echo(" <p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    Found no product by that id! </p>
                    ");}
function noProductAmt($num,$amt){
                echo("  <p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    There is no".$num." product!<br>
                    There is only ".$amt + $num." items.</p><br>
                    ");}
function existProduct(){
                echo("<p id=\"Result\" style=\"display:block; padding-left: 10%; width:30%;\">
                    Product Exist! as product code ".
                    $_SESSION['exist']['P_code']." </p>");}
function negativeAmt(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                    The Amount can't be negative or Zero!</p>)");}
function Lowstock(){
                echo("<p id=\"Result\" style=\"display:block;padding-left: 10%; width:30%;\">
                There is low item in the stock! </p>");}

?>