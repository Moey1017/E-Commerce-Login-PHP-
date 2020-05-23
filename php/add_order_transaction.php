<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}

require_once "error_messages.php";
/* Validate and assign input data */
$total = ltrim(rtrim(filter_input(INPUT_POST, "total", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
if ((empty($total)) || (!filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT))) {
    header("location: ../add_order.php"); // deal with invalid input
    exit();
}

$suppler_id = ltrim(rtrim(filter_input(INPUT_POST, "supplier_id", FILTER_SANITIZE_NUMBER_INT)));
if ((empty($suppler_id)) || (!filter_var($suppler_id, FILTER_VALIDATE_INT))) { // deal with invalid input
    header("location: ../add_order.php");
    exit();
}

/* Include "configuration.php" file */
require_once "configuration.php";


/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Perform Query */
$query = "INSERT INTO orders_from_suppliers (id_order_from_supplier, date, total, supplier_id) VALUES(DEFAULT, DEFAULT, :total, :supplier_id)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":total", $total, PDO::PARAM_STR);
$statement->bindParam(":supplier_id", $suppler_id, PDO::PARAM_INT);
$statement->execute();



/* Provide feedback that the record has been added */
if ($statement->rowCount() > 0) {
    header("location: ../admin_area.php");
} else {
    $_SESSION['error_message'] = $ERROR_ORDER_FAILED;
    header("location: ../error.php");
}
?>