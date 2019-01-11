<!--
AUTHOR : AMANI A. SAINT-CLAIR
EMAIL : aymeric@zgamesoft.com
First page when the index page can
not get information about the administrator
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FIRST SETTINGS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
<body onchange="myFunction()">
<div class="container">

<center>
<img src = "image/mng.png" width="15%" height="15%" />  <h2>FIRST SETTINGS</h2>
    <p><b>Business Informations</b></p></center>

    <?php
    include 'config.php';
    //-------- Check if admin account has been created ----------
    $queryAdmin = mysqli_query($conn, "SELECT * FROM user WHERE role='Administrator'");
    $AdminData = mysqli_num_rows($queryAdmin);
    if($AdminData!=0){
      header('location:index.php');
    }else{
    //---------------Create an administrator and Business Info -------------------------
    if(isset($_POST['signup'])){
      //------- administrator informations ------------------
    $username = addslashes($_POST ['username']);
    $email= addslashes($_POST ['email']);
    $phone = addslashes($_POST ['phone']);
    $role = addslashes($_POST ['role']);
    $password= md5($_POST ['password']);
//---------- Business informations --------------------------
    $bname = addslashes($_POST ['bname']);
    $bphone = addslashes($_POST ['bphone']);
    $bemail = addslashes($_POST ['bemail']);
    $site = addslashes($_POST ['site']);
    $information = addslashes($_POST ['information']);

    if(!isset($_FILES['logo'])){
        echo "<center>";
        echo "<font color = 'red'>";
        echo "Insert a picture";
        echo "</font>";
        echo "</center>";
      }else{
      //------- convert image to base64_encode------------------
      $image_path = $_FILES["logo"]["tmp_name"]; //this will be the physical path of your image
      if($image_path!=""){
      $img_binary = fread(fopen($image_path, "r"), filesize($image_path));
      $picture = base64_encode($img_binary);
      //-------- Insert post -----------------------------------

      $query = mysqli_query($conn, "SELECT * FROM user WHERE email ='$email'");
      $rows = mysqli_num_rows($query);
      if($rows!=1){
      $array = $query->fetch_assoc();
      mysqli_query($conn, "INSERT INTO user (id,username,email,phone,role,password,datepost) VALUES ('','$username','$email','$phone','$role','$password','$datepost')");
      mysqli_query($conn, "INSERT INTO business (id,name,phone,email,site,information,logo) VALUES ('','$bname','$bphone','$bemail','$site','$information','$picture')");
      header('location:index.php');
        }
      }
    }
    }
    }
    ?>

            <!---Form ----->

    <form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="">

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Business Name :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Business Name" name="bname">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Business telephone :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Business phone" name="bphone">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Business Email :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Business email" name="bemail">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Business website :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Business website" name="site">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Business Informations :</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="information"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="logo">Logo :</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id = "logo" name="logo" onchange="myFunction()" >
      </div>
    </div>
<hr><center>
    <p><b>Administrator Informations</b></p>

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
          <input type="hidden" value = "Administrator" name="role">
          <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password :</label>
            <div class="col-sm-10">
              <input type="password" class="form-control"  placeholder="your password" name="password">
            </div>
          </div>


      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name = "signup" class="btn btn-default">MAKE FIRST SETTINGS</button>
        </div>
      </div>
    </form>


</div>
<?php
include 'footer.php';
mysqli_close($conn);
?>
<script>
//--------Get File Size---------------
function validateForm() {
    var p = document.getElementById("logo");
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
                    var x11 = file.size;
                    var x12 = x11/1000;
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
    //document.getElementById("demo").innerHTML = txt;

  var x1 = document.forms["myForm"]["bname"].value;
  var x2 = document.forms["myForm"]["bphone"].value;
  var x3 = document.forms["myForm"]["bemail"].value;
  var x4 = document.forms["myForm"]["site"].value;
  var x5 = document.forms["myForm"]["information"].value;
  var x6 = document.forms["myForm"]["logo"].value;
  var x7 = document.forms["myForm"]["username"].value;
  var x8 = document.forms["myForm"]["email"].value;
  var x9 = document.forms["myForm"]["phone"].value;
  var x10 = document.forms["myForm"]["password"].value;


    if (x1 == "") {
        alert("Enter Business name");
        return false;
    }else if (x2 == "") {
        alert("Enter business phone");
        return false;
    }else if (x3 == "") {
        alert("Enter business email");
        return false;
    }else if (x4 == "") {
        alert("Enter business website");
        return false;
    }else if (x5 == "") {
        alert("Enter business informations");
        return false;
    }else if (x6 == "") {
        alert("Select logo");
        return false;
    }else if (x7 == "") {
        alert("Enter administrator username");
        return false;
    }else if (x8 == "") {
        alert("Enter administrator email");
        return false;
    }else if (x9 == "") {
        alert("Enter administrator phone");
        return false;
    }else if (x10 == "") {
        alert("Enter administrator password");
        return false;
    }else if (x12 >= 514) {
        alert("Logo to big to be uploaded");
        return false;
    }

}
</script>
</body>
</html>
