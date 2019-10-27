<script>
	$j(function(){
		var tn = 'ContractDeployment';

		/* data for selected record, or defaults if none is selected */
		var data = {
			InquiryID: <?php echo json_encode(array('id' => $rdata['InquiryID'], 'value' => $rdata['InquiryID'], 'text' => $jdata['InquiryID'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for InquiryID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'InquiryID' && d.id == data.InquiryID.id)
				return { results: [ data.InquiryID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

