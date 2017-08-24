function TestFunc(){
  alert("Change POV image");
}

function SampleImageTable(){
  for (var i = 0; i < 20; i++) {
    document.write("<tr><td style='width:30px; height:100px;' bgcolor='blue' onclick='TestFunc()'> IMAGE IMAGE IMAGE  </td></tr>");
    document.write("<tr><td style='width:30px; height:100px;' onclick='TestFunc()'>  IMAGE IMAGE IMAGE </td></tr>");
  }
}

function UAVPosition() {
    var locations = ["-27.470125", "153.021072", "QUT", "UAV"];
    var map = new google.maps.Map(document.getElementById('second'), {
        zoom: 10,
        center: new google.maps.LatLng(parseFloat(locations[0]), parseFloat(locations[1])),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(locations[0]), parseFloat(locations[1])),
        map: map
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent('<p> Aircraft: ' + locations[3] + '</p>' + '<p> Location: ' + locations[2] + '</p>');
            infowindow.open(map, marker);
        }
    })(marker, i));
}

function UAVPos(){
  Plotly.d3.csv('https://raw.githubusercontent.com/plotly/datasets/master/_3d-line-plot.csv', function(err, rows){
      function unpack(rows, key) {
          return rows.map(function(row)
          { return row[key]; });
      }
var trace1 = {
  x: unpack(rows, 'x1'),
  y: unpack(rows, 'y1'),
  z: unpack(rows, 'z1'),
  mode: 'lines',
  marker: {
    color: '#1f77b4',
    size: 12,
    symbol: 'circle',
    line: {
      color: 'rgb(0,0,0)',
      width: 0
    }
  },
  line: {
    color: '#1f77b4',
    width: 1
  },
  type: 'scatter3d'
};
var trace2 = {
  x: unpack(rows, 'x2'),
  y: unpack(rows, 'y2'),
  z: unpack(rows, 'z2'),
  mode: 'lines',
  marker: {
    color: '#9467bd',
    size: 12,
    symbol: 'circle',
    line: {
      color: 'rgb(0,0,0)',
      width: 0
    }
  },
  line: {
    color: 'rgb(44, 160, 44)',
    width: 1
  },
  type: 'scatter3d'
};
var trace3 = {
  x: unpack(rows, 'x3'),
  y: unpack(rows, 'y3'),
  z: unpack(rows, 'z3'),
  mode: 'lines',
  marker: {
    color: '#bcbd22',
    size: 12,
    symbol: 'circle',
    line: {
      color: 'rgb(0,0,0)',
      width: 0
    }
  },
  line: {
    color: '#bcbd22',
    width: 1
  },
  type: 'scatter3d'
};
var data = [trace1, trace2, trace3];
var layout = {
  title: '3D Line Plot',
  autosize: false,
  width: 500,
  height: 500,
  margin: {
    l: 0,
    r: 0,
    b: 0,
    t: 65
  }
};
Plotly.newPlot('second', data, layout); 
});
}


function DispGraphs(){
var humidity  = document.getElementById("humiddata");
var temp= document.getElementById("tempdata");
var tempdata = temp.innerHTML;
var  humiditydata = humidity.innerHTML;
console.log(humiditydata);
var colorHumid = "";
var colorTemp = "";
if(parseInt(document.getElementById('humiddata').innerHTML) < 300){
colorHumid = "green";
}else{
colorHumid = "red";
}
if(parseInt(document.getElementById('tempdata').innerHTML) <= 5){
colorTemp = "green";
}else{
colorTemp = "red";
}

//Better to construct options first and then pass it as a parameter
var c02options = {
title: {
  text: "C02 (PPM)"
},
            animationEnabled: true,
data: [
{
  type: "column", //change it to line, area, bar, pie, etc
  color: "green",
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
  color: colorTemp,
  dataPoints: [
    {label:"Temp", y: parseInt(document.getElementById('tempdata').innerHTML)}
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
  color: colorHumid,
  dataPoints: [
    {label:"Humidity", y: parseInt(document.getElementById('humiddata').innerHTML)}
  ]
}
]
};

$("#humiditygraph").CanvasJSChart(humidityoptions);
$("#tempgraph").CanvasJSChart(tempoptions);
$("#c02graph").CanvasJSChart(c02options);
};
