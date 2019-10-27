<script>
	$j(function(){
		var tn = 'DrillNInspection';

		/* data for selected record, or defaults if none is selected */
		var data = {
			ccpID: <?php echo json_encode(array('id' => $rdata['ccpID'], 'value' => $rdata['ccpID'], 'text' => $jdata['ccpID'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for ccpID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ccpID' && d.id == data.ccpID.id)
				return { results: [ data.ccpID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

