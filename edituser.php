<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
Edit user information script-------->
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
    include 'config.php';
    if((!isset($_GET['id']))||trim($_GET['id'])==""){
    echo "No post like that !";
    }else{

  $user_id = addslashes($_GET['id']);
  $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
  $UserData = mysqli_num_rows($queryUser);
  if($UserData){
  while($theuser = mysqli_fetch_assoc($queryUser)) {
   $username = $theuser["username"];
   $email = $theuser['email'];
   $phone = $theuser['phone'];
   $role = $theuser['role'];
   $password = $theuser['password'];

?>
<form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="">
<input type="hidden" value = "<?php echo $user_id ; ?>" name="id">
<hr><center>
<p><b>Edit User informations </b></p>

</center>

      <div class="form-group">
        <label class="control-label col-sm-2"  for="username">Username :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value = "<?php echo $username; ?>" placeholder="username" name="username">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value = "<?php echo $email; ?>" placeholder="email" name="email">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Phone :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value = "<?php echo $phone; ?>"  placeholder="phone" name="phone">
        </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-2" for="type">Role :</label>
          <div class="col-sm-10">
            <select  class="form-control"  name="role">
              <option value = "<?php echo $role; ?>"><?php echo $role; ?></option>
              <option value = "">Select user role</option>
              <option value = "Employee">Employee</option>
              <option value = "Boss">Boss</option>
            </select>
          </div>
        </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password :</label>
        <div class="col-sm-10">
          leave it blank if you don't want to change the password
          <input type="password" class="form-control"  placeholder="your password" name="password">
        </div>
      </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name = "update" class="btn btn-default">EDIT USER</button>
    </div>
  </div>
</form>
<?php
  }
}
}

//-------------Update User information---------------------------------------
if(isset($_POST['update'])){
      //-- Get form data---------------------
      $id = addslashes($_POST ['id']);
      $username = addslashes($_POST ['username']);
      $email= addslashes($_POST ['email']);
      $phone = addslashes($_POST ['phone']);
      $role = addslashes($_POST ['role']);
      $password= md5($_POST ['password']);


      //-------- Update post without a new password -------------------
      if(empty($password)){
        $UpdateQuery = "UPDATE user SET username ='$username', email = '$email', phone = '$phone', role = '$role' WHERE id='$id'";
        $conn->query($UpdateQuery);
        echo '<script language="Javascript">';
         echo 'document.location.replace("./manageuser.php")'; // -->
         echo ' </script>';
      }else{//-------- Update with new password -------------------------
        $UpdateQuery = "UPDATE user SET username ='$username', email = '$email', phone = '$phone', role = '$role', password = '$password' WHERE id='$id'";
        $conn->query($UpdateQuery);
        echo '<script language="Javascript">';
         echo 'document.location.replace("./manageuser.php")'; // -->
         echo ' </script>';
      }



  }



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
}

}
</script>


</body>
</html>
