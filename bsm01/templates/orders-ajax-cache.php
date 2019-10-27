<script>
	$j(function(){
		var tn = 'orders';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_ProjectID: <?php echo json_encode(array('id' => $rdata['fo_ProjectID'], 'value' => $rdata['fo_ProjectID'], 'text' => $jdata['fo_ProjectID'])); ?>,
			fo_InventoryID: <?php echo json_encode(array('id' => $rdata['fo_InventoryID'], 'value' => $rdata['fo_InventoryID'], 'text' => $jdata['fo_InventoryID'])); ?>,
			fo_ItemID: <?php echo json_encode(array('id' => $rdata['fo_ItemID'], 'value' => $rdata['fo_ItemID'], 'text' => $jdata['fo_ItemID'])); ?>,
			fo_ProductID: <?php echo json_encode($jdata['fo_ProductID']); ?>,
			fo_ShipVia: <?php echo json_encode(array('id' => $rdata['fo_ShipVia'], 'value' => $rdata['fo_ShipVia'], 'text' => $jdata['fo_ShipVia'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_ProjectID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ProjectID' && d.id == data.fo_ProjectID.id)
				return { results: [ data.fo_ProjectID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_InventoryID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_InventoryID' && d.id == data.fo_InventoryID.id)
				return { results: [ data.fo_InventoryID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ItemID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ItemID' && d.id == data.fo_ItemID.id)
				return { results: [ data.fo_ItemID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ItemID autofills */
		cache.addCheck(function(u, d){
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'fo_ItemID' && d.id == data.fo_ItemID.id){
				$j('#fo_ProductID' + d[rnd]).html(data.fo_ProductID);
				return true;
			}

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

