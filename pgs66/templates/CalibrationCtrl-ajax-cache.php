<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'CalibrationCtrl';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_InventoryID: <?php echo json_encode(array('id' => $rdata['fo_InventoryID'], 'value' => $rdata['fo_InventoryID'], 'text' => $jdata['fo_InventoryID'])); ?>,
			fo_CalCom: <?php echo json_encode(array('id' => $rdata['fo_CalCom'], 'value' => $rdata['fo_CalCom'], 'text' => $jdata['fo_CalCom'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_InventoryID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_InventoryID' && d.id == data.fo_InventoryID.id)
				return { results: [ data.fo_InventoryID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_CalCom */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_CalCom' && d.id == data.fo_CalCom.id)
				return { results: [ data.fo_CalCom ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

