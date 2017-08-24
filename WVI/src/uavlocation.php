<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');


$stmt = $pdo->prepare('TRUNCATE TABLE uavloc');

$stmt->execute();

for($x = 0; $x <= 100; $x++){
$stmt = $pdo->prepare('INSERT INTO uavloc (x, y, z) VALUES (:x, :y, :z)');
$stmt->bindValue(':x', $x, PDO::PARAM_INT);
$stmt->bindValue(':y', $x, PDO::PARAM_INT);
$stmt->bindValue(':z', $x, PDO::PARAM_INT);
$stmt->execute();
}
?>
