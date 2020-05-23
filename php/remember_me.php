<?php
session_start();
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['user_id'])) {
    header('location: ../admin_area.php');
    exit();
} else if (isset($_COOKIE['rememberme'])) {

    $user_id = decryptCookie($_COOKIE['rememberme']);

    $query = "SELECT id, name, email, access_level FROM users WHERE id = :id";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(":id", $user_id, PDO::PARAM_INT);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $row = $statement->fetch(PDO::FETCH_OBJ);
        $_SESSION['user_id'] = $user_id;
        $_SESSION["user_name"] = $row->name;
        $_SESSION["access_level"] = $row->access_level;
        $_SESSION['logged_in'] = true;
        $_SESSION["error_message"] = "";
        header('location: ../admin_area.php');
        exit();
    }
}

function decryptCookie($value) {
    $key = 'GlichSecurityKey';
    $newvalue = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $newvalue;
}
