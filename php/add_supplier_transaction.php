<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location: index.php");
}
?>
<?php
require_once "error_messages.php";
/* Validate and assign input data */
$company_name = ltrim(rtrim(filter_input(INPUT_POST, "company_name", FILTER_SANITIZE_STRING)));
if ((empty($company_name)) || (!filter_var($company_name, FILTER_SANITIZE_STRING)))
{
    header("location: ../add_supplier.php"); // deal with invalid input
    exit();
}

$phone_number  = ltrim(rtrim(filter_input(INPUT_POST, "phone_number", FILTER_SANITIZE_STRING)));
if ((empty($phone_number)) || (!filter_var($phone_number, FILTER_SANITIZE_STRING))) // deal with invalid input
{
    header("location: ../add_supplier.php");
    exit();
}

$email  = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
if ((empty($email)) || (!filter_var($email, FILTER_SANITIZE_STRING))) // deal with invalid input
{
    header("location: ../add_supplier.php");
    exit();
}

$location  = ltrim(rtrim(filter_input(INPUT_POST, "location", FILTER_SANITIZE_STRING)));
if ((empty($location)) || (!filter_var($location, FILTER_SANITIZE_STRING))) // deal with invalid input
{
    header("location: ../add_supplier.php");
    exit();
}

/* Include "configuration.php" file */
require_once "configuration.php";


/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Perform Query */
$query = "INSERT INTO suppliers (supplier_id, company_name, phone_number, email, location) VALUES(DEFAULT, :company_name, :phone_number, :email, :location)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":company_name", $company_name, PDO::PARAM_STR);
$statement->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->bindParam(":location", $location, PDO::PARAM_STR);
$statement->execute();



/* Provide feedback that the record has been added */
if ($statement->rowCount() > 0)
{
    header("Location: ../admin_area.php");
}
else
{
    $_SESSION['error_message'] = $ERROR_SUPPLIER_FAILED;
    header("Location: ../error.php");
}



/* Provide a link for the user to proceed to a new webpage or automatically redirect to a new webpage */

?>