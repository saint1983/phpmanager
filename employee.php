<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
Sign Up script where user make posts
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>EMPLOYEE MENU</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/div.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/button.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
<body >
  <?php

  session_start();
  include 'config.php';
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if(isset($_SESSION['role'])){
  $UserId =  $_SESSION['id'];
  $UserName =  $_SESSION['username'];
  $UserRole =   $_SESSION['role'];

  if($UserRole!="Employee"){
    echo '<script language="Javascript">';
     echo 'document.location.replace("./logout.php")'; // -->
     echo ' </script>';
  }

}else {
  echo '<script language="Javascript">';
   echo 'document.location.replace("./index.php")'; // -->
   echo ' </script>';
}
  ?>

<div class="container">
<center>
  <h2>EMPLOYEE MENU</h2>
</center>
<?php
include 'business_info.php';
?>
<hr>

<center>
  <a href = "logout.php">
    <button class="w3-btn w3-white w3-border">
  <img src = "image/logout.png" width="60%" height = "60%">
    <br> LOGOUT<br></button>
  </a>
<a href = "insert_goods.php">
  <button class="w3-btn w3-orange w3-border">
<img src = "image/pack.png" width="60%" height = "60%">
  <br> REGISTER NEW<br>GOOD</button>
</a>
<a href = "">
  <button class="w3-btn w3-blue-grey w3-border">
<img src = "image/editgood.png" width="60%" height = "60%">
  <br> MANAGE<br>GOODS</button>
</a>

<hr>
<a href = "">
  <button class="w3-btn w3-brown w3-border">
<img src = "image/sell.png" width="60%" height = "60%">
  <br>NEW<br>SELL</button>
</a>
<a href = "">
  <button class="w3-btn w3-blue w3-border">
<img src = "image/printer.png" width="60%" height = "60%">
  <br>PRINT<br>RECEIPT</button>
</a>
<a href = "">
  <button class="w3-btn w3-lime w3-border">
<img src = "image/record.png" width="60%" height = "60%">
  <br>SELLS<br>RECORDS</button>
</a>

<a href = "">
  <button class="w3-btn w3-aqua w3-border">
<img src = "image/warehouse.png" width="60%" height = "60%">
  <br>BUSINESS<br>WAREHOUSE</button>
</a>

</center>


<?php
include 'footer.php';
?>
</div>

</body>
</html>
