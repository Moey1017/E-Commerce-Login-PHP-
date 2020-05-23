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
        <script src="js/validate_new_supplier.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="loginForm">
            <div id="formTitle">Add New Supplier</div>
            <i class="fa fa-plug"></i>
            <form action="php/add_supplier_transaction.php" onsubmit="return isFormValid()" method="POST">
                <label for="company_name">Company Name</label>
                <input name="company_name" type="text" id="company_name" class="contact_input">
                <div id="companyErrorMessage"></div>
                <label for="phone_number">Phone Number</label>
                <input name="phone_number" type="text" id="phone_number" class="contact_input">
                <div id="phoneErrorMessage"></div>
                <label for="email">Email</label>
                <input name="email" type="text" id="email" class="contact_input">
                <div id="emailErrorMessage"></div>
                <label for="location">Location</label>
                <input name="location" type="text" id="location" class="contact_input">
                <div id="locationErrorMessage"></div>
                
                <input type="submit" value="Add"/>
            </form>
            <div id="forgotPassword"><a href="admin_area.php">Cancel</a></div>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>


