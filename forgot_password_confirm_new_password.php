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
        <script src="js/validate_new_password.js" type="text/javascript"></script>
        <script>
            function getURL()
            {
                let idUrl = window.location; // http://google.com?id=test
                let query_string = idUrl.search;
                let search_params = new URLSearchParams(query_string);
                let result = search_params.get('token');
                document.getElementById('token').value = result;
            }
        </script>
    </head>
    <body onload='getURL()'>
        <div id="loginForm">
            <div id="formTitle">New Password</div>
            <i class="fa fa-plug"></i>
            <form action="php/forgot_password_confirm_new_password_transaction.php" onsubmit="return isFormValid()" method="POST">
                <input type='hidden' id='token' name='token' />
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" />
                <div id="emailErrorMessage"></div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" />
                <div id="passwordErrorMessage"></div>
                <label for="confirmPassword">Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" />
                <div id="confirmPasswordErrorMessage"></div>
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