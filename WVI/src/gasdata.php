<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT temp,humidity FROM gas_readings WHERE id = MAX(id)");
foreach($stmt as $row){
echo '
<p id=tempdata>
'.$row['review'].'
</p>
<p id=humiddata>
'.$row['rating'].'
</p>
';
}
?>
