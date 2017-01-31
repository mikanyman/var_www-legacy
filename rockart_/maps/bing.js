 function GetMap() {  

		var map = new Microsoft.Maps.Map(document.getElementById("myMap"), 
                           {credentials: "ApnSOwSMus3KAauozYJ2THmtVFDZymS9ILpGPG_wwXvG7Y-TcqjsPcQogTBDxywz",
                            center: new Microsoft.Maps.Location(document.getElementById("N").value, document.getElementById("E").value),
                            mapTypeId: Microsoft.Maps.MapTypeId.road,
                            zoom: 12
							});
							
		 // Retrieve the location of the map center 
            var center = map.getCenter();

		// Add a pin to the center of the map
        var pin = new Microsoft.Maps.Pushpin(center);
		
		// Attach event handlers
		Microsoft.Maps.Events.addHandler(pin, 'mouseover', SetInfoBox);
		Microsoft.Maps.Events.addHandler(pin, 'mouseout', RemoveInfoBox);
		
        map.entities.push(pin);	

		// Create an infobox for a pushpin
			function SetInfoBox(pin) 
			{
			// Calculate the pixel position of this pushpin relative to the map control
			var pointLocation = map.tryLocationToPixel(
			  pin.target.getLocation(),
			  Microsoft.Maps.PixelReference.control
			  );
			  
			// Create a new div
			var infodiv = document.createElement("div");
			infodiv.id = "infodiv";
			infodiv.className = "infobox";
			
			// Place the infobox at the correct pixel coordinates
			infodiv.style.left = (pointLocation.x + 12) + "px";
			infodiv.style.top = (pointLocation.y - 100) + "px";
			
			if(document.getElementById('nimi').innerHTML) {
				infodiv.innerHTML =  "<b>"+ document.getElementById('nimi').innerHTML + "</b> <p/>" +
				  document.getElementById('paikkakunta').innerHTML + "<p/>" +
				  document.getElementById('kuvaus').innerHTML;
			} else {
				infodiv.innerHTML =  "<b>"+ document.getElementById('nimi').value + "</b> <p/>" +
				  document.getElementById('paikkakunta').value + "<p/>" +
				  document.getElementById('kuvaus').innerHTML;
			}
			 	
			// Add the infobox div as a child to the map
			var mapdiv = document.getElementById('myMap');
			mapdiv.appendChild(infodiv);
				
			}
			
			// Remove the infobox for a pushpin
			function RemoveInfoBox(pin) {
			var mapdiv = document.getElementById('myMap');
			var infodiv = document.getElementById('infodiv');
				if (infodiv != null) { mapdiv.removeChild(infodiv); }
			} 
	
			
	}
	
	
          



