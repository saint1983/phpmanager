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


<body onchange="myFunction()">
<<?php

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

    $post_id = addslashes($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM userpost WHERE id = '$post_id'");
    $rows = mysqli_num_rows($result);

      if($rows){
        while($post = mysqli_fetch_assoc($result)) {
      $post_id= $post["id"];
       $picture= $post["picture"];
       $type = $post["type"];
       $title = $post['title'];
       $description = $post['description'];
       $datepost = $post['datepost'];

  ?>
  <font color = "red"><p id="demo"></p></font>
    <form class="form-horizontal" method = "POST" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data" action="updateDelete.php">
<input type="hidden" class="form-control" value ='<?php echo $post_id; ?>' placeholder="Title" name="post_id">

    <div class="form-group">
        <label class="control-label col-sm-2" for="type">Type :</label>
        <div class="col-sm-10">
          <select  class="form-control"  name="type">
            <option value = "<?php echo $type; ?>"><?php echo $type; ?></option>
            <option value = "">Select a type</option>
            <option value = "In mind">In mind</option>
            <option value = "Business">Business</option>
            <option value = "Politic">Politic</option>
            <option value = "Entertaiment">Entertaiment</option>
            <option value = "Event">Event</option>
            <option value = "Dating">Dating</option>
            <option value = "Accommodation">Accommodation</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="title">Title :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value = "<?php echo $title; ?>" placeholder="Title" name="title">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="description">Description :</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description"><?php echo $description; ?></textarea>
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
      <button type="submit" name = "delete" class="btn btn-default">Delete</button>
      </div>
      </div>
      </form>

  <?php
    }
  }
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
