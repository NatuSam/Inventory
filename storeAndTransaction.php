<?php
require("connection.php");
function store($st){
global $con;   
$query = "select * from item where S_id = '$st'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
         $_SESSION['items'] = mysqli_fetch_assoc($result);
    while (!empty($_SESSION['items'])){
        if (!empty($_SESSION['items'])){
          echo("<div id=\"storeResult\" style=\"display:flex;\">
                
            <table>
                <tr>
                    <td>Product code:</td>
                    <td>".$_SESSION['items']['P_code']."</td>
                </tr>
                <tr>
                    <td>Name of product:</td>
                    <td>".$_SESSION['items']['Name']."</td>
                </tr>
                <tr>
                    <td>Store:</td>
                    <td>".$_SESSION['items']['Location']."</td>
                </tr>
                <tr>
                    <td><a href=\"?pc=".$_SESSION['items']['P_code']."\">Details </a></td>
                </tr>
             </table>
            </div>");
        }
        $_SESSION['items'] = mysqli_fetch_assoc($result);
    }
  }
}


function transaction($tr,$sort){
global $con; 
        if ($tr == "in") {
            $query = "select * from T_in GROUP BY $sort";
        } elseif ($tr == "out") {
            $query = "select * from T_out GROUP BY $sort";
        }
    
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['Tr'] = mysqli_fetch_assoc($result);
        echo("
          <div id=\"Tresult\" style=\"display:block;\">
            <table border=\"2px solid black\">
               <tr>
                   <td>T id</td>
                   <td> Product code</td>
                   <td>Amount</td>
                   <td>Type</td>
                   <td> Date</td>
                </tr>
            </table>");
     while (!empty($_SESSION['Tr'])){
      if (!empty($_SESSION['Tr'])){
        echo(" 
            <table border=\"2px solid black\">
                <tr>
                    <td>".$_SESSION['Tr']['T_id']."</td>
                    <td><a id=\"menu\"
                      href=\"?pc=".$_SESSION['Tr']['P_code']."\">".$_SESSION['Tr']['P_code']."</a>
                    </td>
                    <td>".$_SESSION['Tr']['Amount']."</td>
                    <td>
        ");
                    if (!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU'] == 'N') {
                       echo "New";
                   } else if (!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU'] == 'U') {
                       echo "Update";
                   } else if (empty($_SESSION['Tr']['NorU'])) {
                       echo "Out";
                   }
        echo("     </td>
                   <td>".$_SESSION['Tr']['date']."</td>
                   </tr>
            </table>
        ");
        }
      $_SESSION['Tr'] = mysqli_fetch_assoc($result);
    
     }
        echo("</div>");
        }
    }
?>