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

  }else{
    echo '<script language="Javascript">';
     echo 'document.location.replace("./index.php")'; // -->
     echo ' </script>';
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
<!---User tab ----->
<h2>Users Activities</h2>
  <p></p>

  <table class="w3-table" style="width:400px">
    <tr>
      <th>Username</th>
      <th>Role</th>
      <th>Action</th>
      <th>Datepost</th>
    </tr>
<?php

///--- Select and display all users ------------
$queryActivity = mysqli_query($conn, "SELECT * FROM activity ");//Don't select an administrator user
$ActivityData = mysqli_num_rows($queryActivity);
if($ActivityData){
while($theActivity = mysqli_fetch_assoc($queryActivity)) {
  $theuser_id = $theActivity["user"];
  $action = $theActivity['action'];
  $datepost = $theActivity['datepost'];
      //--- get user info -----------------------
  $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE id ='$theuser_id'");
  while($userinfo = mysqli_fetch_assoc($queryUser)) {
  $username = $userinfo["username"];
  $role = $userinfo['role'];
  ?>
<tr>
  <td><?php echo "".$username;?></td>
  <td><?php echo "".$role;?></td>
  <td><?php echo "".$action;?></td>
  <td><?php echo "".$datepost;?></td>
</tr>

<?php
  }
}

  /*
  echo '<script language="Javascript">';
  echo 'document.location.replace("./admin.php")'; // -->
  echo ' </script>';
  */

}else{
  echo "<center>";
  echo "<b>";
  echo "<font color = 'red'>";
  echo "No Activities!";
  echo "</font>";
  echo "</b>";
  echo "</center>";
}



?>


    </table>


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
