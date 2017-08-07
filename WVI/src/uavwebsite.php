<DOCTYPE=html></DOCTYPE>
  <html>

  <head>
    <title>UAV Website</title>
    <script type="text/javascript" src="../scripts/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyB-7M16ks9m_X8Ea2JWvYshv89l2dOxTho" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  </head>

  <body style="background-color:black;">
    <div id="OutterMostWrapper">
      <div id="ImageTable">
        <table>
          <th>
            Image Stream
          </th>
          <script>
            SampleImageTable();
          </script>
        </table>
      </div>
      <div id="wrapper">
        <div id="first">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxivY6Gn3XA5ciMou4pS88JQndyxcSgrrDOJJOuI-Y54WQQsAO_A" style="height: 100%;width: 100%;">
        </div>
        <div id="second"></div>
        <script>
          UAVPosition();
        </script>

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
                <td class="text-left">330 ppm</td>
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
                <td class="text-left">Armed</td>
                <td class="text-left">TRUE</td>
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

        <script type="text/javascript">
        var input = 20;
window.onload = function () {

//Better to construct options first and then pass it as a parameter
	var c02options = {
		title: {
			text: "C02 (PPM)"
		},
                animationEnabled: true,
		data: [
		{
			type: "column", //change it to line, area, bar, pie, etc
			dataPoints: [
      //  { y: 71, label: "Temp"},
        {label:"c02", y:71}

			]
		}
		]
	};
  var tempoptions = {
    title: {
      text: "Temp (C)"
    },
                animationEnabled: true,
    data: [
    {
      type: "column", //change it to line, area, bar, pie, etc
      dataPoints: [
        {label:"Temp", y:24}
      ]
    }
    ]
  };
  var humidityoptions = {
    title: {
      text: "Humiditiy (%)"
    },
                animationEnabled: true,
    data: [
    {
      type: "column", //change it to line, area, bar, pie, etc
      color:"red",
      dataPoints: [
        {label:"Humidity", y:55}
      ]
    }
    ]
  };

  $("#humiditygraph").CanvasJSChart(humidityoptions);
	$("#tempgraph").CanvasJSChart(tempoptions);
  $("#c02graph").CanvasJSChart(c02options);
}

</script>
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
  </body>

  </html>
