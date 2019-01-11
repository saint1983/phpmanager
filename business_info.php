<?php
//--- Check to see if there are an administrator account------------
$queryBusiness = mysqli_query($conn, "SELECT * FROM business");
$BusinessData = mysqli_num_rows($queryBusiness);
if($BusinessData){
while($Business = mysqli_fetch_assoc($queryBusiness)) {
 $picture= $Business["logo"];
 $name = $Business["name"];
 $phone = $Business['phone'];
 $email = $Business['email'];
 $site = $Business['site'];
 $info = $Business['information'];
}
}
?>
<table class="w3-table" >
    <tr>
      <th><?php echo "<img src=data:image/jpg;base64,$picture  width = '20%' height = '20%'>";?>
        <?php
        echo "<br>";
        echo "<font size ='1'>";
        echo $info;
        echo "<br>";
        echo "Phone : ".$phone." / "."Email :".$email;;
        echo "<br>";
        echo "website :".$site;
        echo "</font>";
         ?>
      </th>
      <th>
        <?php

        echo "<b>";
        if($current_file!="index.php"){
        echo "<font size = '1'>";
        echo "Welcome : ".$UserName." the ".$UserRole;
        echo '<br>';
        echo "To day is : ".$datepost;
          echo "<br>";
        echo '<b><font color = "red">';
        echo '<a href = "index.php">';
        echo 'MENU';
        echo '</a></b>';
        echo '</font>';


        echo "</b>";
      }else{
        echo "<br>";
        echo "To day is : ".$datepost;
        echo "</b>";
      }


         ?>
      </th>

    </tr>
  </table>
