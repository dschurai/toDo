<?php 
    //include local connection data
include 'config/connectionData.php';
try{
    //connecting to local DB
$db_connection = mysqli_connect("localhost", $sqlUsername, $sqlPassword, "todo");
}
catch(Exception){
echo "Error connecting to database.";
}
?>