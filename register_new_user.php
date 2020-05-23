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
        <script src="js/validate_new_user.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="loginForm">
            <i class="fa fa-plug"></i>
            <form action="php/register_new_user_transaction.php" onsubmit="return isFormValid()"  method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name = "name" autofocus placeholder="Name">
                <div id="nameErrorMessage"></div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" autofocus/>
                <div id="emailErrorMessage"></div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"  autofocus/>
                <div id="passwordErrorMessage"></div>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name = "confirmPassword" placeholder="Confirm Password">
                <div id="confirmPasswordErrorMessage"></div>
                <input type="submit" value="Register"/>   
            </form>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>


