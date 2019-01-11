<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com

-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>GOT TO SETTINGS PAGE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  .w3-button {width:150px;}
  </style>
</head>

<body onchange="myFunction()">
<div class="container">
<center>
  <br>
  <img src = "image/mng.png" width="50%" height="50%" />
  <h2>FIRST SETTINGS</h2>
  <p>Welcome to PHPManager, PHPManager is a PHP-Mysql Project for business managing
<br>Click the button below to make the settings.<br><br>

<a href = "admincreate.php">
  <button class="w3-button w3-deep-orange">SETTINGS</button>
</a>
</p>

</center>




</div>
<?php
include 'config.php';
//--- Check to see if there are an administrator account------------
$queryAdmin = mysqli_query($conn, "SELECT * FROM user WHERE role='Administrator'");
$AdminData = mysqli_num_rows($queryAdmin);
if($AdminData!=0){
  header('location:index.php');
}
include 'footer.php';
mysqli_close($conn);
?>
</script>
</body>
</html>
