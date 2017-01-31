function initialize() {

    var myLatlng = new google.maps.LatLng(63.23243818380735, 26.730752783981007);
    var myOptions = {
      zoom: 6,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    downloadUrl("../user/coords.php", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
        var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: markers[i].getAttribute('nimi'),
			});
			
		var infowindow = new google.maps.InfoWindow();
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(
				  "<a href=../user/list.php?value="+markers[i].getAttribute('id')+"><b>"
				  +markers[i].getAttribute('nimi')+"</b></a><p/>"
				  +markers[i].getAttribute("paikkakunta")+"<p/>"
				  +markers[i].getAttribute("kuvaus"));
          infowindow.open(map, marker);
        }
      })(marker, i));

       }
     });
  }

   
 google.maps.event.addDomListener(window, 'load', initialize);