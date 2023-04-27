<?php
session_start();
require("nav.php");
require "connection.php";
require("takeAndCheck.php");
require("result.php");
require("newAndAdd.php");
require("orderAndLow.php");
require("storeAndTransaction.php");
low(); 
?>

<html>

<head>
    <title>Inventory</title>
    <script>
    function hide(x) {
        var C = 'none';
        var A = 'none';
        var Anum = 'none';
        var T = 'none';
        var S = 'none';
        var Ra = 'none';
        var Rt = 'none';
        var Tr = 'none';
        var E = 'none';
        switch (x) {
            case 1:
                C = 'block';
                break;
            case 2:
                A = 'block';
                break;
            case 3:
                Anum = 'block';
                break;
            case 4:
                T = 'block';
                break;
            case 5:
                S = 'block';
                break;
            case 6:
                Ra = 'block';
                break;
            case 7:
                Rt = 'block';
                break;
            case 8:
                Tr = 'block';
                break;
            case 9:
                E = 'block';
                break;
            default:
                break;
        }
        document.getElementById('Check').style.display = C;
        document.getElementById('Add').style.display = A;
        document.getElementById('Addnum').style.display = Anum;
        document.getElementById('Take').style.display = T;
        document.getElementById('Store').style.display = S;
        document.getElementById('ResultA').style.display = Ra;
        document.getElementById('ResultT').style.display = Rt;
        document.getElementById('Tr').style.display = Tr;
        document.getElementById('newEmp').style.display = E;
        if (document.getElementById('Result') != undefined) {
            document.getElementById('Result').style.display = 'none';
        }
        document.getElementById('storeResult').style.display = 'none';
        document.getElementById('Tresult').style.display = 'none';
      
        
    }
    </script>
   <!--
     <script>
      var check = "</?php echo $_SESSION['Emp']['Name']; ?>";
      console.log(check);
     </script>
   -->

<script type="text/javascript">


function QRCode() { 
  const url = window.location.href; // Get current page's URL
  var qrcode = new QRCode(url, {
    text: "http://jindo.dev.naver.com/collie",
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel
});
}
</script>

    
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="st.css">


</head>

<body>
    <?php require "header.php"; ?>
    <?php if (empty($_SESSION['Emp']['Name'])) {
          $_SESSION['re'] = $_GET['pc'];
          header("Location: login.php");
      }
      ?>
    <div id="google_translate_element"></div>
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
    </script>
    <style>
        #order{
    margin-left: 25%;
    margin-bottom: 5%;
    width: fit-content;
    font-size: larger;
    padding: 40px;
    padding-bottom: 10px;
    border: 2px solid rgb(00, 80, 80);  
    width: 400px;
    height: 70%;
}
    </style>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
