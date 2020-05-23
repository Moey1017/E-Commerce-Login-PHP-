<?php

session_start();
require_once '../vendor/autoload.php';
$fb = new \Facebook\Facebook([
    'app_id' => '765147987351220',
    'app_secret' => 'db10dde3dfb9d645d8b3497e461c3c51',
    'default_graph_version' => 'v2.10'
        ]);

try {
    $response = $fb->get('/me?fields=name,email', $_SESSION['fb_access_token']);
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo $e->getMessage();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo $e->getMessage();
}

$me = $response->getGraphUser();

function encryptCookie($value) {
    $key = 'GlichSecurityKey';
    $newvalue = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))));
    return $newvalue;
}

require_once "configuration.php";
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Check that user is not already user_added  */
$query = "SELECT id, name , password, access_level FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $me['email'], PDO::PARAM_STR);
$statement->execute();

$logged_in = false;
$_SESSION["user_name"] = "";

if ($statement->rowCount() > 0) {
    $row = $statement->fetch(PDO::FETCH_OBJ);
    
        $_SESSION["user_id"] = $row->id;
        $_SESSION["user_name"] = $row->name;
        $_SESSION["access_level"] = $row->access_level;
        $_SESSION['logged_in'] = true;
        $_SESSION["error_message"] = "";
        $logged_in = true;
        $value = encryptCookie($row->id);
        setCookie('rememberme', $value, time() + (30 * 24 * 60 * 60 * 100), "/");
        
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
    header("location: https://williamhadnett.space/Login_CA2/admin_area.php");
    exit();
} else {
    $_SESSION['error_message'] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
    header("location: ../index.php");
    exit();
}
