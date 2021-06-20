function egms_run_map() {

	var egms_map_metas = document.head.querySelectorAll('meta[plugin=egms_map]');
	var data = [];
	egms_map_metas.forEach( function(meta) {

		data[meta.name] = meta.content;
	});
	
	var location = new google.maps.LatLng(data['lat'], data['lng']);
	
	var map_options = {
		zoom: parseInt(data['zoom']),
		center: location,
		scrollwheel: (data['enablescrollwheel'] === 'true'),
		disableDefaultUI: (data['disablecontrols'] === 'true'),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	map = new google.maps.Map(document.querySelector('.egms_map'), map_options);
	var marker = new google.maps.Marker({
		position: location,
		map: map,
		icon: data['icon'],
		title: data['title'],
	});

	marker.addListener( 'click', function() {

		window.open(data['link'], '_blank');
	});
}

egms_run_map();
