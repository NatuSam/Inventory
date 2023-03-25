<?php

require "connection.php";
$action=0;


if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['qr']) ){
$qr=$_GET['qr'];
$query = "select * from item where I_id = '$qr' limit 1";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
$_SESSION['item']=mysqli_fetch_assoc($result);
$action=1;
}
else{
    $action=2;
}
}
else if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['newname'])){
    $name=$_POST['newname'];
    $num=$_POST['no'];
    $store=$_POST['store'];
    $place=$_POST['loc'];

    $query = "select * from item where Name = '$name' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $action=4;
        $_SESSION['exist']=mysqli_fetch_assoc($result);
    }
    else{
    $query = " insert into item( Name, No_items, S_id,Location) VALUES ('$name','$num','$store','$place')";
    $result=mysqli_query($con,$query);

    $query = "select * from item where Name = '$name' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
     $_SESSION['item']=mysqli_fetch_assoc($result);
     $date=date("Y-m-d H:i:s");
     $newid= $_SESSION['item']['I_id'];
    $query = " insert into T_in(I_id, NorU,Amount,date) VALUES ('$newid','N','$num','$date')";
    $result=mysqli_query($con,$query);
    $action=1;
    }
   }
}
else if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['Aid'])||!empty($_POST['Addamt']))){
    $amt="No";
    if(!empty($_POST['Aid'])){
    $Aid=$_POST['Aid'];
    $num=$_POST['amt'];
   
    $query = "select * from item where I_id = '$Aid' limit 1";
    $result1=mysqli_query($con,$query);
      if(mysqli_num_rows($result1)>0){
      $_SESSION['item']=mysqli_fetch_assoc($result1);
      $amt=$_SESSION['item']['No_items']+$num;
      } 
   }
    else if(!empty($_POST['Addamt'])){
    $Aid=$_SESSION['item']['I_id'];
    $num=$_POST['Addamt'];
    $amt=$_SESSION['item']['No_items']+$num;
    }

    if(is_int($amt)&&$num>0){
    $query = " update item set No_items ='$amt' WHERE I_id = '$Aid'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where I_id = '$Aid' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);

    $date=date("Y-m-d H:i:s");
    $query = " insert into T_in(I_id, NorU,Amount,date) VALUES ('$Aid','U','$num','$date')";
    $result=mysqli_query($con,$query);
    $action=1;
    }
    elseif($num<=0 &&is_int($amt)) {
        $action=5;
    }
    else {
       $action=2;
    }
}
else if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['Tid'])||!empty($_POST['Tamt']))){
    $amt= "No";
    if(!empty($_POST['Tid'])){
    $Tid=$_POST['Tid'];
    $num=$_POST['amt'];
   
    $query = "select * from item where I_id = '$Tid' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
      $_SESSION['item']=mysqli_fetch_assoc($result);

    $amt=$_SESSION['item']['No_items']-$num;
    }
    }
    else if(!empty($_POST['Tamt'])&& $_POST['Tamt']>0){
        $Tid=$_SESSION['item']['I_id'];
        $num=$_POST['Tamt'];
        $amt=$_SESSION['item']['No_items']-$num;
    }

    if(is_int($amt)&&$num>0 &&$amt>=0){
    $query = " update item set No_items ='$amt' WHERE I_id = '$Tid'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where I_id = '$Tid' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);

    $date=date("Y-m-d H:i:s");
    $query = " insert into T_out(I_id,Amount,date) VALUES ('$Tid','$num','$date')";
    $result=mysqli_query($con,$query);
    $action=1;
    }
    else if(is_int($amt)&&$amt<0){
        $action=3;
    }
    else if(is_int($amt)&&$num<=0){
        $action=5   ;
    }
    else {
       $action=2;
    }
}
else if($_SERVER['REQUEST_METHOD']=='POST' ){


}



?>

