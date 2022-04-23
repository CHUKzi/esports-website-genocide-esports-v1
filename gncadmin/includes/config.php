<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','gncdb');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>

<?php

// Total Views DB connection

//$db_host = "localhost";               // Database Host
//$db_user = "root";                    // Database User
//$db_pass = "";                        // Database Password
//$db_name = "ezzdb"; // Database Name
//$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); // Connect to Database
//if(!$conn) // Check connection
//{
  //die("Connection failed: " . mysqli_connect_error()); // Display error if not connected
//}
?>