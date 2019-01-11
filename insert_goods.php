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
<?php

//-------------- create a product ----------
if(isset($_POST['create'])){
  //------- product informations ------------------
$ref = addslashes($_POST ['ref']);
$name= addslashes($_POST ['name']);
$description = addslashes($_POST ['description']);
$price = addslashes($_POST ['price']);

  $query = mysqli_query($conn, "SELECT * FROM goods WHERE ref ='$ref'");
  $rows = mysqli_num_rows($query);
  if($rows==0){
    if(!isset($_FILES['image'])){
      echo "<center>";
      echo "<font color = 'red'>";
      echo "Insert a picture";
      echo "</font>";
      echo "</center>";
}else{
//------- convert image to base64_encode------------------
$image_path = $_FILES["image"]["tmp_name"]; //this will be the physical path of your image
if($image_path!=""){
$img_binary = fread(fopen($image_path, "r"), filesize($image_path));
$picture = base64_encode($img_binary);
//-------- Insert goods -----------------------------------
  mysqli_query($conn, "INSERT INTO user (id,username,email,phone,role,password,datepost) VALUES ('','$username','$email','$phone','$role','$password','$datepost')");
  /*
  echo '<script language="Javascript">';
  echo 'document.location.replace("./admin.php")'; // -->
  echo ' </script>';
  */
  }
}

}else{
  echo "<center>";
  echo "<font color = 'red'>";
  echo "It seems that user already exist";
  echo "<br>";
  echo "Try again if the same problem";
  echo "<br>";
  echo "Please contact the software developper";
  echo "</center>";
  echo "</font>";

}
  }

?>

        <!---Form ----->

<form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="">
<hr><center>
<p><b>New product</b></p>

</center>

      <div class="form-group">
        <label class="control-label col-sm-2" for="username">ref :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="Product reference" name="ref">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Product name :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="Product name" name="name">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Image :</label>
        <div class="col-sm-10">
          <input type="file" class="form-control"  placeholder="Your image" name="image">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Description :</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description"></textarea>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Price in USD :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="The price" name="price">
        </div>
      </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name = "create" class="btn btn-default">INSERT PRODUCT </button>
    </div>
  </div>
</form>


</div>
<?php
include 'footer.php';
mysqli_close($conn);
?>
<script>
function validateForm() {
//-- Javascript Form validation---------------------
var x1 = document.forms["myForm"]["ref"].value;
var x2 = document.forms["myForm"]["name"].value;
var x3 = document.forms["myForm"]["description"].value;
var x4 = document.forms["myForm"]["price"].value;
var x5 = document.forms["myForm"]["password"].value;

if (x1 == "") {
    alert("Enter Reference");
    return false;
}else if (x2 == "") {
    alert("Enter product name");
    return false;
}else if (x3 == "") {
    alert("Enter product description");
    return false;
}else if (x4 == "") {
    alert("Enter price");
    return false;
}else if (x5 =="") {
    alert("Enter user password");
    return false;
}

}
</script>


</body>
</html>
