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
        <script src="js/validate_update_product.js" type="text/javascript"></script>
        <script src="js/update_product.js" type="text/javascript"></script>
    </head>
    <body onload="ajaxGetProductToUpdate()">
        <div id="loginForm">
            <div id="formTitle">Update Product</div>
            <i class="fa fa-plug"></i>
            <form action="php/update_product_transaction.php" onsubmit="return isFormValid()" method="POST">
                <input name="product_id" type="hidden" id="product_id" class="contact_input">
                <label for="name">Product Name</label>
                <input name="name" type="text" id="name" class="contact_input">
                <div id="nameErrorMessage"></div>
                <label for="category">Category</label>
                <input name="category" type="text" id="category" class="contact_input">
                <div id="categoryErrorMessage"></div>
                <label for="brand">Brand</label>
                <input name="brand" type="text" id="brand" class="contact_input" >
                <div id="brandErrorMessage"></div>
                <label for="price">Price</label>
                <input name="price" type="text" id="price" class="contact_input">
                <div id="priceErrorMessage"></div>
                <label for="image">Image</label>
                <input name="image" type="text" id="image" class="contact_input">
                <div id="imageErrorMessage"></div>
                <label for="description">Description</label>
                <input name="description" type="text" id="description" class="contact_input">
                <div id="descriptionErrorMessage"></div>
                <label for="availability">Availability</label>
                <input name="availability" type="text" id="availability" class="contact_input">
                <div id="availabilityErrorMessage"></div>
                <input type="submit" value="Add"/>
            </form>
            <div id="forgotPassword"><a href="products.php?page_number=1">Cancel</a></div>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>