<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'StakeholderSatisfaction';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_ProjectId: <?php echo json_encode(array('id' => $rdata['fo_ProjectId'], 'value' => $rdata['fo_ProjectId'], 'text' => $jdata['fo_ProjectId'])); ?>,
			fo_Recources: <?php echo json_encode(array('id' => $rdata['fo_Recources'], 'value' => $rdata['fo_Recources'], 'text' => $jdata['fo_Recources'])); ?>,
			fo_ClientID: <?php echo json_encode(array('id' => $rdata['fo_ClientID'], 'value' => $rdata['fo_ClientID'], 'text' => $jdata['fo_ClientID'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_ProjectId */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ProjectId' && d.id == data.fo_ProjectId.id)
				return { results: [ data.fo_ProjectId ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_Recources */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_Recources' && d.id == data.fo_Recources.id)
				return { results: [ data.fo_Recources ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ClientID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ClientID' && d.id == data.fo_ClientID.id)
				return { results: [ data.fo_ClientID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

