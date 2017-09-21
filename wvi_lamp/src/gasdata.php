<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT temp,humidity FROM gas_readings ORDER BY id DESC LIMIT 1");
foreach($stmt as $row){
echo '
<p id=tempdata style="hidden">
'.$row['temp'].'
</p>
<p id=humiddata style="hidden">
'.$row['humidity'].'
</p>
';
}
?>
