<?php 
$x =  Array();
$y = Array();
$z = Array();
$all = Array();
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT x,y,z FROM uavloc");
$stmt->execute();
foreach($stmt as $row => $val){
$x[] = $val['x'];
$xjson = json_encode($x);
$y[] = $val['y'];
$yjson = json_encode($y);
$z[] = $val['z'];
$zjson = json_encode($z);
}
$all[0] = $xjson;
$all[1] = $yjson;
$all[2] = $zjson; 
$allj = json_encode($all);
echo $allj;

//echo 'UAVPos('.$xjson.','.$yjson.','.$zjson.')';
//print_r($xjson);?>
