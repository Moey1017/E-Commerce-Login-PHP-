<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glich</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/ddba68f5c9.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
        <link rel="shortcut icon" href="images/plug_favIcon.png">
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/load_all_products.js" type="text/javascript"></script>
    </head>
    <body onload='ajaxPagination()'>
        <div class="topnav" id="myTopnav">
            <a href="admin_area.php" class="active">Home</a>
            <a href="suppliers.php">Suppliers</a>
            <a href="order_records.php">Orders</a>
            <a class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        <div class="products_container_header"><h1>Products List</h1></div>
        <div id="products_container">
        </div>
       
        <div class='product_pagination'></div>

        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>
