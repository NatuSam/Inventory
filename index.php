<?php
session_start();
$_SESSION['Emp']['Position']="Admin";
require "connection.php";
require("orderAndLow.php");
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./main.css" rel="stylesheet">
    <link href="./nav.css" rel="stylesheet">
    <link href="./main.js" rel="script">
    <link href="./nav.js" rel="script">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

$('.slidebarbtn').click(function(){

$('.slidebarbtn').toggleClass('active');

$('.header01').toggleClass('enjoy');

})

})
</script>

    <title>Document</title>
</head>>
<body>
    <header class="header01">
   <!--Shows list of orders  -->
<?php if(array_key_exists('Refresh', $_POST)){@ordercheck();}?> 
<form method="POST"><button name="Refresh">Refresh</button></form>
 <button class="slidebarbtn">  
 <div class="hamburger"></div>
 </button>
 </header>
    <nav>
        <div class="navtop">
            <div class="navitem">
                <img src="" alt="">
        </div>
        <div class="navitem">
        </div>
            <div class="navitem">
                <span class="logout">logout</span>
            </div>
            
    </div>
        <div class="navbottom">
            
        <a href="#" onclick="hide(1);" > <h3 class="menuitem">Check Product</h3></a>
        <a href="#" onclick="hide(2);" >  <h3 class="menuitem">Add New</h3></a>
        <a href="#" onclick="hide(3);" > <h3 class="menuitem">Add More Product</h3></a>
        <a href="#" onclick="hide(4);" > <h3 class="menuitem">Take</h3></a>
        <a href="#" onclick="hide(5);" > <h3 class="menuitem">Store</h3></a>
        <?php if($_SESSION['Emp']['Position']=='Admin'):?>
        <a href="#" onclick="hide(8);" > <h3 class="menuitem">Transaction</h3></a>
        <a href="#" onclick="hide(9);" > <h3 class="menuitem">Employee</h3></a>
        <?php endif;?>
        <!-- <div class="icon" onclick="toggleNotifi()">
			<img id="ima" src="./bell.png" alt=""> <span></span>
		</div>
		<div class="notifi-box" id="box">
			<h2><span></span></h2></div> -->
            

        </div>
        </nav>
        <!-- adfsddhfgdsjhdasfdfd-->
        <div class="card">
            <form id="Check" method="GET" >
            <h2><svg class="icon" aria-hidden="true">
      <use xlink:href="#icon-coffee" href="#icon-coffee" /></svg>Product Code</h2>
            <input class="input__field" type="text" name="pc" required><br>
                <div class="button-group">
                   <button onclick=" document.getElementById('Result').style.display='block';
                             document.getElementById('Check').style.display='none';">Check</button>
                </div>
               </form>
               
   
               <form method="POST" id="Add">
                   <table>
                       <tr>
                       <td>Product code:</td>
                       <td><input class="input__field" type="text" name="Apcode" required/></td></tr>
                       <tr>
                       <td>Name of item:</td>
                       <td><input class="input__field" type="text" name="newname" required/></td></tr>
                   <tr>
                       <td>Number of items:</td>
                       <td><input class="input__field" type="text" name="no" required/></td></tr>
                   <tr>
                       <td>Store:</td>
                       <td><input class="input__field" type="text" name="store" required/></td></tr>
                   <tr>
                       <td>Placed at:</td>
                       <td><input class="input__field" type="text" name="loc" required/></td></tr>
               </table>
                    <div class="button-group">
                   <button>ADD</button>
                   </div>
               </form>
    
   
               <form method="POST" id="Addnum">
               <table>
                   <tr>
                       <td>Product code: </td> 
                       <td><input class="input__field" type="text" name="Anpcode" required/></td></tr>
                   <tr>
                       <td>Amount: </td>
                       <td><input class="input__field" type="text" name="amt" required/></td></tr>
   
               </table>
                     <div class="button-group">   
                   <button>Add</button>
                   </div>
               </form>
   
               <form method="POST" id="Take">
               <table>
                   <tr>
                       <td>Product code:</td> 
                       <td><input class="input__field" type="text" name="Tpcode"  required/></td></tr>
                   <tr>
                   <td>Amount:</td>   
                       <td><input class="input__field" type="text" name="amt" required/></td></tr>
   
               </table>
               <div class="button-group">
                   <button>Take</button>
        </div>
               </form>
   
               <form   id="Store" method="GET" >
               <table>
                   <tr>
                       <td>Store ID:</td> 
                       <td><input class="input__field" type="text" name="st" required></td></tr>
               </table>
                    <div class="button-group">
                       <button>Check</button>
                   </div>
               </form>
   
               <form method="POST" id="ResultA" >
               <table>
                   <tr>
                       <td> Product Code </td> 
                       <td><?php echo $_SESSION['item']['P_code']; ?></td></tr>
                   <tr>
                       <td> Amount:</td>
                       <td><input class="input__field" type="text" name="Addamt" required/></td></tr>
               </table>
               <div class="button-group">

                   <button>Add</button>
                </div>
               </form>
   
               <form method="POST" id="ResultT">
               <table>
                   <tr>
                       <td>Product Code</td> 
                       <td><?php echo $_SESSION['item']['P_code'];
                        ?></td></tr>
                   <tr>
                       <td>Amount:</td>
                       <td><input class="input__field" type="text" name="Tamt" required/></td></tr>
   
               </table>
               <div class="button-group">

                           <button>Take</button>
                </div>
                   </form>
   
               <form method="Get" id="Tr">
               <table>
                   <tr>
                       <td>Type of Transaction:</td>
                       <td><select name="Tot" >
                           <option value="in"> Input</option>
                           <option value="out">Output</option>
                       </select></td></tr>
                    <tr>
                     <td>Sort by:</td>
                       <td><select name="sort" >
                              <option value="Date">Date</option>
                              <option value="P_code"> Product code</option>
                            </select></td></tr>
               </table>
               <div class="button-group">
                   <button> Display </button>
                   </div>
               </form>
   
             <form method="POST" id="newEmp" style="padding-left: 1%; padding-right: 1%;width:80%; margin-left:15%;">
                   <table >
                   <tr>
                       <td>New Employee name: </td>
                       <td><input class="input__field" type="text" name="Ename" required/></td></tr>
                   <tr>
                         <td>Position:</td>
                       <td><select name="pos">
                           <option value="Admin">Admin</option>
                           <option value="SK">Store Keeper</option>
                       </select></td></tr>
                   
                   <tr>
                       <td>Password: </td>
                       <td><input class="input__field" type="password" name="pword"></td></tr>
                   <tr><td colspan="2">After this the new Employee can signup on his/her device</td></tr>
               </table>
               <div class="button-group">
                   <button> Add</button>
                   </div>
               </form>
               <?php require("nav.php");  low(); ?>
                </div>
                
   
    
</body>
</html>
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
    var E = 'none';
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
    case 9:
        E='block';
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
    document.getElementById('newEmp').style.display=E;  
    if(document.getElementById('Result')!=undefined){
    document.getElementById('Result').style.display='none';}
    if(document.getElementById('storeResult')!=undefined){
    document.getElementById('storeResult').style.display='none';}  
    if(document.getElementById('Tresult')!=undefined){ 
    document.getElementById('Tresult').style.display='none';}
      
}
function downloadQRCode() {
  // Get the current URL of the webpage.
  var url = window.location.href;
  
  // Generate the QR code image using a QR code generator API.
  var qrCodeImageUrl = "https://quickchart.io/qr?text=" + encodeURIComponent(url);
  // Create an anchor tag with the QR code image URL as its href.
  var link = document.createElement("a");
  link.href = qrCodeImageUrl;
  link.download = "qr-code.png"; // Set the downloaded file name.
  
  // Click the anchor tag to download the image.
  link.click();
}
</script>