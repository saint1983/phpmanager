
<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
configuration script here you will
put your Mysql Database connection
informations

-->
<?php

$servername = "localhost";
$database = "phpmanager";
$username = "root";
$password = "";
$datepost = date("Y-m-d");
$ip = $_SERVER['REMOTE_ADDR'];
$domain = $_SERVER['SERVER_NAME'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$query = $_SERVER['PHP_SELF'];
$path = pathinfo( $query );
$current_file = $path['basename'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>
