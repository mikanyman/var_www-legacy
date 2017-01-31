var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(results) {
    if (results && results.length > 0) {
      updateMarkerAddress(results[0].formatted_address);
    } else {
      updateMarkerAddress('Osoitetta ei voi m‰‰ritell‰.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

// Muuttuvat koordinaatit
function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = latLng.lat()+", "+latLng.lng();
 
		document.getElementById('lat').value = latLng.lat();
		document.getElementById('lng').value = latLng.lng();

}
function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

// Asetetaan kartan keskipisteeksi maalauksen sijainti
function initialize() {
	
	// Jos tietokannasta lˆytyy lat & lng, k‰ytet‰‰n niit‰,
	// muuten kartan keskipiste Paikkakunta-kent‰n arvo
	if (document.getElementById('lat').value && document.getElementById('lng').value) {
		var lat = document.getElementById('lat').value;
		var lng = document.getElementById('lng').value;
	} else {
        var lat = document.getElementById('N').value;
		var lng = document.getElementById('E').value;
	} //if 
		
		var latLng = new google.maps.LatLng(lat,lng);
		
		var map = new google.maps.Map(document.getElementById('mapCanvas'), {
		zoom: 12,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
		});
  
		var marker = new google.maps.Marker({
		position: latLng,
		title: document.getElementById('nimi').innerHTML,
		map: map,
		draggable: true
	  });
	  
	  if (document.getElementById('nimi').innerHTML) {
				var infowindow = new google.maps.InfoWindow({
				 content:
				 "<b>"+ document.getElementById('nimi').innerHTML + "</b> <p/>" +
				  document.getElementById('paikkakunta').innerHTML + "<p/>" +
				  document.getElementById('kuvaus').innerHTML
				  });
	} else {	
				var infowindow = new google.maps.InfoWindow({
				  content:
				   "<b>"+ document.getElementById('nimi').value + "</b> <p/>" +
				  document.getElementById('paikkakunta').value + "<p/>" +
				  document.getElementById('kuvaus').innerHTML
				  });
	} //if
 

	  google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });


	  
  
	// P‰ivitet‰‰n sijainti
		updateMarkerPosition(latLng);
		geocodePosition(latLng);
  
   // Lis‰t‰‰n liikutuksen "event listener":it
		google.maps.event.addListener(marker, 'dragstart', function() {
		updateMarkerAddress('Liikutetaan...');
		});
  
	  google.maps.event.addListener(marker, 'drag', function() {
		updateMarkerStatus('Liikutetaan...');
		updateMarkerPosition(marker.getPosition());
	  });
	  
	  google.maps.event.addListener(marker, 'dragend', function() {
		updateMarkerStatus('Pys‰ytetty');
		geocodePosition(marker.getPosition());
	  }); 
  

	
} //initialize()

// N‰ytet‰‰n sovellus sivun latautuessa
google.maps.event.addDomListener(window, 'load', initialize);
