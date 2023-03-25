<?php 
require "connection.php";
session_unset(); 
$action=0;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id= htmlspecialchars($_POST['id']);
    $name= htmlspecialchars($_POST['name']);
    $pos=htmlspecialchars($_POST['pos']);
    $pword= htmlspecialchars($_POST['pword']);
    $query = "Select * from Employee where Name = '$name' AND password = '$pword' AND Position = '$pos'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)>0){
            
        $_SESSION['Emp'] = mysqli_fetch_assoc($result);
        header("location: index.php");
        die;
    }
    else{
        $action=1;
    }
}

?>
<html>
    <head>
        <title>Inventory</title>
        <link rel="stylesheet" href="home.css">
            <script>
                function sinin(){
                var name = window.prompt("Enter your Name");
               var p = window.prompt("Enter your password");
                }
            </script>   
            <style>
                #login{
    display: block;
    margin-left: 35%;
    margin-top:20px;
    width: fit-content;
    font-size: larger;
    border: 2px rgb(201, 34, 16) solid;
}
#wrong{width:10%;
height: fit-content;
margin-left: 30%;
padding-top: 0%;
font-size: larger;
   border: 2px solid rgb(00, 80, 80);  
        }
                </style>
    </head>
    <body>
        
            <?php require "header.php"?>
            <form   id="login" method="POST">
                <table>
                <tr>
                    <td>Employee Id:</td> 
                    <td><input type="text" name="id" placeholder="not required"/></td></tr>
                <tr>
                    <td>Employee Name:</td> 
                    <td><input type="text" name="name"required/></td></tr>
                <tr>
                    <td>Position:</td> 
                    <td><select name="pos">
                        <option value="Admin">Admin</option>
                        <option value="SK">Store Keeper </option>
                    </select>
                        
                    <!--<input type="text" name="name"required/>--></td></tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="pword" required/></td></tr>
                </table>
                <button>Login</button><br>

            </form>
            <?php if($action==1): ?>
                <p id="wrong" style="display:block;padding-left: 10%; width:30%;">Wrong Input!</p>
            <?php endif;?>
    </body>
            
</html>