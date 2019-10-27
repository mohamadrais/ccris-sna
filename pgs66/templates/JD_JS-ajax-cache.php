<script>
	$j(function(){
		var tn = 'JD_JS';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_EmployeeID: <?php echo json_encode(array('id' => $rdata['fo_EmployeeID'], 'value' => $rdata['fo_EmployeeID'], 'text' => $jdata['fo_EmployeeID'])); ?>,
			fo_ProjectTeamID: <?php echo json_encode(array('id' => $rdata['fo_ProjectTeamID'], 'value' => $rdata['fo_ProjectTeamID'], 'text' => $jdata['fo_ProjectTeamID'])); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_EmployeeID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_EmployeeID' && d.id == data.fo_EmployeeID.id)
				return { results: [ data.fo_EmployeeID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_ProjectTeamID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_ProjectTeamID' && d.id == data.fo_ProjectTeamID.id)
				return { results: [ data.fo_ProjectTeamID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

