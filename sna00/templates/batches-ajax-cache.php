<script>
	$j(function(){
		var tn = 'batches';

		/* data for selected record, or defaults if none is selected */
		var data = {
			fo_item: <?php echo json_encode(array('id' => $rdata['fo_item'], 'value' => $rdata['fo_item'], 'text' => $jdata['fo_item'])); ?>,
			fo_suppliers: <?php echo json_encode(array('id' => $rdata['fo_suppliers'], 'value' => $rdata['fo_suppliers'], 'text' => $jdata['fo_suppliers'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for fo_item */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_item' && d.id == data.fo_item.id)
				return { results: [ data.fo_item ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for fo_suppliers */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'fo_suppliers' && d.id == data.fo_suppliers.id)
				return { results: [ data.fo_suppliers ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

