
<html>
    <head>
        <title>Inventory</title>
        <link rel="stylesheet" href="all.css" on>
    </head>
    <body>
        

            
            <h1>Inventory</h1>
        
        <div class="link">
            <a href="index.php">Home</a>
            <?php if(empty($_SESSION['Emp'])){
                echo "<a href=\"login.php\">Login</a>";}
             else
                echo"<a href=\"login.php\">Logout</a>";
            ?>
            </div>
    </body>
</html>