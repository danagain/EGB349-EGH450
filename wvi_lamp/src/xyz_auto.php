<?php 
$x =  Array();
$y = Array();
$z = Array();
$all = Array();
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT x,y,z FROM uavloc ORDER BY id DESC LIMIT 100000");
$stmt->execute();
foreach($stmt as $row => $val){
$x[] = $val['x'];

$y[] = $val['y'];

$z[] = $val['z'];

}
//moved xyzjson out of foreach
$xjson = json_encode($x);
$yjson = json_encode($y);
$zjson = json_encode($z);
$all[0] = $xjson;
$all[1] = $yjson;
$all[2] = $zjson; 




$stmt = $pdo->query("SELECT armed FROM uavstate ORDER BY id DESC LIMIT 1");
$stmt->execute();
//$arm = Array();
foreach($stmt as $row => $val){
$arm = $val['armed'];
}
$armjson = json_encode($arm);
$all[3] = $armjson;

$stmt = $pdo->query("SELECT image FROM imgnames ORDER BY id DESC LIMIT 1");
$stmt->execute();
foreach($stmt as $row){
$fullimg = '../../../images/'. $row['image'];
$img = json_encode($fullimg);
$all[4] = $img;
}

$stmt = $pdo->query("SELECT x,y,z FROM uavgoal ORDER BY id DESC LIMIT 1");
$stmt->execute();
foreach($stmt as $row){
$x =  $row['x'];
$y =  $row['y'];
$z =  $row['z'];
$xj = json_encode($x);
$yj = json_encode($y);
$zj = json_encode($z);
$all[8] = json_encode($xj);
$all[9] = json_encode($yj);
$all[10] = json_encode($zj);
}
/*$stmt = $pdo->query("SELECT temp,humidity FROM gas_readings ORDER BY id DESC LIMIT 1");
foreach($stmt as $row){
$temp = $row['temp'];
$tempj = json_encode($temp);
$all[5] = $tempj;
$hum = $row['humidity'];
$humj = json_encode($hum);
$all[6] = $humj;
}*/

$stmt = $pdo->query("SELECT roll,pitch,yaw FROM uavloc ORDER BY id DESC LIMIT 1");
$stmt->execute();
//$arm = Array();
foreach($stmt as $row => $val){
$roll = $val['roll'];
$all[5] = json_encode($roll);
$pitch = $val['pitch'];
$all[6] = json_encode($pitch);
$yaw = $val['yaw'];
$all[7] = json_encode($yaw);
}


$allj = json_encode($all);
echo $allj;

//echo 'UAVPos('.$xjson.','.$yjson.','.$zjson.')';
//print_r($xjson);?>
