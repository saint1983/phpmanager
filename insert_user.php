<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
Sign Up script where user make posts
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADMINISTRATOR MENU</title>
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

  if($UserRole!="Administrator"){
    echo '<script language="Javascript">';
     echo 'document.location.replace("./logout.php")'; // -->
     echo ' </script>';
  }

  }
  ?>

  <div class="container">
  <center>
  <h2>ADMINISTRATOR MENU</h2>
  </center>
<?php
include 'business_info.php';
?>
<hr>
<?php

//-------------- create an user if he or she doesn't existed ----------
if(isset($_POST['create'])){
  //------- administrator informations ------------------
$username = addslashes($_POST ['username']);
$email= addslashes($_POST ['email']);
$phone = addslashes($_POST ['phone']);
$role = addslashes($_POST ['role']);
$password= md5($_POST ['password']);

  $query = mysqli_query($conn, "SELECT * FROM user WHERE email ='$email'|| username = '$username'");
  $rows = mysqli_num_rows($query);
  if($rows!=1){
  $array = $query->fetch_assoc();
  mysqli_query($conn, "INSERT INTO user (id,username,email,phone,role,password,datepost) VALUES ('','$username','$email','$phone','$role','$password','$datepost')");
  echo "<center>";
  echo "<font color = 'green'>";
  echo "User registered";
  echo "<br>";
  echo "Register an other user";
  echo "<br>";
  echo "</center>";
  echo "</font>";

  /*
  echo '<script language="Javascript">';
  echo 'document.location.replace("./admin.php")'; // -->
  echo ' </script>';
  */
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
<p><b>New User informations </b></p>

</center>

      <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="username" name="username">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="email" name="email">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Phone :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="phone" name="phone">
        </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-2" for="type">Role :</label>
          <div class="col-sm-10">
            <select  class="form-control"  name="role">
              <option value = "">Select user role</option>
              <option value = "Employee">Employee</option>
              <option value = "Boss">Boss</option>
            </select>
          </div>
        </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password :</label>
        <div class="col-sm-10">
          <input type="password" class="form-control"  placeholder="your password" name="password">
        </div>
      </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name = "create" class="btn btn-default">CREATE USER</button>
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
var x1 = document.forms["myForm"]["username"].value;
var x2 = document.forms["myForm"]["email"].value;
var x3 = document.forms["myForm"]["phone"].value;
var x4 = document.forms["myForm"]["role"].value;
var x5 = document.forms["myForm"]["password"].value;

if (x1 == "") {
    alert("Enter user name ");
    return false;
}else if (x2 == "") {
    alert("Enter user email");
    return false;
}else if (x3 == "") {
    alert("Enter user phone");
    return false;
}else if (x4 == "") {
    alert("Enter user role");
    return false;
}else if (x5 =="") {
    alert("Enter user password");
    return false;
}

}
</script>


</body>
</html>
