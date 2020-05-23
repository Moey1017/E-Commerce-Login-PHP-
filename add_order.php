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
        <script src="js/insert_supplier_options.js" type="text/javascript"></script>
        <script src="js/validate_new_order.js" type="text/javascript"></script>
    </head>
    <body onload="ajaxGetSupplierOptions()">
        <div id="loginForm">
            <div id="formTitle">Add New Order</div>
            <i class="fa fa-plug"></i>
            <form action="php/add_order_transaction.php" onsubmit="return isOrderFormValid()" method="POST">
                <label for="total">Total</label>
                <input name="total" type="text" id="total" class="contact_input">
                <div id="totalErrorMessage"></div>
                
                <label for="supplier_id">Supplier Id</label>
                <select name="supplier_id" id="supplier_options"></select>
                <input type="submit" value="Add"/>
            </form>
            <div id="forgotPassword"><a href="order_records.php">Cancel</a></div>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>


