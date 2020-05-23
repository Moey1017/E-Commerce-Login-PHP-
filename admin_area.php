<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
}

if (isset($_SESSION["user_name"])) {
    $user_name = "Hello " . $_SESSION["user_name"];
} else {
    $user_name = "";
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
    </head>
    <body>
        <div class="topnav" id="myTopnav">
            <a href="admin_area.php" class="active">Home</a>
            <a href="suppliers.php">Suppliers</a>
            <a href="order_records.php">Order Records</a>
            <?php
            if (isset($_SESSION["user_id"])) {
                echo "<a href='php/logout_transaction.php'>Logout</a>";
            }
            ?>
            <a><?php echo $user_name ?></a>
            <a class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <h1 id="adminTitle">Glich<i class="fa fa-plug"></i></h1>
        <div class="home_container">
            <div id="twoTile">
                <div class="options">
                    <div class="option_header"><h1>View Products</h1></div>
                    <div><a href="products.php?page_number=1"><img class="productsTile" style="width: 100%;" src="images/products_tile.jpg" alt=""></a></div>
                </div>

                <div class="options">
                    <div class="option_header"><h1>Add New Product</h1></div>
                    <div><a href="add_product.php"><img class="productsTile" src="images/add_products_tile.jpg" alt=""></a></div>
                </div>
            </div>
            <div id="twoTile">
                <div class="options">
                    <div class="option_header"><h1>Add Order</h1></div>
                    <div><a href="add_order.php"><img class="productsTile" src="images/order_products_tile.jpg" alt=""></a></div>
                </div>

                <div class="options">
                    <div class="option_header"><h1>Add Supplier</h1></div>
                    <div><a href="add_supplier.php"><img class="productsTile" src="images/suppliers_tile.jpg" alt=""></a></div>
                </div>
            </div>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>
