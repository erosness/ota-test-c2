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


echo "<table class=table>";
echo "<tr><th style=\"width:200px\">Name</th><th>Comment</th><th style=\"width:100px\">App version</th><th style=\"width:100px\">Data</th><th style=\"width:100px\">Time</th> </tr>";


$name = $_GET["image"];

if(isset($name))
{
    echo "<tr><td>Har innhold</td><td>XX</td></tr>";
}

$server   = 'localhost';
$port     = 1883;
$clientId = 'test-publisher';

$mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
$mqtt->connect();
$mqtt->publish('php-mqtt/client/test', 'Hello World!', 0);
$mqtt->disconnect();
echo "</table>";

?>
</div>

<?php include "inc/footer.html"  ?>

</body>
</html>
