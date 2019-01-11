<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
Sign Up script where user make posts
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FIRST PAGE USER LOGIN : PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/div.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
<body onchange="myFunction()">
<div class="container">
<center>
  <h2>USER LOGIN</h2>
</center>
<?php
session_start();
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'business_info.php';
?>
<hr>
<?php


if(isset($_SESSION['role'])){
$UserId =  $_SESSION['id'];
$UserName =  $_SESSION['username'];
$UserRole =   $_SESSION['role'];

if(isset($_SESSION['role'])){
  $getrole = isset($_SESSION['role']);
  if($getrole=="Administrator"){
      echo '<script language="Javascript">';
       echo 'document.location.replace("./admin.php")'; // -->
       echo ' </script>';
  }else if($getrole=="Employee"){
      echo '<script language="Javascript">';
       echo 'document.location.replace("./admin.php")'; // -->
       echo ' </script>';
  }else if($getrole=="Boss"){
      echo '<script language="Javascript">';
       echo 'document.location.replace("./admin.php")'; // -->
       echo ' </script>';
  }else{
      echo '<script language="Javascript">';
       echo 'document.location.replace("./logout.php")'; // -->
       echo ' </script>';
  }
}
}
//--- Check to see if there are an administrator account------------
$queryAdmin = mysqli_query($conn, "SELECT * FROM user WHERE role='Administrator'");
$AdminData = mysqli_num_rows($queryAdmin);
if($AdminData==0){

  echo '<script language="Javascript">';
   echo 'document.location.replace("./setting.php")'; // -->
   echo ' </script>';
     //  header('location:setting.php');

}else{
//----- Login script-----------------------
if(isset($_POST['login'])){
//-------- get login form informations ------------------------
  $role = addslashes($_POST ['role']);
  $username = addslashes($_POST ['username']);
  $password = md5($_POST ['password']);
//-------------- Check if exist -----------------------------
      $query = mysqli_query($conn, "SELECT * FROM user WHERE password='$password' AND username ='$username'");
      $rows = mysqli_num_rows($query);
      if($rows==1){ //------- If User exist----------------------
      $array = $query->fetch_assoc();
      //------- Employee Login ---------------------
      if($role == "Employee"){
        session_start();
        $_SESSION['logged_in']= true;
        $_SESSION['id'] = $array['id'];
        $_SESSION['username'] = $array['username'];
        $_SESSION['role'] = $array['role'];

        $UserId =  $_SESSION['id'];
        mysqli_query($conn, "INSERT INTO activity (id,user,action,datepost) VALUES ('','$UserId','log in','$datepost')");

        echo '<script language="Javascript">';
         echo 'document.location.replace("./employee.php")'; // -->
         echo ' </script>';
           //header('location:employee.php');

        }

      //------- Administrator Login ------------------
      if($role == "Administrator"){
        session_start();
        $_SESSION['logged_in']= true;
        $_SESSION['id'] = $array['id'];
        $_SESSION['username'] = $array['username'];
        $_SESSION['role'] = $array['role'];

        $UserId =  $_SESSION['id'];
        mysqli_query($conn, "INSERT INTO activity (id,user,action,datepost) VALUES ('','$UserId','log in','$datepost')");

        echo '<script language="Javascript">';
         echo 'document.location.replace("./admin.php")'; // -->
         echo ' </script>';
             //header('location:admin.php');

        }

      //------- Boss Login ------------------
      if($role == "Boss"){
        session_start();
        $_SESSION['logged_in']= true;
        $_SESSION['id'] = $array['id'];
        $_SESSION['username'] = $array['username'];
        $_SESSION['role'] = $array['role'];

        $UserId =  $_SESSION['id'];
        mysqli_query($conn, "INSERT INTO activity (id,user,action,datepost) VALUES ('','$UserId','log in','$datepost')");

        echo '<script language="Javascript">';
        echo 'document.location.replace("./boss.php")'; // -->
        echo ' </script>';
        }
      }else{
      echo "<center>";
      echo "<font color = 'red'>";
      echo "Wrong login informations";
      echo "<br>";
      echo "Try again if the same thing problem";
      echo "<br>";
      echo "Please contact the administrator";
      echo "</center>";
      echo "</font>";
      }
  }
}
  ?>
  <br>


    <form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="">

    <div class="form-group">
        <label class="control-label col-sm-2" for="type">Role :</label>
        <div class="col-sm-10">
          <select  class="form-control"  name="role">
            <option value = "">Select your role</option>
            <option value = "Employee">Employee</option>
            <option value = "Administrator">Administrator</option>
            <option value = "Boss">Boss</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  placeholder="username" name="username">
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
          <button type="submit" name = "login" class="btn btn-default">Login</button>
        </div>
      </div>
    </form>

    <?php

    include 'footer.php';
    mysqli_close($conn);
    ?>
</div>
<script>
function validateForm() {

  var x1 = document.forms["myForm"]["level"].value;
  var x2 = document.forms["myForm"]["username"].value;
  var x3 = document.forms["myForm"]["password"].value;


    if (x1 == "") {
        alert("Choose your level!");
        return false;
    }else if (x2 == "") {
        alert("Put your username!");
        return false;
    }else if (x3 == "") {
        alert("Put your password!");
        return false;
    }
}
</script>
</body>
</html>
