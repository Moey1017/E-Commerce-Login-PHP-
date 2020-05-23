<?php
session_start();
/* Include "configuration.php" file */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "SELECT supplier_id, company_name, phone_number, email, location FROM suppliers";
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
        $json .= '{"supplier_id":"' . $row->supplier_id . '","company_name":"' . $row->company_name . '","phone_number":"' . $row->phone_number  . '","email":"' . $row->email  . '","location":"' . $row->location .'"}';
        
        $isFirstRecord = false;
    }  
}     
$json .= "]";

/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;
?>


