<?php

/******************************/
// connecting to GCP cloud SQL instance

$username = 'root';
$password = 'tutorme';
$dbname = 'tutorMe';
$host = '35.245.17.157';

// connect from App Engine
$dsn = "mysql:unix_socket=/cloudsql/cs4750db-275021:us-east4:db-tutorme;dbname=$dbname";

// connect using public IP (local dev)
$dsn = "mysql:host=$host;dbname=$dbname";

/******************************/

/** connect to the database **/
try
{
    $db = new PDO($dsn, $username, $password);
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
    // Call a method from any object,
    // use the object's name followed by -> and then method's name
    // All exception objects provide a getMessage() method that returns the error message
    $error_message = $e->getMessage();
    echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
}
