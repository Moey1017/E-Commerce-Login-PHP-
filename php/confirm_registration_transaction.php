<?php
session_start();
?>
<?php
require_once "error_messages.php";

$token = filter_var($_GET['token'], FILTER_SANITIZE_STRING);
if (empty($token)) {
    header("location: ../registration_error.php");
    exit();
}

require_once "configuration.php";

$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT email FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

if ($statement->rowCount() > 0) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAIL_ALREADY_REGISTERED;
    header("location: ../registration_error.php");
    exit();
}

$query1 = "SELECT token, email, name, password, accessLevel, expiry_time_stamp FROM pending_users WHERE token = :token AND expiry_time_stamp > :expiry_time_stamp";
$statement1 = $dbConnection->prepare($query1);
$statement1->bindParam(":token", $token, PDO::PARAM_STR);
$statement1->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement1->execute();

$name;
$email;
$password;
$accessLevel;
$isActive;

if ($statement1->rowCount() == 1) {
    $result = $statement1->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row) {
        $name = $row->name;
        $email = $row->email;
        $password = $row->password;
        $accessLevel = $row->accessLevel;
    }
    $isActive = true;
} else {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: ../registration_error.php"); // deal with invalid input
    exit();
}

$query2 = "DELETE FROM pending_users WHERE token = :token";
$statement2 = $dbConnection->prepare($query2);
$statement2->bindParam(":token", $token, PDO::PARAM_STR);
$statement2->execute();

/* remove all old pending users from database */
$query3 = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
$statement3 = $dbConnection->prepare($query3);
$statement3->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement3->execute();

$query4 = "INSERT INTO users (email, name, password, access_level) VALUES (:email, :name, :password, :accessLevel)";
$statement4 = $dbConnection->prepare($query4);
$statement4->bindParam(":email", $email, PDO::PARAM_STR);
$statement4->bindParam(":name", $name, PDO::PARAM_STR);
$statement4->bindParam(":password", $password, PDO::PARAM_STR);
$statement4->bindParam(":accessLevel", $accessLevel, PDO::PARAM_INT);
$statement4->execute();

header("location: ".$siteName."/Login_CA2/index.php");
exit();
?>