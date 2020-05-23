<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location: index.php");
}
?>
<?php

header("Content-Type: application/json; charset=UTF-8");

/* read the json data that was sent to this file */
$jsonData = json_decode(file_get_contents('php://input'), true);
/* Validate and assign input data */

$page_number = $jsonData['page_number'];  // read the model data from jsonData
if (empty($page_number)) 
{
    echo "[]"; // send back an empty JSON string
    exit();
}
/* Include "configuration.php" file */
require_once "configuration.php";

$items_per_page = 12;
$lower_limit = ($page_number - 1) * $items_per_page;
$max_limit = $page_number * $items_per_page;

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "SELECT product_id, product_name, category, brand, product_image, price, description, availability FROM products LIMIT $lower_limit ,$max_limit";
$statement = $dbConnection->prepare($query);    
$statement->execute();

/* Manipulate the query result */
$json = "[";
if ($statement->rowCount() > 0)
{
    /* Get field information for all fields */
    $isFirstRecord = true;
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row)
    {
        if(!$isFirstRecord)
        {
            $json .= ",";
        }
        
        /* NOTE: json strings MUST have double quotes around the attribute names, as shown below */
        $json .= '{"product_id":"' . strval($row->product_id) . '","product_name":"' . $row->product_name  . '","category":"' . $row->category  . '","price":"' . strval($row->price)  . '","product_image":"' . $row->product_image  .'","brand":"' . $row->brand  .'","description":"' . $row->description  .'","quantity":"' . $row->availability .'"}';
        
        $isFirstRecord = false;
    }  
}     
$json .= "]";

/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;

?>