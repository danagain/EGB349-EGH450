<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
//$stmt = $pdo->query("SELECT temp,humidity,c02 FROM gas_readings ORDER BY id DESC LIMIT 1");
$stmt = $pdo->query("SELECT temp,humidity FROM gas_readings ORDER BY id DESC LIMIT 1");
$data = array();
foreach($stmt as $row){
$data[0] = $row['temp'];
$data[1] = $row['humidity'];
#$data[2] = $row['c02'];
}
$datajson = json_encode($data);
echo $datajson;
?>
