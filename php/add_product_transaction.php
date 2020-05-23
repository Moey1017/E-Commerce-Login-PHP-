<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location: index.php");
}
?>
<?php

require_once "error_messages.php";

$name = ltrim(rtrim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)));
if (empty($name)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$category = ltrim(rtrim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING)));
if (empty($category)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$brand = ltrim(rtrim(filter_input(INPUT_POST, "brand", FILTER_SANITIZE_STRING)));
if (empty($brand)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
if (!isset($price)) {

    header("location: ../index.php"); // deal with invalid input
    exit();
}

$image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_STRING);
if (!isset($image)) {

    header("location: ../index.php"); // deal with invalid input
    exit();
}

$description = ltrim(rtrim(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING)));
if (empty($description)) {
    header("location: ../index.php"); // deal with invalid input
}

$availability = filter_input(INPUT_POST, "availability", FILTER_SANITIZE_NUMBER_INT);
if (!isset($availability)) {
    if (!filter_var($availability, FILTER_VALIDATE_INT)) {
        header("location: ../index.php"); // deal with invalid input
        exit();
    }
}

require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "INSERT INTO products (product_name, category, brand, product_image, price, description, availability) 
    VALUES (:name, :category, :brand, :image, :price, :description, :avail)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":name", $name, PDO::PARAM_STR);
$statement->bindParam(":category", $category, PDO::PARAM_STR);
$statement->bindParam(":brand", $brand, PDO::PARAM_STR);
$statement->bindParam(":price", $price, PDO::PARAM_INT);
$statement->bindParam(":image", $image, PDO::PARAM_STR);
$statement->bindParam(":description", $description, PDO::PARAM_STR);
$statement->bindParam(":avail", $availability, PDO::PARAM_INT);
$statement->execute();

if ($statement->rowCount() > 0) {
    header("location: ../admin_area.php");
} else {
    $_SESSION['error_message'] = $ERROR_PRODUCT_FAILED;
    header("location: ../error.php");
}


?>  


