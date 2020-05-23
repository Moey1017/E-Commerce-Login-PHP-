<?php
session_start();
?>
<?php
$token = ltrim(rtrim(filter_input(INPUT_POST, "token", FILTER_SANITIZE_STRING)));
if (empty($token))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token); // deal with invalid input
    exit();
}

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token); // deal with invalid input
    exit();
}

$password = ltrim(rtrim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)));
if (empty($password))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token); // deal with invalid input
    exit();
}

$confirmPassword = ltrim(rtrim(filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING)));
if (empty($confirmPassword))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token); // deal with invalid input
    exit();
}

if ($password != $confirmPassword)
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_PASSWORDS_DO_NOT_MATCH;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token);
    exit();
}

require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT token, email, expiry_time_stamp FROM pending_users WHERE token = :token AND email = :email AND expiry_time_stamp > :expiry_time_stamp";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":token", $token, PDO::PARAM_STR);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement->execute();

if ($statement->rowCount() == 0)
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../forgot_password_confirm_new_password.php?token=" . $token); // deal with invalid input
    exit();
}

$query1 = "DELETE FROM pending_users WHERE email = :email";
$statement1 = $dbConnection->prepare($query1);
$statement1->bindParam(":email", $email, PDO::PARAM_STR);
$statement1->execute();

$query2 = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
$statement2 = $dbConnection->prepare($query2);
$statement2->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement2->execute();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$query3 = "UPDATE users SET password = :password WHERE email = :email";
$statement3 = $dbConnection->prepare($query3);
$statement3->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
$statement3->bindParam(":email", $email, PDO::PARAM_STR);
$statement3->execute();

header('location: ../index.php');
?>