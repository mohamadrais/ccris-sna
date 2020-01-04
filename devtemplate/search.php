<?php 
    $currDir=dirname(__FILE__);
    $hooks_dir = $currDir . "/hooks";
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
    include("$currDir/lib.php");
    $x = new DataList;
    $x->TableTitle = 'Search';
    include_once("$currDir/header.php");
    include("$currDir/language.php");
	include("{$currDir}/language-admin.php");
	include("$hooks_dir/searchCommon.php");
    $memberInfo = getMemberInfo();
    global $Translation;
	

	// process search
	//$memberID = $memberInfo['username'];
	$departmentID = max(0, intval($_GET['departmentID']));
	$tableName = new Request('tableName');
	$page = max(1, intval($_GET['page']));
	$searchText = makeSafe($_GET['searchText']);

	// process sort
	$sortDir = ($_GET['sortDir'] == 'desc' ? 'desc' : '');
	$sort = makeSafe($_GET['sort']);

	if($sort != 'dateAdded' && $sort != 'dateUpdated'){ // default sort is newly created first
		$sort = 'dateAdded';
		$sortDir = 'desc';
	}

	// process date range
	$dateStart = makeSafe($_GET['dateStart']);
	$dateEnd = makeSafe($_GET['dateEnd']);

	if($sortQuery){
		$sortClause = "order by {$sort} {$sortDir}";
	}

	if($memberID->sql != ''){
		$where .= ($where ? " and " : "") . "r.memberID like '{$memberID->sql}%'";
	}

	if($departmentID){
		$where .= ''; //($where ? " and " : "") . "g.departmentID='{$departmentID}'";
	}

	if($tableName->sql != ''){
		$where .= ($where ? " and " : "") . "r.tableName='{$tableName->sql}'";
	}

	if($where){
		$where = "where {$where}";
	}

	$sqlSetCountQuery = searchQueryBuilder($departmentID, $tableName, $searchText, $sort, $sortDir, $dateStart, $dateEnd, 1);
	$sqlSetCount = array();
	foreach($sqlSetCountQuery as $tn => $queryCount){
		print_r($queryCount);
		$sqlSetCount[$tn] = sqlValue($queryCount);
	}
	print_r($sqlSetCount);
	$sqlSet = searchQueryBuilder($departmentID, $tableName, $searchText, $sort, $sortDir, $dateStart, $dateEnd, 0);

	// $numRecords = sqlValue("select count(1) from membership_userrecords r left join membership_departments g on r.departmentID=g.departmentID {$where}");
	$numRecords = sqlValue("select count(1) from membership_userrecords {$where}");
	$noResults = false;
	if(!$numRecords){
		echo "<div class=\"alert alert-warning\">{$Translation['no matching results found']}</div>";
		$noResults = true;
		$page = 1;
	}

	if($page > ceil($numRecords / $adminConfig['recordsPerPage']) && !$noResults){
		redirect("admin/pageViewRecords.php?page=" . ceil($numRecords/$adminConfig['recordsPerPage']));
	}

	$start = ($page - 1) * $adminConfig['recordsPerPage'];


	$departments = get_table_groups();
	
	/*
		Classes of first and other blocks
		---------------------------------
		For possible classes, refer to the Bootstrap grid columns, panels and buttons documentation:
			Grid columns: http://getbootstrap.com/css/#grid
			Panels: http://getbootstrap.com/components/#panels
			Buttons: http://getbootstrap.com/css/#buttons
	*/
	$block_classes = array(
		'first' => array(
			'grid_column' => 'col-lg-12',
			'panel' => 'panel-warning',
			'link' => 'btn-warning'
		),
		'other' => array(
			'grid_column' => 'col-lg-12',
			'panel' => 'panel-info',
			'link' => 'btn-info'
		)
	);
?>

<style>
	.panel-body-description{
		margin-top: 10px;
		height: 100px;
		overflow: auto;
	}
	.panel-body .btn img{
		margin: 0 10px;
		max-height: 32px;
	}
