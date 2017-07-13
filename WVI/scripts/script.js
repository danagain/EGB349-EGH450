
function SampleImageTable(){
  for (var i = 0; i < 20; i++) {
    document.write("<tr><td bgcolor='blue'> IMAGE IMAGE IMAGE  </td></tr>");
    document.write("<tr><td> IMAGE IMAGE IMAGE </td></tr>");
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
