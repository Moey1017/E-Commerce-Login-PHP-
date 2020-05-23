<?php
session_start();
/* Read posted data */
require_once "error_messages.php";  // contains a list of error messages that can be assigned to $_SESSION["error_message"]

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password.php"); // deal with invalid input
    exit();
}


$confirmEmail = ltrim(rtrim(filter_input(INPUT_POST, "confirmEmail", FILTER_SANITIZE_EMAIL)));
if ((empty($confirmEmail)) || (!filter_var($confirmEmail, FILTER_VALIDATE_EMAIL))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password.php"); // deal with invalid input
    exit();
}

if ($email != $confirmEmail) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAILS_DO_NOT_MATCH;
    header("location: ../forgot_password.php"); // deal with invalid input
    exit();
}

require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT email, name, password, access_level FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

$name;
$password;
$accessLevel;
if ($statement->rowCount() == 0) {
    /**
     * Needs to be included in forgot password page to alert of error.
     */
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password.php"); // deal with invalid input
    exit();
} else {
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row) {
        $name = $row->name;
        $password = $row->password;
        $accessLevel = $row->access_level;
    }
}

$query1 = "DELETE FROM pending_users WHERE email = :email";
$statement1 = $dbConnection->prepare($query1);
$statement1->bindParam(":email", $email, PDO::PARAM_STR);
$statement1->execute();

$expiry_time_stamp = 1200 + $_SERVER["REQUEST_TIME"]; // 1200 = 20 minutes from now
$token = sha1(uniqid($email, true));

$query2 = "INSERT INTO pending_users (token, email, name, password, accessLevel, expiry_time_stamp) VALUES (:token, :email, :name, :password, :accessLevel, :expiry_time_stamp)";
$statement2 = $dbConnection->prepare($query2);
$statement2->bindParam(":token", $token, PDO::PARAM_STR);
$statement2->bindParam(":name", $name, PDO::PARAM_STR);
$statement2->bindParam(":email", $email, PDO::PARAM_STR);
$statement2->bindParam(":password", $password, PDO::PARAM_STR);
$statement2->bindParam(":accessLevel", $accessLevel, PDO::PARAM_INT);
$statement2->bindParam(":expiry_time_stamp", $expiry_time_stamp, PDO::PARAM_INT);
$statement2->execute();

$query3 = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
$statement3 = $dbConnection->prepare($query3);
$statement3->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement3->execute();

$myemail = $email;
$emess = '<html>
            <body style="background-color: grey; color: white; border-radius: 10px; box-shadow: 3px 3px 2px #aaaaaa;">
            <div style="width: 100%; text-align: center; margin-bottom: 20px;"><h1 style="margin-bottom: 0px;">Reset Password</h1><br>Hi ' . $name . '. Please click link below to reset password: </div>
            <table cellspacing="0" style="border:2px; width: 100%; text-align: center;">
            <tr>
            <td>Reset Password Link: <a href="' . $siteName . '/Login_CA2/forgot_password_confirm_new_password.php?token=' . $token . '">Reset Password</a></td>
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
    header("location: ../confirm_forgot_password.php");
}
else
{
    header("location: ../forgot_password.php");
}
?>