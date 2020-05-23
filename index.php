<?php
session_start();
if (isset($_SESSION['user_id']) || isset($_COOKIE["rememberme"])) {
    header('location: php/remember_me.php');
}
require './vendor/autoload.php';
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
    </script>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=765147987351220&autoLogAppEvents=1"></script>
    <div id="loginForm">
        <div id="formTitle">Login</div>
        <i class="fa fa-plug"></i>
        <form action="php/login_transaction.php" method="POST">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Email" />
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" />
            <input type="hidden" name="token" id="token" /> 
            <input type="hidden" name="action" id="action" /> 
            <input type="submit" value="Login" name="submit"/>
        </form>
        
        <button id="register" onclick="window.location = 'register_new_user.php';">Register</button>
        <div id="facebookLogin">
            <?php
            echo '<a href="php/facebook_login_transaction.php"><img id="facebookButton" src="images/login_facebook.png"></a>';
            ?>
        </div>
        <script src="https://www.google.com/recaptcha/api.js?render=6LecMfAUAAAAAPViYRVLEh7dsMqiK3ImlyyhFhvD"></script>
        <script  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setInterval(function () {
                    grecaptcha.ready(function () {
                        grecaptcha.execute('6LecMfAUAAAAAPViYRVLEh7dsMqiK3ImlyyhFhvD', {action: 'application_form'}).then(function (token) {
                            $('#token').val(token);
                            $('#action').val('application_form');
                        });
                    });
                }, 3000);
            });
        </script>
        <div id="forgotPassword"><a href="forgot_password.php">Forgot Password</a></div>
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div id="badPassword">' . $_SESSION['error_message'] . '</div>';
        }
        ?>
    </div>
    <footer>
        <div>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett & Jing Sheng Moey
        </div>
    </footer>
</body>
</html>