<?php $this->assign('title', __('Map View')) ?>
<?php $this->assign('description', __('See access points all over the city')) ?>

<div class="ips index large-9 medium-8 columns content">
    <div id="map" class="map"></div>
     <script type="text/javascript">
     	$('#map').height($(window).height() * 0.6);
	    var map = L.map('map').setView([52.411, 12.55], 14);
		    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			}).addTo(map);
		var fsControl = new L.Control.FullScreen();
		// add fullscreen control to the map
		map.addControl(fsControl);

		// detect fullscreen toggling
		map.on('enterFullscreen', function(){
			if(window.console) window.console.log('enterFullscreen');
		});
		map.on('exitFullscreen', function(){
			if(window.console) window.console.log('exitFullscreen');
		});
	<?php foreach ($ips as $ip): ?>	
		<?php if ($ip->lat && $ip->lon): ?>	
		var circle = L.circle([<?= $ip->lat ?>, <?= $ip->lon ?>], 50, {
		    color: 'red',
		    fillColor: '#f03',
		    fillOpacity: 0.5
		}).bindPopup("<?= h($ip->description) ?>").addTo(map);
		<?php endif; ?>
	<?php endforeach; ?>
    </script>
</div>

