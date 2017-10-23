<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT temp,humidity,c02 FROM gas_readings ORDER BY id DESC LIMIT 1");
$data = array();
$count = 0;
foreach($stmt as $row){
echo '
<p id=tempdata style="hidden">
'.$row['temp'].'
</p>
<p id=c02data style="hidden">
'.$row['c02'].'
</p>
<p id=humiddata style="hidden">
'.$row['humidity'].'
</p>
';
}
?>
