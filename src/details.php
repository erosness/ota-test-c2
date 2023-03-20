<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Collector</title>
</head>

<body>

<?php include "inc/topnav.html" ?>

<div class="content">
  <h2>Send MQTT</h2>
<?php

require __DIR__ . '/../vendor/autoload.php';

$name = $_GET["image"];

$dir_name = "../images/". $name;


if(isset($name))
{
    echo "<table class=table>";
    echo "<tr><th style=\"width:200px\">Name</th><<th style=\"width:400px\">$name</th></tr>";
    if(file_exists($dir_name . "/meta.json") && file_exists($dir_name . "/Connected2.bin")){
        $meta_enc = file_get_contents($dir_name . "/meta.json", FALSE, NULL, 0, 50);
        $meta_dec = json_decode($meta_enc);
        $comment = $meta_dec->comment;
        $fota_content = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 0, NULL);
        $fota_size = strlen($fota_content);
        $version = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 48, 32);
        $project = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 80, 32);
        $time = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 112, 16);
        $date = file_get_contents($dir_name . "/Connected2.bin", FALSE, NULL, 128, 16);
        echo "<tr><td>Prosjekt</td><td>$project</td></tr>";
        echo "<tr><td>Version</td><td>$version</td></tr>";
        echo "<tr><td>Build date</td><td>$date</td></tr>";
        echo "<tr><td>Build time</td><td>$time</td></tr>";
        echo "<tr><td>Image size</td><td>$fota_size</td></tr>";
    }else{
        echo "<tr><td>Har ikke innhold</td><td>??</td></tr>";
    }
    echo "</table>";
}else{
    echo "<p>No image??</p>";
}


$server   = 'localhost';
$port     = 1883;
$clientId = 'test-publisher';

$mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
$mqtt->connect();
$mqtt->publish('hxfota', 'Hello? World?', 0);
$mqtt->disconnect();


?>
</div>

<?php include "inc/footer.html"  ?>

</body>
</html>
