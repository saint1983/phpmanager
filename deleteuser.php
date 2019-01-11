<?php
  include 'config.php';
  if((!isset($_GET['id']))||trim($_GET['id'])==""){
  echo "No post like that !";
  }else{
  $user_id = addslashes($_GET['id']);
  $queryUser = mysqli_query($conn, "DELETE FROM user WHERE id = '$user_id'");
  $UserData = mysqli_num_rows($queryUser);
  echo '<script language="Javascript">';
  echo 'document.location.replace("./manageuser.php")'; // -->
  echo ' </script>';
 }

?>
