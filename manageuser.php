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
<h2>Here users list </h2>
  <p></p>

  <table class="w3-table" style="width:400px">
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Role</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
<?php

///--- Select and display all users ------------
$queryUser = mysqli_query($conn, "SELECT * FROM user WHERE role != 'Administrator'");//Don't select an administrator user
$UserData = mysqli_num_rows($queryUser);
if($UserData){
while($theuser = mysqli_fetch_assoc($queryUser)) {
  $theuser_id = $theuser["id"];
  $username = $theuser["username"];
  $email = $theuser['email'];
  $phone = $theuser['phone'];
  $role = $theuser['role'];
?>
<tr>
  <td><?php echo "".$username;?></td>
  <td><?php echo "".$email;?></td>
  <td><?php echo "".$phone;?></td>
  <td><?php echo "".$role;?></td>
  <td><a href = "edituser.php?id=<?php echo $theuser_id; ?>"><img src='image/edituser.png'  width = "70%" height = "70%"></a></td>
  <td><a href = "deletepost.php?id=<?php echo $theuser_id; ?>"><?php echo "<img src='image/deleteuser.png'  width = '50%' height = '50%'>";?></a></td>
</tr>

<?php
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
  echo "No user please create an user account !";
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
