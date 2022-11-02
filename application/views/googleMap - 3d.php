<html>
<head>
<meta charset="utf-8">
<title>Display buildings in 3D</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<div id="map"></div>
<script>
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	mapboxgl.accessToken =  'pk.eyJ1IjoibXViYXNoaXJnaXMiLCJhIjoiY2tpZWNpbTU3MXJwczJ5bnh4MDI1ZW9mNyJ9.iBdeAqhocxhiDp1ClwUzhw';
const map = new mapboxgl.Map({
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
style: 'http://localhost/mapartproject/styles/monochrome-sky-style.json',
center: [-74.0066, 40.7135],
zoom: 15.5,
pitch: 45,
bearing: -17.6,
container: 'map',
antialias: true
});
 
map.on('load', () => {
// Insert the layer beneath any symbol layer.
const layers = map.getStyle().layers;
const labelLayerId = layers.find(
(layer) => layer.type === 'symbol' && layer.layout['text-field']
).id;
 
// The 'building' layer in the Mapbox Streets
// vector tileset contains building height data
// from OpenStreetMap.
map.addLayer(
{
'id': 'add-3d-buildings',
'source': 'composite',
'source-layer': 'building',
'filter': ['==', 'extrude', 'true'],
'type': 'fill-extrusion',
'minzoom': 15,
'paint': {
'fill-extrusion-color': '#aaa',
 
// Use an 'interpolate' expression to
// add a smooth transition effect to
// the buildings as the user zooms in.
'fill-extrusion-height': [
'interpolate',
['linear'],
['zoom'],
15,
0,
15.05,
['get', 'height']
],
'fill-extrusion-base': [
'interpolate',
['linear'],
['zoom'],
15,
0,
15.05,
['get', 'min_height']
],
'fill-extrusion-opacity': 0.6
}
},
labelLayerId
);
});
</script>
 
</body>
</html>