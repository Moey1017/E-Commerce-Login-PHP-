<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location: index.php");
}

/* Include "configuration.php" file */
require_once "configuration.php";


/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception


$query = "SELECT supplier_id, company_name from suppliers";
$statement = $dbConnection->prepare($query);
$statement->execute();


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
        $json .= '{"supplier_id":"' . $row->supplier_id . '","company_name":"' . $row->company_name . '"}';
        
        $isFirstRecord = false;
    }  
}     
$json .= "]";
/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;

?>
