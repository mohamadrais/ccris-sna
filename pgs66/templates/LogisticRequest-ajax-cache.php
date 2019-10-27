<script>
	$j(function(){
		var tn = 'LogisticRequest';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_ResourcesID: <?php echo json_encode(array('id' => $rdata['fo_ResourcesID'], 'value' => $rdata['fo_ResourcesID'], 'text' => $jdata['fo_ResourcesID'])); ?>,
			fo_ProjectID: <?php echo json_encode(array('id' => $rdata['fo_ProjectID'], 'value' => $rdata['fo_ProjectID'], 'text' => $jdata['fo_ProjectID'])); ?>,
			fo_ShipVia: <?php echo json_encode(array('id' => $rdata['fo_ShipVia'], 'value' => $rdata['fo_ShipVia'], 'text' => $jdata['fo_ShipVia'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_ResourcesID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ResourcesID' && d.id == data.fo_ResourcesID.id)
				return { results: [ data.fo_ResourcesID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ProjectID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ProjectID' && d.id == data.fo_ProjectID.id)
				return { results: [ data.fo_ProjectID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ShipVia */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ShipVia' && d.id == data.fo_ShipVia.id)
				return { results: [ data.fo_ShipVia ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