</style>
<table class="table table-striped table-bordered table-hover" style="margin-top:180px">
	<thead>
		<tr>
			<th colspan="7">
				<form class="form-inline" method="get" action="search.php" class="form-horizontal">
					<input type="hidden" name="page" value="1">

					<div class="form-group">
						<label for="departmentID" class="control-label"><?php echo $Translation['department']; ?></label>
						<?php 
							$departmentsSelect = array_merge(array('0' => $Translation['all departments']), array_keys($departments));
							$arrFields = array_keys($departmentsSelect);
							$arrFieldCaptions = array_values($departmentsSelect);
							echo htmlSelect('departmentID', $arrFields, $arrFieldCaptions, $departmentID);
						?>
					</div>
					<div class="form-group">
						<label for="tableName" class="control-label"><?php echo $Translation['show records'] ; ?></label>
						<?php
							$tables = array_merge(array('' => $Translation['all tables']), getTableList2(true));
							$arrFields = array_keys($tables);
							$arrFieldCaptions = array_values($tables);
							echo htmlSelect('tableName', $arrFields, $arrFieldCaptions, $tableName->raw);
						?>
					</div>
					<div class="form-group">
						<label for="reportrange" class="control-label"><?php echo $Translation['date range'] ; ?></label>
						<input type="hidden" id="dateStart" name="dateStart" value="">
						<input type="hidden" id="dateEnd" name="dateEnd" value="">
						<span id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
					<div class="form-group">
						<label for="sort" class="control-label"><?php echo $Translation['sort records'] ; ?></label>
						<?php
							$arrFields = array('dateAdded', 'dateUpdated');
							$arrFieldCaptions = array( $Translation['date created'] , $Translation['date modified'] );
							echo htmlSelect('sort', $arrFields, $arrFieldCaptions, $sort);
						?>
						<span class="hspacer-md"></span>
						<?php
							$arrFields=array('desc', '');
							$arrFieldCaptions = array( $Translation['newer first'] , $Translation['older first'] );
							echo htmlSelect('sortDir', $arrFields, $arrFieldCaptions, $sortDir);
						?>
					</div>
					<div class="form-group">
						<label for="searchText" class="control-label"><?php echo $Translation['search for'] ; ?></label>
						<input type="text" id="searchText" name="searchText" value="<?php echo $searchText ?>">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> <?php echo $Translation['find'] ; ?></button>
						<button type="button" id="reset-search" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> <?php echo $Translation['reset'] ; ?></button>
					</div>
				</form>
			</th>
		</tr>
		<tr>
			<th>&nbsp;</td>
			<th><?php echo $Translation['username'] ; ?></th>
			<th><?php echo $Translation["department"] ; ?></th>
			<th><?php echo $Translation["table"] ; ?></th>
			<th><?php echo $Translation['created'] ; ?></th>
			<th><?php echo $Translation['modified'] ; ?></th>
			<th><?php echo $Translation['data'] ; ?></th>
		</tr>
	</thead>
	<tbody>

<?php

