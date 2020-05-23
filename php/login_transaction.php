<?php

session_start();

// if it exists, then destroy any previous session 
session_unset();
session_destroy();
session_start();

require_once "error_messages.php";
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function encryptCookie($value) {
    $key = 'GlichSecurityKey';
    $newvalue = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))));
    return $newvalue;
}

/* Validate and assign input data */
$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
        header("location: ../index.php"); // deal with invalid input
        exit();
    }
}

$password = ltrim(rtrim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)));
if (empty($password)) {
    $_SESSION['error_message'] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
    header("location: ../index.php");  // deal with invalid input
    exit();
}

if ($_POST['submit']) {
    $token = $_POST['token'];
    $action = $_POST['action'];

    $curlData = array(
        'secret' => '6LecMfAUAAAAABVuHJdVgalqypWDGtlgBlbcY-wi',
        'response' => $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($ch);

    $captchaResponse = json_decode($curlResponse, true);

    if ($captchaResponse['success'] == '1' && $captchaResponse['action'] == $action && $captchaResponse['score'] >= 0.5 && $captchaResponse['hostname'] == $_SERVER['SERVER_NAME']) {

        /* Check that user is not already user_added  */
        $query = "SELECT id, name , password, access_level FROM users WHERE email = :email";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        $logged_in = false;
        $_SESSION["user_name"] = "";

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_OBJ);

            if (!password_verify($password, $row->password)) {
                $_SESSION['error_message'] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
                header("location: ../index.php");
                exit();
            } else {
                $_SESSION["user_id"] = $row->id;
                $_SESSION["user_name"] = $row->name;
                $_SESSION["access_level"] = $row->access_level;
                $_SESSION['logged_in'] = true;
                $_SESSION["error_message"] = "";
                $logged_in = true;
                $value = encryptCookie($row->id);
                setCookie('rememberme', $value, time() + (30 * 24 * 60 * 60 * 100), "/");
            }
        } else {

            $_SESSION['error_message'] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
        }

        if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = :password WHERE id = :id";
            $statement = $dbConnection->prepare($query);
            $statement->bindParam(":password", $newPassword, PDO::PARAM_STR);
            $statement->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
            $statement->execute();
        }

        if ($logged_in === true) {
            header("location: ../admin_area.php");
            exit();
        } else {
            header("location: ../index.php");
            exit();
        }
    } else {
        header("location: ../index.php");
        exit();
    }
}
?>
