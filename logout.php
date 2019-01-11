<?php
session_start();

if(isset($_SESSION['role'])){
$UserId =  $_SESSION['id'];
include 'config.php';
mysqli_query($conn, "INSERT INTO activity (id,user,action,datepost) VALUES ('','$UserId','log out','$datepost')");
session_destroy();
echo $UserId;
}
header('location:index.php');

?>
