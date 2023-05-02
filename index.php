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
    <link href="./st.css" rel="stylesheet">
    <link href="./nav.css" rel="stylesheet">
    <link href="./main.js" rel="script">
    <link href="./nav.js" rel="script">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {

        $('.slidebarbtn').click(function() {

            $('.slidebarbtn').toggleClass('active');

            $('.header01').toggleClass('enjoy');

        })

    })
    </script>
    <style>
       #Tresult{
    display: none;
    width:fit-content;
    font-size: larger;
    height: 70%;
    margin-left: 12%;
    justify-content: space-between;
    border: 2px solid black;
}
#Tresult table{
    width:100%;
    font-size: large;
}
#Tresult table th{
    width: 20%;
    background-color: black;
    color:white;
}
#Tresult table tr{
    border: 2px solid black;
}
#Tresult a{
    text-decoration: none;
}
#Tresult button{
    font-size: x-large;
    width: 100%;
}
#Tresult table td{
    width: 20%;
    text-align: center;
   
}
#ResultA, #ResultT, #newStore,#storeResultdis{ 
    display: none;
    margin-left: 25%;
    width: fit-content;
    font-size: larger;
    padding: 40px;
    border: 2px solid rgb(00, 80, 80);  
    width: 400px;
    margin-bottom: 1%;
}
    </style>

    <title>Document</title>
</head>

