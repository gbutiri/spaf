<?php include ($_SERVER['DOCUMENT_ROOT'] . '/config.php'); ?>
<?php include (_DOCROOT . '/htmls/header.php'); ?>

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="/js/markerclusterer_packed.js"></script>
<script type="text/javascript">
	function initialize() {

		var markers = [];
		var data = <?php echo getMapData(); ?>;
		
		// console.log(data);
		var _lat_sum = 0;
		var _lng_sum = 0;
		var _lat_size = 0;
		var _lng_size = 0;
		for (_dot in data.stores) {
			_lat_sum += data.stores[_dot].latitude;
			_lng_sum += data.stores[_dot].longitude;
			_lat_size ++;
			_lng_size ++;
			//console.log(data.stores[_dot].latitude);
			//console.log(data.stores[_dot].longitude);
		}
		
		//console.log(_lat_sum / _lat_size);
		//console.log(_lng_sum / _lng_size);
		var center = new google.maps.LatLng(_lat_sum / _lat_size, _lng_sum / _lng_size);
		
		
		
		var infoWindow = new google.maps.InfoWindow();

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 4,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		// console.log(data);
		
		for (store in data.stores) {
			//console.log(data.stores[store]);
			var dataStores = data.stores[store];
			//var dataStores = data.stores[i];
			var latLng = new google.maps.LatLng(dataStores.latitude,dataStores.longitude);
			var markerContent = '<h3>'+dataStores.title+' - '+dataStores.dtm+'</h3>'
								+'<p>'+dataStores.descr+'</p>'
								;
			var marker = new google.maps.Marker({
				position: latLng,
				html: markerContent,
			});


			google.maps.event.addListener(marker, 'click', function () {
				//console.log(marker,dataStores);
				infoWindow.setContent(this.html);
				infoWindow.open(map, this);
			});
			
			
			markers.push(marker);
			
		}
		
		/*
		for (var i = 0; i < data.count; i++) {

		};
		*/
		
		
		var mcOptions = {"zoomOnClick":false};
		var markerCluster = new MarkerClusterer(map, markers, mcOptions);
		
		google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
			var cMarkers = cluster.getMarkers();
			
			var clusterHtml = "";
			//console.log(google.maps);
			for (var iM = 0; iM < cMarkers.length; iM++) {
				//console.log(cMarkers[iM].html);
				clusterHtml += "<p>"+cMarkers[iM].html+"</p>";
			}
			var info = new google.maps.MVCObject;
			info.set('position', cluster.center_);
			//console.log(clusterHtml);
			infoWindow.close();
			infoWindow.setContent(clusterHtml);
			infoWindow.open(map,info);
			
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>	
<div id="map-container"><div id="map"></div></div>



<?php 
function getMapData() {
	
	/*
	array_push($retStores, array(
		'title' => $title,
		'descr' => $descr,
		'dtm' => date("m/d/Y",strtotime($dtm)),
		'id' => $id,
		'location' => $location,
		'country' => $country,
		'latitude' => $lat,
		'longitude' => $long
	));
	*/
	$retStores = array(
		array(
			'title' => 'Test 1 Title',
			'descr' => 'Test one description',
			'latitude' => 0,
			'longitude' => 0,
		),
		array(
			'title' => 'Test 2 Title',
			'descr' => 'Test two description',
			'latitude' => 10.56,
			'longitude' => 30.012,
		),
		array(
			'title' => 'Test 3 Title',
			'descr' => 'Test three description',
			'latitude' => 40,
			'longitude' => 36.4739,
		),
		array(
			'title' => 'Test 4 Title',
			'descr' => 'Test four description',
			'latitude' => 39,
			'longitude' => 31.5,
		),
	);
		
	$retData = array('count' => 0, 'stores' => $retStores);

	echo json_encode($retData);
}
?>
<?php include (_DOCROOT . '/htmls/footer.php'); ?>
