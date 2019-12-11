<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'Inquiry';

		/* data for selected record, or defaults if none is selected */
		var data = {
			ClientID: <?php echo json_encode(array('id' => $rdata['ClientID'], 'value' => $rdata['ClientID'], 'text' => $jdata['ClientID'])); ?>,
			fo_Logistic: <?php echo json_encode(array('id' => $rdata['fo_Logistic'], 'value' => $rdata['fo_Logistic'], 'text' => $jdata['fo_Logistic'])); ?>,
			fo_ShipName: <?php echo json_encode($jdata['fo_ShipName']); ?>,
			fo_ShipAddress: <?php echo json_encode($jdata['fo_ShipAddress']); ?>,
			fo_ShipCity: <?php echo json_encode($jdata['fo_ShipCity']); ?>,
			fo_ShipRegion: <?php echo json_encode($jdata['fo_ShipRegion']); ?>,
			fo_ShipPostalCode: <?php echo json_encode($jdata['fo_ShipPostalCode']); ?>,
			fo_ShipCountry: <?php echo json_encode($jdata['fo_ShipCountry']); ?>,
			ot_ap_Review: <?php echo json_encode(array('id' => $rdata['ot_ap_Review'], 'value' => $rdata['ot_ap_Review'], 'text' => $jdata['ot_ap_Review'])); ?>,
			ot_ap_Approval: <?php echo json_encode(array('id' => $rdata['ot_ap_Approval'], 'value' => $rdata['ot_ap_Approval'], 'text' => $jdata['ot_ap_Approval'])); ?>,
			ot_ap_QC: <?php echo json_encode(array('id' => $rdata['ot_ap_QC'], 'value' => $rdata['ot_ap_QC'], 'text' => $jdata['ot_ap_QC'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for ClientID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ClientID' && d.id == data.ClientID.id)
				return { results: [ data.ClientID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ClientID autofills */
		cache.addCheck(function(u, d){
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'ClientID' && d.id == data.ClientID.id){
				$j('#fo_ShipName' + d[rnd]).html(data.fo_ShipName);
				$j('#fo_ShipAddress' + d[rnd]).html(data.fo_ShipAddress);
				$j('#fo_ShipCity' + d[rnd]).html(data.fo_ShipCity);
				$j('#fo_ShipRegion' + d[rnd]).html(data.fo_ShipRegion);
				$j('#fo_ShipPostalCode' + d[rnd]).html(data.fo_ShipPostalCode);
				$j('#fo_ShipCountry' + d[rnd]).html(data.fo_ShipCountry);
				return true;
			}

			return false;
		});

		/* saved value for fo_Logistic */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_Logistic' && d.id == data.fo_Logistic.id)
				return { results: [ data.fo_Logistic ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