<html>
    <head>
        <title>Inventory</title>
        <script> 
            function hide(x){ 
                var C = 'none';
                var A = 'none';
                var Anum = 'none';
                var T = 'none';
                var S = 'none';
                var Ra = 'none';
                var Rt = 'none';
            switch(x){                
                case 1:              
                    C = 'block';
                    break;
                case 2: 
                    A ='block';
                    break;
                case 3:
                    Anum='block';
                    break;
                case 4:
                    T='block';
                    break;
                case 5:
                    S='block';
                    break;
                case 6:
                    Ra='block';
                    break;
                case 7:
                    Rt='block';
                    break;
                default:
                    break;
                }
                document.getElementById('Check').style.display=C;
                document.getElementById('Add').style.display=A;
                document.getElementById('Addnum').style.display=Anum;
                document.getElementById('Take').style.display=T; 
                document.getElementById('Store').style.display=S;
                document.getElementById('ResultA').style.display=Ra; 
                document.getElementById('ResultT').style.display=Rt; 
                document.getElementById('Result').style.display='none';   
                document.getElementById('storeResult').style.display='none';      
            }
        </script>
        <style>
            #Results{display:none;}
        </style>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="st.css">
    </head>
    <body>
      <?php require "header.php";?>
      
            
        <table id="main">
       <tr>
        <td></td>        
        <td rowspan="6" class="res">
            <form   id="Check" method="GET">
                QR-Code <input type="text" name="qr" required><br>
                <button>Check</button>
            </form>
            

            <form method="POST" id="Add">
                <table>
                    <tr>
                    <td>Name of item: </td>
                    <td><input type="text" name="newname" required/></td></tr>
                <tr>
                    <td>Number of items: </td>
                    <td><input type="text" name="no" required/></td></tr>
                <tr>
                    <td>Store: </td>
                    <td><input type="text" name="store" required/></td></tr>
                <tr>
                    <td>Placed at: </td>
                    <td><input type="text" name="loc" required/></td></tr>
            </table>
                <button>ADD</button>
            </form>


            <form method="POST" id="Addnum">
            <table>
                <tr>
                    <td>ID:</td> 
                    <td><input type="text" name="Aid" placeholder="1000" required/></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="amt" required/></td></tr>

            </table>
                <button>Add</button>
            </form>

            <form method="POST" id="Take">
            <table>
                <tr>
                    <td>ID:</td> 
                    <td><input type="text" name="Tid" placeholder="1000" required/></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="amt" required/></td></tr>

            </table>
                <button>Take</button>
            </form>

            <form   id="Store" method="GET" >
            <table>
                <tr>
                    <td>Store ID:</td> 
                    <td><input type="text" name="st" required></td></tr>
            </table>
                <button>Check</button>
            </form>

            <form method="POST" id="ResultA" >
            <table>
                <tr>
                    <td>ID:</td> 
                    <td><?php echo $_SESSION['item']['I_id']; ?></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="Addamt" required/></td></tr>

            </table>
                <button>Add</button>
            </form>

            <form method="POST" id="ResultT">
            <table>
                <tr>
                    <td>ID:</td> 
                    <td><?php echo $_SESSION['item']['I_id']; ?></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="Tamt" required/></td></tr>

            </table>
                <button>Take</button>
            </form>
            

            <?php if($action==1):?>
            <table id="Result" style="display:block;">
                <tr>
                    <td>ID:</td> 
                    <td><?php echo $_SESSION['item']['I_id'];?></td></tr>
                <tr>
                    <td>Name of item: </td>
                    <td><?php echo $_SESSION['item']['Name'];?></td></tr>
                <tr>
                    <td>Number of items: </td>
                    <td><?php echo $_SESSION['item']['No_items'];?></td></tr>
                <tr>
                    <td>Store: </td>
                    <td><?php echo $_SESSION['item']['S_id'];?></td></tr>
                <tr>
                    <td>placed at: </td>
                    <td><?php echo $_SESSION['item']['Location'];?></td></tr>
                <tr>
                    <td><div class="resOp"><a href="#" onclick="hide(6);" >Add</a></div></td>
                    <td><div class="resOp"><a href="#" onclick="hide(7);" >Take</a></div></td>
                    </table> 
            
        
            

            <?php elseif($action==2):?>
                <p id="Result" style="display:block; padding-left: 10%; width:30%;">Found no item by that id!</p>
            <?php elseif($action==3):?>
                <p id="Result" style="display:block; padding-left: 10%; width:30%;">There is no <?php echo $num;?> items!<br>
                There is only<?php echo $amt+$num;?> items.</p><br>
            <?php elseif($action==4):?>
                <p id="Result" style="display:block; padding-left: 10%; width:30%;">Item Exist! as Item ID <?php echo $_SESSION['exist']['I_id'];?></p>
            <?php elseif($action==5):?>
                <p id="Result" style="display:block;padding-left: 10%; width:30%;">The Amount can't be negative or Zero!</p>
                
            <?php endif;?>

            <div id="storeResult" style="display:block;">
            <div id="stResult" >
               <?php 
                if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['st'])):?>
                
                  <?php  $st=$_GET['st'];
                         $query = "select * from item where S_id = '$st'";
                         $result=mysqli_query($con,$query);
                             if(mysqli_num_rows($result)>0){
                                 $_SESSION['items']=mysqli_fetch_assoc($result);}?>
                                    <?php while(!empty($_SESSION['items'])): ?>
                                          <?php if(!empty($_SESSION['items'])):?>
                                               <table >
                                                       <tr >
                                                           <td>ID:</td> 
                                                           <td><?php echo $_SESSION['items']['I_id'];?></td></tr>
                                                       <tr>
                                                           <td>Name of item: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                   </table>
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?>
                                       <?php if(!empty($_SESSION['items'])):?>
                                               <table  >
                                                       <tr >
                                                           <td>ID:</td> 
                                                           <td><?php echo $_SESSION['items']['I_id'];?></td></tr>
                                                       <tr>
                                                           <td>Name of item: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                   </table>
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?>
                                       <?php if(!empty($_SESSION['items'])):?>
                                               <table  >
                                                       <tr >
                                                           <td>ID:</td> 
                                                           <td><?php echo $_SESSION['items']['I_id'];?></td></tr>
                                                       <tr>
                                                           <td>Name: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                   </table>
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?><br>
                                       <?php endwhile?>
                                       <?php endif ?>
                </div>
                                       </div>
        </td>
        </tr>
            <tr><td id="menu"><a href="#" onclick="hide(1);" >Check Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(2);">Add new Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(3);">Add num of Items</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(4);">Take Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(5);">Store</a></td></tr>
            
            <tr><td id="menu"><a href="#" onclick="hide(5);">Transaction</a></td></tr>
           

            </table>
            
        
    </body>
</html>