// $res = sql("select r.recID, r.memberID, g.name, r.tableName, r.dateAdded, r.dateUpdated, r.pkValue from membership_userrecords r left join membership_departments g on r.departmentID=g.departmentID $where $sortClause limit $start, " . $adminConfig['recordsPerPage'], $eo);
$res = sql("select r.recID, r.memberID, r.memberID, r.tableName, r.dateAdded, r.dateUpdated, r.pkValue from membership_userrecords r $where $sortClause limit $start, " . $adminConfig['recordsPerPage'], $eo);
while($row = db_fetch_row($res)){
	?>
	<tr>
		<td class="text-center">
			<a href="pageEditOwnership.php?recID=<?php echo $row[0]; ?>" title="<?php echo $Translation['change record ownership'] ; ?>"><i class="glyphicon glyphicon-user"></i></a>
			<a href="pageDeleteRecord.php?recID=<?php echo $row[0]; ?>" onClick="return confirm('<?php echo $Translation['sure delete record'] ; ?>');" title="<?php echo $Translation['delete record'] ; ?>"><i class="glyphicon glyphicon-trash text-danger"></i></a>
		</td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td><?php echo $row[3]; ?></td>
		<td class="<?php echo ($sort == 'dateAdded' ? 'warning' : '');?>"><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[4]); ?></td>
		<td class="<?php echo ($sort == 'dateUpdated' ? 'warning' : '');?>"><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[5]); ?></td>
		<td>
			<a href="#" class="view-record" data-record-id="<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-search hspacer-md"></i></a>
			<?php echo substr(getCSVData($row[3], $row[6]), 0, 80) . " ... "; ?>
		</td>
	</tr>
	<?php
}
?>
</tbody>
<tfoot>
	<tr>
		<td colspan="7" style="padding: .3em;">
			<table width="100%" cellspacing="0">
				<tr>
					<th class="text-left flip" style="width: 25%;">
						<?php if($start){ ?>
							<a href="pageViewRecords.php?departmentID=<?php echo $departmentID; ?>&memberID=<?php echo $memberID->url; ?>&tableName=<?php echo $tableName->url; ?>&page=<?php echo ($page > 1 ? $page - 1 : 1); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>" class="btn btn-default"><?php echo $Translation['previous'] ; ?></a>
						<?php } ?>
					</th>
					<th class="text-center">
						<?php
							$record1 = $start + 1;
							$record2 = $start + db_num_rows($res);
							$originalValues =  array('<RECORDNUM1>', '<RECORDNUM2>', '<RECORDS>');
							$replaceValues = array($record1, $record2, $numRecords);
							echo str_replace($originalValues, $replaceValues, $Translation['displaying records']);
						?>
					</th>
					<th class="text-right flip" style="width: 25%;">
						<?php if($record2 < $numRecords){ ?>
							<a href="pageViewRecords.php?departmentID=<?php echo $departmentID; ?>&memberID=<?php echo $memberID->url; ?>&tableName=<?php echo $tableName->url; ?>&page=<?php echo ($page<ceil($numRecords/$adminConfig['recordsPerPage']) ? $page+1 : ceil($numRecords/$adminConfig['recordsPerPage'])); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>" class="btn btn-default"><?php echo $Translation['next'] ; ?></a>
						<?php } ?>
					</th>
				</tr>
			</table>
		</td>
	</tr>
</tfoot>
</table>

<div class="modal fade" tabindex="-1" id="view-record-modal">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<button type="button" class="close hspacer-md vspacer-md" data-dismiss="modal">&times;</button>
		<div class="modal-body" style="-webkit-overflow-scrolling:touch !important; overflow-y: auto;">
			<iframe width="100%" height="100%" sandbox="allow-forms allow-scripts allow-same-origin" src="" id="view-record-iframe"></iframe>
		</div>
	</div>
</div>
</div>

<style>
.form-inline .form-group{ margin: .5em 1em; }
</style>

<script>
	$j(function(){
		$j('.view-record').click(function(){
			var recID = $j(this).data('record-id');
			$j('#view-record-iframe').attr('src', 'pagePrintRecord.php?recID=' + recID);
			$j('#view-record-modal').modal('show');
			$j('#view-record-modal .modal-body').height($j(window).height() * 0.7);

			return false;
		});

		$j('#reset-search').click(function(){
			window.location = 'search.php';
		});

		$j('#tableName, #departmentID, #reportrange, #sort, #sortDir').addClass('form-control');

		$j('#departmentID').on('change', function(){
			var dID = $j( "#departmentID" ).val();
			$j.ajax({
				url: "ajax_crud_search.php",
				method: "POST",
				data: {
					'd': dID
				},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$j('#tableName').replaceWith(data);
					$j('#tableName').addClass('form-control');
				},         
				error: function(response) {
					console.log('ajax_crud_search error: ' + response.statusText);
				}
			});
		});

		var dateStartURL = getUrlParameter('dateStart');
		var dateEndURL = getUrlParameter('dateEnd');

		var start = moment().startOf('year');
		if(dateStartURL != ''){
			start = moment(dateStartURL).startOf('month');
		}
		
		var end = moment();
        if(dateEndURL != ''){
			end = moment(dateEndURL);
		}

        function cb(start, end) {
			$j('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$j('#dateStart').val(start.format('YYYY-MM-DD'));
			$j('#dateEnd').val(end.format('YYYY-MM-DD'));
			console.log("date selected : "+ start.format('YYYY-MM-DD') + "-" + end.format('YYYY-MM-DD'));
        }

        $j('#reportrange').daterangepicker({
            "showDropdowns": true,
            "minYear": 2000,
            "maxYear": moment().add(100, 'years').year(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "linkedCalendars": false,
            "startDate": moment().startOf('month'),
            "endDate": moment()
        }, cb);
		cb(start, end);

		function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
		};
		
	})
</script>

<?php include_once("$currDir/footer.php"); ?>
