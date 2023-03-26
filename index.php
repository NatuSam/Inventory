<?php

require "connection.php";
$action=0;


if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['pc']) ){
$pc=$_GET['pc'];
$query = "select * from item where P_code = '$pc' limit 1";
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
    $pcode=$_POST['P_code'];
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
    $query = " insert into item( P_code,Name, No_items, S_id,Location) VALUES ('$pcode','$name','$num','$store','$place')";
    $result=mysqli_query($con,$query);

    $query = "select * from item where Name = '$name' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
     $_SESSION['item']=mysqli_fetch_assoc($result);
     $date=date("Y-m-d H:i:s");
     $newid= $_SESSION['item']['P_code'];
    $query = " insert into T_in(P_code, NorU,Amount,date) VALUES ('$newid','N','$num','$date')";
    $result=mysqli_query($con,$query);
    $action=1;
    }
   }
}
else if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['Anpcode'])||!empty($_POST['Addamt']))){
    $amt="No";
    if(!empty($_POST['Anpcode'])){
    $Anpcode=$_POST['Anpcode'];
    $num=$_POST['amt'];
   
    $query = "select * from item where P_code = '$Anpcode' limit 1";
    $result1=mysqli_query($con,$query);
      if(mysqli_num_rows($result1)>0){
      $_SESSION['item']=mysqli_fetch_assoc($result1);
      $amt=$_SESSION['item']['No_items']+$num;
      } 
   }
    else if(!empty($_POST['Addamt'])){
    $Anpcode=$_SESSION['item']['P_code'];
    $num=$_POST['Addamt'];
    $amt=$_SESSION['item']['No_items']+$num;
    }

    if(is_int($amt)&&$num>0){
    $query = " update item set No_items ='$amt' WHERE P_code = '$Anpcode'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where P_code = '$Anpcode' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);

    $date=date("Y-m-d H:i:s");
    $query = " insert into T_in(P_code, NorU,Amount,date) VALUES ('$Anpcode','U','$num','$date')";
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
else if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['Tpcode'])||!empty($_POST['Tamt']))){
    $amt= "No";
    if(!empty($_POST['Tpcode'])){
    $Tpcode=$_POST['Tpcode'];
    $num=$_POST['amt'];
   
    $query = "select * from item where P_code = '$Tpcode' limit 1";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
      $_SESSION['item']=mysqli_fetch_assoc($result);

    $amt=$_SESSION['item']['No_items']-$num;
    }
    }
    else if(!empty($_POST['Tamt'])&& $_POST['Tamt']>0){
        $Tpcode=$_SESSION['item']['P_code'];
        $num=$_POST['Tamt'];
        $amt=$_SESSION['item']['No_items']-$num;
    }

    if(is_int($amt)&&$num>0 &&$amt>=0){
    $query = " update item set No_items ='$amt' WHERE P_code = '$Tpcode'";
    $result=mysqli_query($con,$query);
    $query = "select * from item where P_code = '$Tpcode' limit 1";
    $result=mysqli_query($con,$query);
    $_SESSION['item']=mysqli_fetch_assoc($result);

    $date=date("Y-m-d H:i:s");
    $query = " insert into T_out(P_code,Amount,date) VALUES ('$Tpcode','$num','$date')";
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
                var Tr = 'none';
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
                case 8:
                    Tr='block';
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
                document.getElementById('Tr').style.display=Tr; 
                 
                document.getElementById('storeResult').style.display='none';   
                document.getElementById('Tresult').style.display='none';   
                document.getElementById('Result').style.display='none';   
            }
        </script>
        <style>
            #Results{display:none;}
            #Tr{
    display: none;
    margin-left: 25%;
    width: fit-content;
    font-size: larger;
    padding: 40px;
    border: 2px solid rgb(00, 80, 80);  
    width: 400px;
}
#Tresult{
    display: none;
    width:fit-content;
    font-size: larger;
    height: 70%;
    margin-left: 1%;
    justify-content: space-between;
}
#Tresult table{
    width:90%;
}
#Tresult table td{
    width: 20%;
}
    
        </style>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="st.css">
    </head>
    <body>
      <?php require "header.php";?>
      <?php if(empty($_SESSION['Emp'])){
              header("Location: login.php");
              die;
      } ?>
      
            
        <table id="main">
       <tr>
        <td></td>        
        <td rowspan="6" class="res">
            <form   id="Check" method="GET">
                Product Code <input type="text" name="pc" required><br>
                <button>Check</button>
            </form>
            

            <form method="POST" id="Add">
                <table>
                    <tr>
                    <td>Product code: </td>
                    <td><input type="text" name="Apcode" required/></td></tr>
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
                    <td>Product code:</td> 
                    <td><input type="text" name="Anpcode" placeholder="1000" required/></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="amt" required/></td></tr>

            </table>
                <button>Add</button>
            </form>

            <form method="POST" id="Take">
            <table>
                <tr>
                    <td>Product code:</td> 
                    <td><input type="text" name="Tpcode" placeholder="1000" required/></td></tr>
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
                    <td>Product code:</td> 
                    <td><?php echo $_SESSION['item']['P_code']; ?></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="Addamt" required/></td></tr>

            </table>
                <button>Add</button>
            </form>

            <form method="POST" id="ResultT">
            <table>
                <tr>
                    <td>Product code:</td> 
                    <td><?php echo $_SESSION['item']['P_code']; ?></td></tr>
                <tr>
                    <td>Amount: </td>
                    <td><input type="text" name="Tamt" required/></td></tr>

            </table>
                <button>Take</button>
            </form>

            <form method="Get" id="Tr">
            <table>
                <tr>
                    <td>Type of Transaction: </td>
                    <td><select name="Top" >
                        <option value="in">Input</option>
                        <option value="out">Output</option>
                    </select></td></tr>

            </table>
                <button>Display</button>
            </form>
            
        
            
            <?php if($action==1):?>
            <table id="Result" style="display:block;">
                <tr>
                    <td>Product code:</td> 
                    <td><?php echo $_SESSION['item']['P_code'];?></td></tr>
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
                <p id="Result" style="display:block; padding-left: 10%; width:30%;">Item Exist! as Item ID <?php echo $_SESSION['exist']['P_code'];?></p>
            <?php elseif($action==5):?>
                <p id="Result" style="display:block;padding-left: 10%; width:30%;">The Amount can't be negative or Zero!</p>
                
            <?php endif;?>

           <div id="storeResult" style="display:flex;">
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
                                                           <td>Product code:</td> 
                                                           <td><?php echo $_SESSION['items']['P_code'];?></td></tr>
                                                       <tr>
                                                           <td>Name of item: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                        <tr><td><a href="?pc=<?php echo$_SESSION['items']['P_code'];?>">Details</a></td></tr>
                                                   </table>
                                                      
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?>
                                       <?php if(!empty($_SESSION['items'])):?>
                                               <table  >
                                                       <tr >
                                                           <td>Product code:</td> 
                                                           <td><?php echo $_SESSION['items']['P_code'];?></td></tr>
                                                       <tr>
                                                           <td>Name of item: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                            <tr><td><a href="?pc=<?php echo$_SESSION['items']['P_code'];?>">Details</a></td></tr>
                                                   </table>
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?>
                                       <?php if(!empty($_SESSION['items'])):?>
                                               <table  >
                                                       <tr >
                                                           <td>Product code:</td> 
                                                           <td><?php echo $_SESSION['items']['P_code'];?></td></tr>
                                                       <tr>
                                                           <td>Name: </td>
                                                           <td><?php echo $_SESSION['items']['Name'];?></td></tr>
                                                       <tr>
                                                           <td>placed at: </td>
                                                           <td><?php echo $_SESSION['items']['Location'];?></td></tr>
                                                            <tr><td><a href="?pc=<?php echo$_SESSION['items']['P_code'];?>">Details</a></td></tr>
                                                   </table>
                                            
                                       <?php endif ?>
                                       <?php $_SESSION['items']=mysqli_fetch_assoc($result); ?><br>
                                       <?php endwhile?>
                                       <?php endif ?>
           </div>
                                    
           
             <div id="Tresult" style="display:block;">
            
               <?php 
                if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['Top'])):?>
               
                  <?php  $tr=$_GET['Top'];
                    if($tr=="in"){
                         $query = "select * from T_in ";
                        }
                    elseif($tr=="out"){
                        $query = "select * from T_out ";
                       }

                         $result=mysqli_query($con,$query);
                             if(mysqli_num_rows($result)>0){
                                 $_SESSION['Tr']=mysqli_fetch_assoc($result);}?>
                                 <table border="2px solid black">
                                                       <tr>
                                                           <td>T id</td>
                                                           <td>Product code:</td>
                                                           <td>Amount:</td>
                                                            <td>Type:</td>
                                                           <td>Date</td>
                                                        </tr>
                                                   </table>  
                                <?php while(!empty($_SESSION['Tr'])): ?>
                                          <?php if(!empty($_SESSION['Tr'])):?>
                                               <table border="2px solid black">
                                                       <tr>
                                                           <td><?php echo $_SESSION['Tr']['T_id'];?></td>
                                                        <td><a href="?pc=<?php echo $_SESSION['Tr']['P_code'];?>"><?php echo $_SESSION['Tr']['P_code'];?> </a> </td>
                                                           <td><?php echo $_SESSION['Tr']['Amount'];?></td>
                                                           <td> 
                                                           <?php 
                                                           if(!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU']=='N'){
                                                           echo "New";}
                                                           else if(!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU']=='U'){
                                                            echo "Update";}
                                                            else if(empty($_SESSION['Tr']['NorU'])){
                                                                echo "Out";}
                                                           ?>
                                                                                 
                                                        </td>
                                                           <td><?php echo $_SESSION['Tr']['date'];?></td>
                                                        </tr>
                                                   </table>     
                                       <?php endif ?>
                                       <?php $_SESSION['Tr']=mysqli_fetch_assoc($result);?>
                                                  
                                        <?php endwhile?>     
                                       <?php endif ?>
             </div>
                                        
                                          
                                       
                                       
                                       


        </td>
        </tr>
            <tr><td id="menu"><a href="#" onclick="hide(1);" >Check Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(2);">Add new Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(3);">Add num of Items</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(4);">Take Item</a></td></tr>
            <tr><td id="menu"><a href="#" onclick="hide(5);">Store</a></td></tr>
            <?php if($_SESSION['Emp']['Position']=='Admin'):?>
            <tr><td id="menu"><a href="#" onclick="hide(8);">Transaction</a></td></tr>
            <?php endif;?>
           

            </table>
            
        
    </body>
</html>