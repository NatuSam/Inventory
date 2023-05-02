<?php
require("connection.php");
function store($st){
global $con;   
$query = "select * from store where S_id = '$st'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result)>0){
 $_SESSION['store'] = mysqli_fetch_assoc($result); 
    echo("<div id=\"storeResultdis\" style=\"display:flex;\">
            <ul>
                 <li>Store ID:".$_SESSION['store']['S_id']."</li>
                 <li>Store Name:".$_SESSION['store']['Name']."</li>
                 <li>".$_SESSION['store']['Disc']."</li>
            </ul>
    </div>");

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
                    <td><a href=\"?pc=".$_SESSION['items']['P_code']."\"><button>Details</button> </a></td>
                </tr>
             </table>
            </div>");
        }
        $_SESSION['items'] = mysqli_fetch_assoc($result);
    }
  }
}
else {
    noStore();
}
}

function newStore($id,$name,$dis){
    global $con;
    $query = "select * from store where S_id = '$id' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $_SESSION['exist']=mysqli_fetch_assoc($result);
        existStore();
    }
    else{
    $query = "insert into `store`(`S_id`, `Name`, `Disc`) VALUES ('$id','$name','$dis')";
    $result = mysqli_query($con,$query);
    store($id);
    }
}



function transaction($tr,$sort){
global $con; 
        if ($tr == "in") {
            $query = "select * from t_in ORDER BY $sort DESC";
            
        } elseif ($tr == "out") {
            $query = "select * from t_out ORDER BY $sort DESC";
            
        }
    
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['Tr'] = mysqli_fetch_assoc($result);
        echo("
          <div id=\"Tresult\" style=\"display:block;\">
            <table>
               <tr>
                   <th>T id</td>
                   <th> Product code</th>
                   <th>Amount</th>
                   <th>Type</th>
                   <th> Date</th>
                </tr>
        ");
     while (!empty($_SESSION['Tr'])){
      if (!empty($_SESSION['Tr'])){
        echo(" 
                <tr>
                    <td>".$_SESSION['Tr']['T_id']."</td>
                    <td> <a href=\"?pc=".$_SESSION['Tr']['P_code']."\">
                    <button id=\"menu\">".$_SESSION['Tr']['P_code']."</button> </a></td>
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
            
        ");
        }
      $_SESSION['Tr'] = mysqli_fetch_assoc($result);
    
     }
        echo("</table></div>");
        }
    }
?>