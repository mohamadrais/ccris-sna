<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'Item';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_SupplierID: <?php echo json_encode(array('id' => $rdata['fo_SupplierID'], 'value' => $rdata['fo_SupplierID'], 'text' => $jdata['fo_SupplierID'])); ?>,
			fo_CategoryID: <?php echo json_encode(array('id' => $rdata['fo_CategoryID'], 'value' => $rdata['fo_CategoryID'], 'text' => $jdata['fo_CategoryID'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_SupplierID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_SupplierID' && d.id == data.fo_SupplierID.id)
				return { results: [ data.fo_SupplierID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_CategoryID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_CategoryID' && d.id == data.fo_CategoryID.id)
				return { results: [ data.fo_CategoryID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

