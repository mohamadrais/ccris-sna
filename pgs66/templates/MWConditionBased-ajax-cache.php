<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'MWConditionBased';

		/* data for selected record, or defaults if none is selected */
		var data = {
			MwoID: <?php echo json_encode(array('id' => $rdata['MwoID'], 'value' => $rdata['MwoID'], 'text' => $jdata['MwoID'])); ?>,
			fo_EmployeeID: <?php echo json_encode(array('id' => $rdata['fo_EmployeeID'], 'value' => $rdata['fo_EmployeeID'], 'text' => $jdata['fo_EmployeeID'])); ?>,
			fo_Position: <?php echo json_encode($jdata['fo_Position']); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for MwoID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'MwoID' && d.id == data.MwoID.id)
				return { results: [ data.MwoID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_EmployeeID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_EmployeeID' && d.id == data.fo_EmployeeID.id)
				return { results: [ data.fo_EmployeeID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_EmployeeID autofills */
		cache.addCheck(function(u, d){
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'fo_EmployeeID' && d.id == data.fo_EmployeeID.id){
				$j('#fo_Position' + d[rnd]).html(data.fo_Position);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

