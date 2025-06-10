<?php
if (!isset($_SESSION)) {
  session_start();
}


if($_SERVER["SERVER_NAME"]=="localhost"){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "student_registration";
}else{
  $servername = "aster.arvixe.com";
  $username = "emirco1";
  $password = "emirco1";
  $database = "student_registration";
}



// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$conn->query("SET SQL_BIG_SELECTS=1");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


date_default_timezone_set('Asia/Kuala_Lumpur');
define('DATE_TODAY', date('Y-m-d H:i:s'));
define('YEAR', date('Y'));
define('MONTH', date('n'));
?>