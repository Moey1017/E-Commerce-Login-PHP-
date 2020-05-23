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
        <script src="js/validate_password_reset.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="loginForm">
            <div id="formTitle">Forgot Password</div>
            <i class="fa fa-plug"></i>
            <form action="php/forgot_password_transaction.php" onsubmit="return isFormValid()" method="POST">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" />
                <div id="emailErrorMessage"></div>
                <label for="confirmEmail">Confirm Email</label>
                <input type="confirmEmail" id="confirmEmail" name="confirmEmail" placeholder="Confirm Email" />
                <div id="confirmEmailErrorMessage"></div>
                <input type="submit" value="Reset Password"/>
            </form>
            <button id="register" onclick="window.location = 'index.php';">Cancel</button>
        </div>
        <footer>
            <div>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
            </div>
        </footer>
    </body>
</html>


