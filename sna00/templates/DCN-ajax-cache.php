<script>
	$j(function(){
		var tn = 'DCN';

		/* data for selected record, or defaults if none is selected */
		var data = {
			DCCID: <?php echo json_encode(array('id' => $rdata['DCCID'], 'value' => $rdata['DCCID'], 'text' => $jdata['DCCID'])); ?>,
			fo_DCCITEM: <?php echo json_encode($jdata['fo_DCCITEM']); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for DCCID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'DCCID' && d.id == data.DCCID.id)
				return { results: [ data.DCCID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for DCCID autofills */
		cache.addCheck(function(u, d){
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'DCCID' && d.id == data.DCCID.id){
				$j('#fo_DCCITEM' + d[rnd]).html(data.fo_DCCITEM);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

