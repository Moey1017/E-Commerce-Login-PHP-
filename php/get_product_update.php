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

$product_id = $jsonData['product_id'];  // read the model data from jsonData
if (empty($product_id)) 
{
    echo "[]"; // send back an empty JSON string
    exit();
}

/* Include "configuration.php" file */
require_once "configuration.php";


/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception


/* Perform query */
$query = "SELECT product_id, product_name, price, availability, brand, description, product_image, category FROM products WHERE product_id = :product_id";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement->execute();


/* Manipulate the query result */
$json = "[";
if ($statement->rowCount() > 0) {
    /* Get field information for all fields */
    $isFirstRecord = true;
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row) {
        if (!$isFirstRecord) {
            $json .= ",";
        }

        /* NOTE: json strings MUST have double quotes around the attribute names, as shown below */
        $json .= '{"product_id":"' . $row->product_id . '","product_name":"' . $row->product_name . '","price":"'.$row->price.'","availability":"'.$row->availability.'","description":"'.$row->description.'","product_image":"'.$row->product_image.'","category":"'.$row->category.'","brand":"'.$row->brand.'"}';

        $isFirstRecord = false;
    }
}
$json .= "]";

/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;




/* Provide a link for the user to proceed to a new webpage or automatically redirect to a new webpage */
/* This webpage never actually displays. Instead, it runs in the background on the server. */
/* The data contained in the line of code "echo $json;" is automatically sent back inside the "http_request.responseText" of the calling function. */
/* Therefore, no feedback or way to proceed is necessary. */
?>
