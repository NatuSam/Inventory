<?php
session_start();
require "connection.php";
require "connection.php";
require("check.php");
require("newP.php");
require("addN.php");
require("take.php");
require("result.php");
require("low.php");
require("order.php");


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
                            <td><select name="Top">
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

                


                <?php if(array_key_exists('refresh', $_POST)){
                           ordercheck();}?>
               <form method="post">
                <button name="refresh">Refresh</button></form>
                
                <?php require("nav.php");?>
                <div id="storeResult" style="display:flex;">
                    <?php
               if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['st'])): ?>
                    <?php $st = $_GET['st'];
                      $query = "select * from item where S_id = '$st'";
                      $result = mysqli_query($con, $query);
                      if (mysqli_num_rows($result) > 0) {
                          $_SESSION['items'] = mysqli_fetch_assoc($result);
                      } ?>
                    <?php while (!empty($_SESSION['items'])): ?>
                    <?php if (!empty($_SESSION['items'])): ?>
                    <table>
                        <tr>
                            <td>Product code:</td>
                            <td><?php echo $_SESSION['items']['P_code']; ?></td>
                        </tr>
                        <tr>
                            <td>
                                Name of product:</td>
                            <td><?php echo $_SESSION['items']['Name']; ?></td>
                        </tr>
                        <tr>
                            <td>Store:</td>
                            <td><?php echo $_SESSION['items']['Location']; ?></td>
                        </tr>
                        <tr>
                            <td><a href="?pc=<?php echo $_SESSION['items']['P_code']; ?>">
                                    Details </a></td>
                        </tr>
                    </table>


                    <?php endif ?>
                    <?php $_SESSION['items'] = mysqli_fetch_assoc($result); ?>
                    <?php if (!empty($_SESSION['items'])): ?>
                    <table>
                        <tr>
                            <td> Product code:</td>
                            <td><?php echo $_SESSION['items']['P_code']; ?></td>
                        </tr>
                        <tr>
                            <td>Name of product:</td>
                            <td><?php echo $_SESSION['items']['Name']; ?></td>
                        </tr>
                        <tr>
                            <td>Store:</td>
                            <td><?php echo $_SESSION['items']['Location']; ?></td>
                        </tr>
                        <tr>
                            <td><a href="?pc=<?php echo $_SESSION['items']['P_code']; ?>">
                                    Details</a></td>
                        </tr>
                    </table>

                    <?php endif ?>
                    <?php $_SESSION['items'] = mysqli_fetch_assoc($result); ?>
                    <?php if (!empty($_SESSION['items'])): ?>
                    <table>
                        <tr>
                            <td>Product code: </td>
                            <td><?php echo $_SESSION['items']['P_code']; ?></td>
                        </tr>
                        <tr>
                            <td>Name of product:</td>
                            <td><?php echo $_SESSION['items']['Name']; ?></td>
                        </tr>
                        <tr>
                            <td>Store:</td>
                            <td><?php echo $_SESSION['items']['Location']; ?></td>
                        </tr>
                        <tr>
                            <td><a href="?pc=<?php echo $_SESSION['items']['P_code']; ?>">
                                    Details </a></td>
                        </tr>
                    </table>

                    <?php endif ?>
                    <?php $_SESSION['items'] = mysqli_fetch_assoc($result); ?><br>
                    <?php endwhile ?>
                    <?php endif ?>
                </div>


                <div id="Tresult" style="display:block;">

                    <?php
               if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['Top'])): ?>

                    <?php $tr = $_GET['Top'];
                      $sort = $_GET['sort'];
                      if ($tr == "in") {
                          $query = "select * from T_in GROUP BY $sort";
                      } elseif ($tr == "out") {
                          $query = "select * from T_out GROUP BY $sort";
                      }

                      $result = mysqli_query($con, $query);
                      if (mysqli_num_rows($result) > 0) {
                          $_SESSION['Tr'] = mysqli_fetch_assoc($result);
                      } ?>
                    <table border="2px solid black">
                        <tr>
                            <td>T id</td>
                            <td> Product code</td>
                            <td>Amount</td>
                            <td>Type</td>
                            <td> Date</td>
                        </tr>
                    </table>
                    <?php while (!empty($_SESSION['Tr'])): ?>
                    <?php if (!empty($_SESSION['Tr'])): ?>
                    <table border="2px solid black">
                        <tr>
                            <td><?php echo $_SESSION['Tr']['T_id']; ?></td>
                            <td><a id="menu"
                                    href="?pc=<?php echo $_SESSION['Tr']['P_code']; ?>"><?php echo $_SESSION['Tr']['P_code']; ?>
                                </a> </td>
                            <td><?php echo $_SESSION['Tr']['Amount']; ?></td>
                            <td>
                                <?php
                                 if (!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU'] == 'N') {
                                     echo "New";
                                 } else if (!empty($_SESSION['Tr']['NorU']) && $_SESSION['Tr']['NorU'] == 'U') {
                                     echo "Update";
                                 } else if (empty($_SESSION['Tr']['NorU'])) {
                                     echo "Out";
                                 }
                                 ?>

                            </td>
                            <td><?php echo $_SESSION['Tr']['date']; ?></td>
                        </tr>
                    </table>
                    <?php endif ?>
                    <?php $_SESSION['Tr'] = mysqli_fetch_assoc($result); ?>

                    <?php endwhile ?>
                    <?php endif ?>
                </div>

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