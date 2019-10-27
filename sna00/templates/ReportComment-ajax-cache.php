<script>
	$j(function(){
		var tn = 'ReportComment';

		/* data for selected record, or defaults if none is selected */
		var data = {
			PostID: <?php echo json_encode(array('id' => $rdata['PostID'], 'value' => $rdata['PostID'], 'text' => $jdata['PostID'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for PostID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'PostID' && d.id == data.PostID.id)
				return { results: [ data.PostID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

