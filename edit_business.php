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
  <h2>EDIT BUSINESS INFORMATIONS</h2>
  </center>
<?php
include 'business_info.php';
?>
<hr>

<?php
    include 'config.php';

    $queryBusiness = mysqli_query($conn, "SELECT * FROM business");
    $BusinessData = mysqli_num_rows($queryBusiness);
    if($BusinessData){
    while($Business = mysqli_fetch_assoc($queryBusiness)) {
    $id = $Business["id"];
     $picture= $Business["logo"];
     $name = $Business["name"];
     $phone = $Business['phone'];
     $email = $Business['email'];
     $site = $Business['site'];
     $info = $Business['information'];
?>
<form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="updateDelete.php">
  <input type="hidden"  value ="<?php echo $id; ?>" name="id">

  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Business Name :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  placeholder="Business Name" value ="<?php echo $name; ?>" name="bname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Business telephone :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  placeholder="Business phone" value = "<?php echo $phone; ?>" name="bphone">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Business Email :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  placeholder="Business email" value = "<?php echo $email; ?>" name="bemail">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Business website :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  placeholder="Business website" value = "<?php echo $site; ?>" name="site">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Business Informations :</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="information"><?php echo $info; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="Image">Image :</label>
    <div class="col-sm-10">
    <?php echo "<img src=data:image/jpg;base64,$picture width='20%' height='20%'>";?>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="picture">Picture :</label>
  <div class="col-sm-10">
  <input type="file" class="form-control" id = "picture" name="picture" onchange="myFunction()" >
  </div>
  </div>
  <div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
  <button type="submit" name = "update" class="btn btn-default">Update</button>
  </div>
  </div>
  </form>
<?php
}
}

//----- UPDATE YOUR BUSINESS INFORMATIONS-----

if(isset($_POST['update'])){
      //-- Get form data---------------------
      $id = addslashes($_POST ['id']);
      $username = addslashes($_POST ['username']);
      $email= addslashes($_POST ['email']);
      $phone = addslashes($_POST ['phone']);
      $role = addslashes($_POST ['role']);
      $password= md5($_POST ['password']);

        $UpdateQuery = "UPDATE user SET username ='$username', email = '$email', phone = '$phone', role = '$role' WHERE id='$id'";
        $conn->query($UpdateQuery);
        echo '<script language="Javascript">';
        echo 'document.location.replace("./admin.php")'; // -->
        echo ' </script>';

        include 'footer.php';
        mysqli_close($conn);
        ?>


</div>
<script>
//------ Form control-------------------
function myFunction(){
var p = document.getElementById("picture");
var txt = "";
if ('files' in p) {
    if (p.files.length == 0) {
      //  txt = "Select one or more files.";
    } else {
        for (var i = 0; i < p.files.length; i++) {
            //txt += "<br><strong>" + (i+1) + ". file</strong><br>";
            var file = p.files[i];
            if ('name' in file) {
                //txt += "name: " + file.name + "<br>";
            }
            if ('size' in file) {
                //txt += "size: " + file.size + " bytes <br>";
            }
        }
    }
}
else {
    if (p.value == "") {
      //  txt += "Select one or more files.";
    } else {
        //txt += "The files property is not supported by your browser!";
        //txt  += "<br>The path of the selected file: " + p.value; // If the browser does not support the files property, it will return the path of the selected file instead.
    }
}
document.getElementById("demo").innerHTML = txt;
var x4 = p.value;

}

function validateForm() {
var x = document.forms["myForm"]["type"].value;
var x1 = document.forms["myForm"]["title"].value;
var x2 = document.forms["myForm"]["picture"].value;
var x3 = document.forms["myForm"]["description"].value;

if(x4!=0){
if (x == ""||x1 == ""||x2 == ""||x3 == ""||x4>514000) {
    alert("All the fields are required and made sure your select an image file with a size less than 500kb!");
    return false;
}
}else{
if (x == ""||x1 == ""||x2 == ""||x3 == "") {
    alert("All the fields are required !");
    return false;
}
}
}

</script>
</body>
</html>
