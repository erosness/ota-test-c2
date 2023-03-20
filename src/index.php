<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Connect2 OTA</title>
</head>

<body>

<?php include "inc/topnav.html" ?>

<div class="content">
  <h2>Connect2 OTA Home</h2>
  <p>Test server for OTA-tesing.</p>
  <p>Click on image name for details.</p>
<?php

  echo "<table class=table>";
  echo "<tr><th style=\"width:200px\">Name</th><th>Comment</th><th style=\"width:100px\">App version</th><th style=\"width:200px\">Data</th><th style=\"width:100px\">Time</th> </tr>";

  $idirs = glob("../images/*");

  print($idirs);

  foreach($idirs as $dir_name){
    if(is_dir($dir_name)){
      $name = basename($dir_name);
      $comment = "no comment found";
      if(file_exists($dir_name . "/meta.json")){
        $meta_enc = file_get_contents($dir_name . "/meta.json", FALSE, NULL, 0, 50);
        $meta_dec = json_decode($meta_enc);
        $comment = $meta_dec->comment;
      }

      $image_version = "NO VERSION";
      $image_time = "0";
      if(file_exists($dir_name . "/Connected2.bin")){
        $image = file($dir_name . "/Connected2.bin");
        $image_version = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 48, 16);
        $image_date = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 128, 16);
        $image_time = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 112, 16);
      }

      echo "<tr>";
      echo "<td><a href=details.php?image=" . $name . ">" . $name . "</a></td>";
      echo "<td>$comment</td>";
      echo "<td>$image_version</td>";
      echo "<td>$image_date</td>";
      echo "<td>$image_time</td>";
      echo "</tr>";
    }
  }

  echo "</table>";

?>

</div>

<?php include "inc/footer.html"  ?>

</body>
</html>
