<?php

session_start();

/* Read posted data */
require_once "error_messages.php";  // contains a list of error messages that can be assigned to $_SESSION["error_message"]
//require_once "user_details.php";

$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
if ((empty($name)) || (!filter_var($name, FILTER_SANITIZE_STRING))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../register_new_user.php"); // deal with invalid input
    exit();
}

$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../register_new_user.php"); // deal with invalid input
    exit();
}

$password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
if ((empty($password)) || (!filter_var($password, FILTER_SANITIZE_STRING))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../register_new_user.php"); // deal with invalid input
    exit();
}

$confirmPassword = trim(filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING));
if ((empty($confirmPassword)) || (!filter_var($confirmPassword, FILTER_SANITIZE_STRING))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../register_new_user.php"); // deal with invalid input
    exit();
}

/* Validate input data */
if ($password != $confirmPassword) {
    $_SESSION["error_message"] = "Password doesnt match";
    header("location: ../register_new_user.php");
    exit();
}

/* Connect to the database */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
//Check that the user is not already a user.
$query = "SELECT email FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

if ($statement->rowCount() > 0) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAIL_ALREADY_REGISTERED;
    header("location: ../index.php");
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

//Check that the user is not already pending.
$query2 = "DELETE FROM pending_users WHERE email = :email";
$statement2 = $dbConnection->prepare($query2);
$statement2->bindParam(":email", $email, PDO::PARAM_STR);
$statement2->execute();

//Create token.
$expiry_time_stamp = 1200 + $_SERVER["REQUEST_TIME"];
$token = sha1(uniqid($email, true));
$accessLevel = 1;

//Insert new user to pending user table.
$query3 = "INSERT INTO pending_users (token, email, name, password, accessLevel, expiry_time_stamp) VALUES (:token, :email, :name, :password, :accessLevel, :expiry_time_stamp)";
$statement3 = $dbConnection->prepare($query3);
$statement3->bindParam(":token", $token, PDO::PARAM_STR);
$statement3->bindParam(":email", $email, PDO::PARAM_STR);
$statement3->bindParam(":name", $name, PDO::PARAM_STR);
$statement3->bindParam(":password", $hashed, PDO::PARAM_STR);
$statement3->bindParam(":accessLevel", $accessLevel, PDO::PARAM_INT);
$statement3->bindParam(":expiry_time_stamp", $expiry_time_stamp, PDO::PARAM_INT);
$statement3->execute();

//Remove old pending_users that have timestamp greater than server request time.
$query4 = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
$statement4 = $dbConnection->prepare($query4);
$statement4->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"]);
$statement4->execute();

$myemail = $email;
        $emess = '<html>
            <body style="background-color: grey; color: white; border-radius: 10px; box-shadow: 3px 3px 2px #aaaaaa;">
            <div style="width: 100%; text-align: center; margin-bottom: 20px;"><h1 style="margin-bottom: 0px;">Activate Account</h1><br>Hi ' . $name . '. Please click link below to activate account: </div>
            <table cellspacing="0" style="border:2px; width: 100%; text-align: center;">
            <tr>
            <td>Activation Link: <a href="'. $siteName . '/Login_CA2/php/confirm_registration_transaction.php?token='.$token.'">Activate</a></td>
            </tr>
            </table>
            <div style="width: 100%; text-align: center; margin-top: 20px; padding-bottom: 20px;">Should you have any questions please get in touch.</div>
            </body>
             </html>';
        $subj = "Activate Account";
        $ehead = "MIME-Version: 1.0" . "\r\n";
        $ehead .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $emailSend = mail($myemail, $subj, $emess, $ehead);

if($emailSend != false)
{
    header("location: ../confirm_registration.php");
}
else
{
    header("location: ../index.php");
}
?>


