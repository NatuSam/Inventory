
<html>
    <head>
        <title>Inventory</title>
        <link rel="stylesheet" href="all.css" on>
    </head>
    <body>
        

            
            <h1>Inventory</h1>
        
        <div class="link">
            
    <?php if(!empty($_SESSION['Emp'])):?>
        <a href="index.php">Home</a>
        <a href="login.php">Logout</a>       
    <?php else:?>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>;
    <?php endif;?>
            </div>

            
    </body>
</html>