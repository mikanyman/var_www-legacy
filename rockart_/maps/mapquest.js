MQA.EventUtil.observe(window, 'load', function() {

  window.map = new MQA.TileMap(
    document.getElementById('map'),
    10,
    {lat:document.getElementById('N').value,
	 lng:document.getElementById('E').value}, 
    'map');
	
	MQA.withModule('zoomcontrol3', 'viewcontrol3', function() {
	
		map.addControl(
		new MQA.LargeZoomControl3(), 
		new MQA.MapCornerPlacement(MQA.MapCorner.TOP_LEFT)
		);
		
		 map.addControl(
		new MQA.ViewControl3(), 
		new MQA.MapCornerPlacement(MQA.MapCorner.TOP_RIGHT)
		);
	});
	
	var poi=new MQA.Poi({lat: document.getElementById('N').value, lng: document.getElementById('E').value});
	poi.setBias({x:50,y:-50});
	
	if(document.getElementById('nimi').innerHTML) {
		poi.setInfoTitleHTML(document.getElementById('nimi').innerHTML);
		poi.setInfoContentHTML(document.getElementById('paikkakunta').innerHTML +"<p/>"+document.getElementById('kuvaus').innerHTML);
	} else {
		poi.setInfoTitleHTML(document.getElementById('nimi').value);
		poi.setInfoContentHTML(document.getElementById('paikkakunta').value +"<p/>"+document.getElementById('kuvaus').innerHTML);
	} //if
	map.addShape(poi);


  });
  
  
