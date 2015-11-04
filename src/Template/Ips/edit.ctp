<?php $this->assign('title', __('Edit description for') . ' ' . $ip['ip']) ?>
<?php $this->assign('description', __('Maintain your account settings here.')) ?>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($ip) ?>
    <div class="form-group">
    	<?= $this->Form->input('description', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('Enter a description to identify the IP (e.g. Device name)')]); ?>
    </div>
    <div class="form-group form-inline">
    	<?= $this->Form->input('lat', ['type' => 'text', 'readonly' => 'readonly', 'class' => 'form-control col-md-4', 'div' => false, 'label' => false]); ?>
    	<?= $this->Form->input('lon', ['type' => 'text', 'readonly' => 'readonly', 'class' => 'form-control col-md-4', 'div' => false, 'label' => false]); ?>
    </div>
    <div id="map" class="map"></div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
    <script type="text/javascript">
     	$('#map').height($(window).height() * 0.4);
	    var map = L.map('map').setView([52.40, 12.55], 12);
		    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			}).addTo(map);
			<?php if ($ip->lat && $ip->lon): ?>	
				var circle = L.circle([<?= $ip->lat ?>, <?= $ip->lon ?>], 50, {
				    color: 'red',
				    fillColor: '#f03',
				    fillOpacity: 0.5
				}).bindPopup("<?= h($ip->description) ?>").addTo(map);
			<?php endif; ?>

		function onMapClick(e) {
			if (typeof circle != "undefined") {
				map.removeLayer(circle);
			}
			$('#lat').val(e.latlng.lat);
		    $('#lon').val(e.latlng.lng);
		    circle = L.circle(e.latlng, 50, {
			    color: 'red',
			    fillColor: '#f03',
			    fillOpacity: 0.5
			}).bindPopup($('#description').val()).addTo(map);
		}
		map.on('click', onMapClick);
    </script>
</div>
