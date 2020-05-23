<?php

session_start();
$product_id = filter_input(INPUT_POST, "product_id", FILTER_SANITIZE_NUMBER_INT);
if (!isset($product_id)) {
    if (!filter_var($product_id, FILTER_VALIDATE_INT)) {
        header("location: ../update_product.php"); 
        exit();
    }
}
$name = ltrim(rtrim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)));
if (empty($name)) {
    header("location: ../update_product.php");
    exit();
}

$category = ltrim(rtrim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING)));
if (empty($category)) {
    header("location: ../update_product.php"); 
    exit();
}

$brand = ltrim(rtrim(filter_input(INPUT_POST, "brand", FILTER_SANITIZE_STRING)));
if (empty($brand)) {
    header("location: ../update_product.php");
    exit();
}

$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
if (!isset($price)) {

    header("location: ../update_product.php"); 
    exit();
}

$description = ltrim(rtrim(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING)));
if (empty($description)) {
    header("location: ../update_product.php"); 
}

$availability = filter_input(INPUT_POST, "availability", FILTER_SANITIZE_NUMBER_INT);
if (!isset($availability)) {
    if (!filter_var($availability, FILTER_VALIDATE_INT)) {
        header("location: ../update_product.php");
        exit();
    }
}

require_once "configuration.php";

$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "UPDATE products SET product_name = :name, category = :category, brand = :brand, price = :price, description = :description, availability = :avail WHERE product_id = :product_id";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement->bindParam(":name", $name, PDO::PARAM_STR);
$statement->bindParam(":category", $category, PDO::PARAM_STR);
$statement->bindParam(":brand", $brand, PDO::PARAM_STR);
$statement->bindParam(":price", $price, PDO::PARAM_INT);
$statement->bindParam(":description", $description, PDO::PARAM_STR);
$statement->bindParam(":avail", $availability, PDO::PARAM_INT);
$statement->execute();

if ($statement->rowCount() > 0) {
    header("location: ../products.php?page_number=1");
} else {
    header("location: ../error.php");
}

?>   

