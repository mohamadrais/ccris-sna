<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'employees';

		/* data for selected record, or defaults if none is selected */
		var data = {
			memberID: <?php echo json_encode(array('id' => $rdata['memberID'], 'value' => $rdata['memberID'], 'text' => $jdata['memberID'])); ?>,
			BaseLocation: <?php echo json_encode(array('id' => $rdata['BaseLocation'], 'value' => $rdata['BaseLocation'], 'text' => $jdata['BaseLocation'])); ?>,
			fo_ReportsTo: <?php echo json_encode(array('id' => $rdata['fo_ReportsTo'], 'value' => $rdata['fo_ReportsTo'], 'text' => $jdata['fo_ReportsTo'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for memberID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'memberID' && d.id == data.memberID.id)
				return { results: [ data.memberID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for BaseLocation */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'BaseLocation' && d.id == data.BaseLocation.id)
				return { results: [ data.BaseLocation ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ReportsTo */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ReportsTo' && d.id == data.fo_ReportsTo.id)
				return { results: [ data.fo_ReportsTo ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

