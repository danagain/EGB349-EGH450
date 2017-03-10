

<!DOCTYPE HTML>
<html>
   <head>
      <title>UAV Feedback</title>
   </head>
   <body>
      <h1>UAV DATA LOOP</h1>
      <br/>
      <img src="http://media-us-west-motionelements.s3.amazonaws.com/m/s/1243/9233082/a-0096.jpg" alt="Current POV"/>
      <p>Connecting to database </p>
      <?php
         $link = new PDO('mysql: host= localhost; dbname=uavdata','root', 'eonvulsc1');
         if(!$link){
         	die('could not connect: ' . mysql_erro());
         	  }
         	echo 'Connected successfully';
         ?>
      <p> Current c02 reading: </p>
      <?php	
         $c02reading = $link->query('select * from co2');
         while ($row = $c02reading->fetch(PDO::FETCH_ASSOC)){
         printf("%s", $row["sample"]);
         }
         ?>
   </body>
</html>


