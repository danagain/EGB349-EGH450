<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=UAVDATA', 'root', 'mysql');
$stmt = $pdo->query("SELECT armed FROM uavstate ORDER BY id DESC LIMIT 1");
foreach($stmt as $row){
if($row['armed'] == 0)
{
echo '           <td class="text-left">Armed</td>
                <td class="text-left">FALSE</td>';
}
if($row['armed'] == 1)
{
echo '           <td class="text-left">Armed</td>
                <td class="text-left">TRUE</td>';
}
}
?>