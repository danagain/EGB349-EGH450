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
                <th class="text-left" colspan="2" ;>UAV Position</th>
              </tr>
            </thead>
            <tbody class="table-hover">
              <tr>
                <td class="text-left">X</td>
                <td class="text-left">1.42</td>
              </tr>
              <tr>
                <td class="text-left">Y</td>
                <td class="text-left">4.31</td>
              </tr>
              <tr>
                <td class="text-left">Z</td>
                <td class="text-left">2.66</td>
              </tr>
            </tbody>
          </table>
        </div>



        <div id="bottomtables">
          <table class="table-fill">
            <thead>
              <tr>
                <th class="text-left" colspan="1" ;>Targets</th>
                <th class="text-left" colspan="3" ;>Average Readings</th>
              </tr>
            </thead>
            <tbody class="table-hover">
              <tr>
                <td class="text-left">A</td>
                <td class="text-left">-</td>
                <td class="text-left">-</td>
                <td class="text-left">-</td>
              </tr>
              <tr>
                <td class="text-left">B</td>
                <td class="text-left" id="debug">330 ppm</td>
                <td class="text-left">22.3C</td>
                <td class="text-left">14%</td>
              </tr>
              <tr>
                <td class="text-left">C</td>
                <td class="text-left">-</td>
                <td class="text-left">-</td>
                <td class="text-left">-</td>
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
		<?php include 'uavstate.php';  ?>
                <!--<td class="text-left">Armed</td>
                <td class="text-left">TRUE</td> -->
              </tr>
              <tr>
                <td class="text-left">Flying</td>
                <td class="text-left">TRUE</td>
              </tr>
              <tr>
                <td class="text-left">Mission</td>
                <td class="text-left">DETECTION</td>
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
      //deferred onload
    var input = 20;
window.onload = function(){
 window.document.body.onload = DispGraphs();
};
</script>

<script type="text/javascript" language="javascript">

setInterval(function(){
$.getJSON("test.php", function(data){
var x = JSON.parse(data[0]);
var y = JSON.parse(data[1]);
var z = JSON.parse(data[2]);
UAVPos(x, y, z);
});
//console.log("Test");
},5000);

setInterval(function(){
$.getJSON("image_fetcher.php", function(data){
document.getElementById("mainimg").src = data;
console.log(data);

});
//console.log("Test");
},1000);

</script>
  </body>


  </html>