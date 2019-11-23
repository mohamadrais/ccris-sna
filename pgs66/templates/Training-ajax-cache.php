<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'Training';

		/* data for selected record, or defaults if none is selected */
		var data = {
			EmployeeID: <?php echo json_encode(array('id' => $rdata['EmployeeID'], 'value' => $rdata['EmployeeID'], 'text' => $jdata['EmployeeID'])); ?>,
			ProjectTeamID: <?php echo json_encode(array('id' => $rdata['ProjectTeamID'], 'value' => $rdata['ProjectTeamID'], 'text' => $jdata['ProjectTeamID'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for EmployeeID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'EmployeeID' && d.id == data.EmployeeID.id)
				return { results: [ data.EmployeeID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ProjectTeamID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ProjectTeamID' && d.id == data.ProjectTeamID.id)
				return { results: [ data.ProjectTeamID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

