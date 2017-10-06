<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT image FROM imgnames ORDER BY id DESC LIMIT 10");
$stmt->execute();
foreach($stmt as $row){
echo'<tr><td style="width:30px; height:100px; bgcolor=blue" > <img src="/images/'.$row['image'].'"name="/images/'.$row['image'] .'" onclick="swap(this)" style="height:100%;width: 100%";>  </td></tr>';
//print_r($file);
}
?>
