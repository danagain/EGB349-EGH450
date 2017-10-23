<DOCTYPE=html></DOCTYPE>
  <html>

  <head>
    <title>UAV Website</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="../scripts/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<!-- Plotly.js -->
   <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

  </head>

  <body style="background-color:black;">
    <div id="OutterMostWrapper">
      <div id="ImageTable">
        <table>
          <th>
            Image Stream
          </th>
         <!-- <script>
            SampleImageTable();
          </script> -->
	<?php include 'sidebarimage.php'; ?>
        </table>
      </div>
	<div id="wrapper">
	<div id="first">
	<img id="mainimg" src="" style="height:100%;width: 100%";>
	</div>
        <div id="second" style="margin-left:620px"></div>

	

        <div id="bottomtables">
          <table class="table-fill">
            <thead>
              <tr>
                <th class="text-left" colspan="2" ;>Current Position</th>
                <th class="text-left" colspan="1" ;>Current Goal</th>
              </tr>
            </thead>
            <tbody class="table-hover">
              <tr>
                <td class="text-left">X</td>
                <td class="text-left" ><p id="uavx">0.0</p></td>
                <td class="text-left"><p id="goalx">0.0</p></td>
              </tr>
              <tr>
                <td class="text-left">Y</td>
                <td class="text-left" ><p id="uavy">0.0</p></td>
                <td class="text-left"><p id="goaly">0.0</p></td>
              </tr>
              <tr>
                <td class="text-left">Z</td>
                <td class="text-left"><p id="uavz">0.0</p></td>
                <td class="text-left"><p id="goalz">0.0</p></td>
              </tr>
            </tbody>
          </table>
        </div>



        <div id="bottomtables">
          <table class="table-fill">
            <thead>
              <tr>
                <th class="text-left" colspan="2" ;>Orientation</th>
              </tr>
            </thead>
            <tbody class="table-hover">
              <tr>
                <td class="text-left">Roll</td>
                <td class="text-left"><p id="roll">0.0</p></td>

              </tr>
              <tr>
                <td class="text-left">Pitch</td>
                <td class="text-left" ><p id="pitch">0.0</p></td>

              </tr>
              <tr>
                <td class="text-left">Yaw</td>
                <td class="text-left"><p id="yaw">0.0</p></td>

              </tr>
            </tbody>
          </table>
        </div>

        <div id="bottomtables">
          <table class="table-fill">
            <thead>
              <tr>
                <th class="text-left" colspan="2" ;>UAV State</th>
              </tr>
            </thead>
            <tbody class="table-hover">
              <tr>
		<!--<?php include 'uavstate.php';  ?>-->
                <td class="text-left">Armed</td>
                <td class="text-left"><p id="armed">FALSE</p></td>
              </tr>
              <tr>
                <td class="text-left">Flying</td>
                <td class="text-left"><p id="flying">FALSE</p></td>
              </tr>
              <tr>
                <td class="text-left">Mission</td>
                <td class="text-left"><p id="mission">NONE</p></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="graphbox">
          <div id="c02graph">
          </div>
          <div id="tempgraph">
          </div>
          <div id="humiditygraph">
          </div>
        </div>
      </div>
    </div>
    <?php include 'gasdata.php'; ?>
    <script type="text/javascript">
$.ajaxSetup({ cache: false});
      //deferred onload
    var input = 20;
//window.onload = function(){
 //window.document.body.onload = DispGraphsAuto();
//};
</script>

<script type="text/javascript" language="javascript">
$.ajaxSetup({ cache: false});
setInterval(function(){
$.getJSON("xyz_auto.php", function(data){
var x = JSON.parse(data[0]);
var y = JSON.parse(data[1]);
var z = JSON.parse(data[2]);
var arm = JSON.parse(data[3]);
var roll = JSON.parse(data[5]);
var pitch = JSON.parse(data[6]);
var yaw =      JSON.parse(data[7]);
//var goalx = JSON.parse(data[8]);

//var goaly = JSON.parse(data[9]);
//var goalz = JSON.parse(data[10]);

//console.log("%s           %s      %s", roll, pitch, yaw);

document.getElementById("mainimg").src = JSON.parse(data[4]);
//console.log("testing data 4 is working %s", JSON.parse(data[5]));
if(arm == 0){
document.getElementById("armed").innerHTML = "FALSE";}else{document.getElementById("armed").innerHTML = "TRUE";}
document.getElementById("uavx").innerHTML = x[0];
document.getElementById("uavy").innerHTML = y[0];
document.getElementById("uavz").innerHTML = z[0];

//document.getElementById("goalx").innerHTML  =  goalx;
//document.getElementById("goaly").innerHTML  =  goaly;
//document.getElementById("goalz").innerHTML  = goalz;

document.getElementById("roll").innerHTML = roll;
document.getElementById("pitch").innerHTML = pitch;
document.getElementById("yaw").innerHTML = yaw;
if(z[0] > 0.3 && document.getElementById("armed").innerHTML == "TRUE"){
//if the z position of the drone is 300 mm of the ground aned the drone is armed then it is flying
document.getElementById("flying").innerHTML == "TRUE";
//document.getElementById("detection").innerHTML == "DETECTION";
}else{
document.getElementById("flying").innerHTML == "FALSE";
}
UAVPos(x, y, z);
//DispGraphsauto(parseInt(JSON.parse(data[5])), parseInt(JSON.parse(data[6])));
});
//console.log("Test");
},5000);


setInterval(function(){
$.getJSON("gas_auto.php", function(data){
console.log(data);
DispGraphsauto(parseInt(JSON.parse(data[0])), parseInt(JSON.parse(data[1])), 400);
});
},8000);

setInterval(function(){
$.getJSON("sidebarauto.php", function(data){
for (i = 0; i < 10; i++) { 
   image = "image"+i.toString();
	//console.log(image);
   document.getElementById(image.toString()).src = "../../../images/"+data[i];
document.getElementById(image.toString()).name = data[i];
}
});
},4000);
</script>
  </body>


  </html>
