<script>
	$j(function(){
		var tn = 'AccountPayables';

		/* data for selected record, or defaults if none is selected */
		var data = {
			OrderID: <?php echo json_encode(array('id' => $rdata['OrderID'], 'value' => $rdata['OrderID'], 'text' => $jdata['OrderID'])); ?>,
			fo_Vendor: <?php echo json_encode(array('id' => $rdata['fo_Vendor'], 'value' => $rdata['fo_Vendor'], 'text' => $jdata['fo_Vendor'])); ?>,
			fo_ShipVia: <?php echo json_encode(array('id' => $rdata['fo_ShipVia'], 'value' => $rdata['fo_ShipVia'], 'text' => $jdata['fo_ShipVia'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for OrderID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'OrderID' && d.id == data.OrderID.id)
				return { results: [ data.OrderID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_Vendor */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_Vendor' && d.id == data.fo_Vendor.id)
				return { results: [ data.fo_Vendor ], more: false, elapsed: 0.01 };
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

