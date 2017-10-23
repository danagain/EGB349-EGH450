<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT image FROM imgnames ORDER BY id DESC LIMIT 10");
$stmt->execute();
$arr = array();
foreach($stmt as $row){
$arr[] = $row['image'];
}
$sidebar = json_encode($arr);
echo $sidebar;
?>