<div id="qrcode"></div>

    <table id="main">
        <tr>
            <td></td>
            <td rowspan="6" class="res">
                <form id="Check" method="GET">
                    Product Code <input type="text" name="pc" required><br>
                    <button>Check</button>
                </form>


                <form method="POST" id="Add">
                    <table>
                        <tr>
                            <td>Product code:</td>
                            <td><input type="text" name="Apcode" required /></td>
                        </tr>
                        <tr>
                            <td>Name of item:</td>
                            <td><input type="text" name="newname" required /></td>
                        </tr>
                        <tr>
                            <td>Number of items:</td>
                            <td><input type="text" name="no" required /></td>
                        </tr>
                        <tr>
                            <td>Store:</td>
                            <td><input type="text" name="store" required /></td>
                        </tr>
                        <tr>
                            <td>Placed at:</td>
                            <td><input type="text" name="loc" required /></td>
                        </tr>
                    </table>
                    <button>ADD</button>
                </form>


                <form method="POST" id="Addnum">
                    <table>
                        <tr>
                            <td>Product code: </td>
                            <td><input type="text" name="Anpcode" required /></td>
                        </tr>
                        <tr>
                            <td>Amount: </td>
                            <td><input type="text" name="amt" required /></td>
                        </tr>

                    </table>
                    <button>Add</button>
                </form>

                <form method="POST" id="Take">
                    <table>
                        <tr>
                            <td>Product code:</td>
                            <td><input type="text" name="Tpcode" required /></td>
                        </tr>
                        <tr>
                            <td>Amount:</td>
                            <td><input type="text" name="amt" required /></td>
                        </tr>

                    </table>
                    <button>Take</button>
                </form>

                <form id="Store" method="GET">
                    <table>
                        <tr>
                            <td>Store ID:</td>
                            <td><input type="text" name="st" required></td>
                        </tr>
                    </table>
                    <button>Check</button>
                </form>

                <form method="POST" id="ResultA">
                    <table>
                        <tr>
                            <td> Product Code </td>
                            <td><?php echo $_SESSION['item']['P_code']; ?></td>
                        </tr>
                        <tr>
                            <td> Amount:</td>
                            <td><input type="text" name="Addamt" required /></td>
                        </tr>

                    </table>
                    <button>Add:</button>
                </form>

                <form method="POST" id="ResultT">
                    <table>
                        <tr>
                            <td>Product Code</td>
                            <td><?php echo $_SESSION['item']['P_code']; ?></td>
                        </tr>
                        <tr>
                            <td>Amount:</td>
                            <td><input type="text" name="Tamt" required /></td>
                        </tr>

                    </table>
                    <button>Take</button>
                </form>

                <form method="Get" id="Tr">
                    <table>
                        <tr>
                            <td>Type of Transaction:</td>
                            <td><select name="Tot">
                                    <option value="in"> Input</option>
                                    <option value="out">Output</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Sort by:</td>
                            <td><select name="sort">
                                    <option value="Date">Date</option>
                                    <option value="P_code"> Product code</option>
                                </select></td>
                        </tr>
                    </table>
                    <button> Display </button>
                </form>

                <form method="POST" id="newEmp" style="padding-left: 1%; padding-right: 1%;width:80%; margin-left:15%;">
                    <table>
                        <tr>
                            <td>New Employee name: </td>
                            <td><input type="text" name="Ename" required /></td>
                        </tr>
                        <tr>
                            <td>Position:</td>
                            <td><select name="pos">
                                    <option value="Admin">Admin</option>
                                    <option value="SK">Store Keeper</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Language: </td>
                            <td><select name="lang">
                                    <option value="A">ኣማርኛ</option>
                                    <option value="E">English</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="pword"></td>
                        </tr>
                        <tr>
                            <td colspan="2">After this the new Employee can sinup on his/her device</td>
                        </tr>
                    </table>
                    <button> Add</button>
                </form>

                <!--After this there are tables that a not displayed first but they will be displayed  -->
                <!--After this there are tables that a not displayed first but they will be displayed  -->
                <!--After this there are tables that a not displayed first but they will be displayed  -->
                <!--After this there are tables that a not displayed first but they will be displayed  -->

                


               
                
                <?php require("nav.php");?>
                <?php if(array_key_exists('refresh', $_POST)){
                           ordercheck();}?>
               <form method="post">
                <button name="refresh">Refresh</button></form>
               
                     

            </td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(1);">
                    Check Product</a></td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(2);">
                    Add new Product</a></td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(3);">
                    Add num of Product</a></td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(4);">
                    Take Product</a></td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(5);">
                    Store</a></td>
        </tr>
        <?php if ($_SESSION['Emp']['Position'] == 'Admin'): ?>
        <tr>
            <td id="menu"><a href="#" onclick="hide(8);">
                    Transaction</a></td>
        </tr>
        <tr>
            <td id="menu"><a href="#" onclick="hide(9);">
                    Add new Employee</a></td>
        </tr>
        <?php endif; ?>
    </table>
    
       
    


</body>

</html>