<body>
    <header class="header01">
        <!--Shows list of orders  -->
        <?php if(array_key_exists('Refresh', $_POST)){@ordercheck();}
        ?>
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

            <a href="#" onclick="hide(1);">
                <h3 class="menuitem">Check Product</h3>
            </a>
            <a href="#" onclick="hide(2);">
                <h3 class="menuitem">Add New</h3>
            </a>
            <a href="#" onclick="hide(3);">
                <h3 class="menuitem">Add More Product</h3>
            </a>
            <a href="#" onclick="hide(4);">
                <h3 class="menuitem">Take</h3>
            </a>
            <a href="#" onclick="hide(5);">
                <h3 class="menuitem">Store</h3>
            </a>
            <?php if($_SESSION['Emp']['Position']=='Admin'):?>
            <a href="#" onclick="hide(8);">
                <h3 class="menuitem">Transaction</h3>
            </a>
            <a href="#" onclick="hide(9);">
                <h3 class="menuitem">Employee</h3>
            </a>
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
        <form id="Check" method="GET">
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Product Code</h2>
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
                    <td><input class="input__field" type="text" name="Apcode" required /></td>
                </tr>
                <tr>
                    <td>Name of item:</td>
                    <td><input class="input__field" type="text" name="newname" required /></td>
                </tr>
                <tr>
                    <td>Number of items:</td>
                    <td><input class="input__field" type="text" name="no" required /></td>
                </tr>
                <tr>
                    <td>Store:</td>
                    <td><input class="input__field" type="text" name="store" required /></td>
                </tr>
                <tr>
                    <td>Placed at:</td>
                    <td><input class="input__field" type="text" name="loc" required /></td>
                </tr>
            </table>
            <div class="button-group">
                <button>ADD</button>
            </div>
        </form>


        <form method="POST" id="Addnum">
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Product Code</h2>
                <input class="input__field" type="text" name="Anpcode" required />
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Amount</h2>
                <input class="input__field" type="text" name="amt" required />
            <div class="button-group">
                <button>Add</button>
            </div>
        </form>

        <form method="POST" id="Take">
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Product Code</h2>
                    <input class="input__field" type="text" name="Tpcode" required /><br>
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Amount</h2>
                    <input class="input__field" type="text" name="amt" required />
            <div class="button-group">
                <button>Take</button>
            </div>
        </form>

        <form id="Store" method="GET">
                 <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Store ID</h2>
                    <input class="input__field" type="text" name="st" required>
            
            <div class="button-group">
                <button onclick="document.getElementById('Store').style.display='none';
                             document.getElementById('storeResult').style.display='block'; 
                             document.getElementById('storeResultdis').style.display='block';">Check</button>
                <button  type="button" style="margin-left:25%;" onclick="hide(11);">New Store</button>
            </div>
        </form>

        <form id="newStore" method="POST">
            <table>
                <tr>
                    <td>Store ID:</td>
                    <td><input class="input__field" type="text" name="NstId" required></td>
                </tr>
                <tr>
                    <td>Store Name:</td>
                    <td><input class="input__field" type="text" name="NstName" required></td>
                </tr>
                <tr>
                    <td>Store Description:</td>
                    <td><input class="input__field" type="text" name="NstDis" required></td>
                </tr>
            </table>
            <div class="button-group">
                <button>ADD</button> 
            </div>
        </form>

        <form method="POST" id="ResultA">
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Product Code:
                     <?php echo $_SESSION['item']['P_code']; ?> </h2>
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Add Amount</h2>
                    <input class="input__field" type="text" name="Addamt" required/>
            <div class="button-group">

                <button>Add</button>
            </div>
        </form>

        <form method="POST" id="ResultT">
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Product Code:
                     <?php echo $_SESSION['item']['P_code']; ?> </h2>
        <h2><svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-coffee" href="#icon-coffee" />
                </svg>Take Amount</h2>
                    <td><input class="input__field" type="text" name="Tamt" required /></td>
                </tr>

            </table>
            <div class="button-group">

                <button>Take</button>
            </div>
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
            <div class="button-group">
                <button onclick=" document.getElementById('Tresult').style.display='block';
                             document.getElementById('Tr').style.display='none';"> Display </button>
            </div>
        </form>

        
        <form method="POST"  id="newEmp" style="padding-left: 1%; padding-right: 1%;width:40%; margin-left:25%;">
            <table>
                <tr>
                    <td>New Employee name: </td>
                    <td><input class="input__field" type="text" name="Ename" required /></td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td><select name="pos">
                            <option value="Admin">Admin</option>
                            <option value="SK">Store Keeper</option>
                            <option value="SK">Casher</option>
                        </select></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input class="input__field" type="password" name="pword"></td>
                </tr>
                <tr>
                    <td colspan="2">After this the new Employee can signup on his/her device.</td>
                </tr>
            </table>
            <div class="button-group">
                <button  type="button"  onclick="hide(10);">Forgotten Password</button>
                <button style="margin-left:30%;"> Add</button>
            </div>
        </form>

        <form method="POST" id="Fp" style="padding-left: 1%; padding-right: 1%;width:80%; margin-left:15%;">
            <table>
                <tr>
                    <td>Employee name: </td>
                    <td><input class="input__field" type="text" name="FpEname" required /></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input class="input__field" type="password" name="FpEpword"></td>
                </tr>
                <tr>
                    <td>Admin name: </td>
                    <td><input class="input__field" type="text" name="Aname" required /></td>
                </tr>
                <tr>
                    <td>Admin Password: </td>
                    <td><input class="input__field" type="password" name="Apword"></td>
                </tr>
            </table>
            <div class="button-group">
                <button>Reset Password</button>
                
            </div>
        </form>
        <?php require("nav.php");  low(); ?>
    </div>



</body>

</html>
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
    var Fp = 'none';
    var Ns = 'none';
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
        case 10:
            Fp = 'block';
            break;
        case 11:
            Ns = 'block';
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
    document.getElementById('Fp').style.display = Fp;
    document.getElementById('newStore').style.display = Ns;
    if (document.getElementById('Result') != undefined) {
        document.getElementById('Result').style.display = 'none';
    }
    if (document.getElementById('storeResult') != undefined) {
        document.getElementById('storeResult').style.display = 'none';
    }
    if (document.getElementById('storeResultdis') != undefined) {
        document.getElementById('storeResultdis').style.display = 'none';
    }
    if (document.getElementById('Tresult') != undefined) {
        document.getElementById('Tresult').style.display = 'none';
    }

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