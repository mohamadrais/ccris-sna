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
	$tablesToExclude = array('Leadership','Approval','IMSControl','membership_company','kpi','summary_dashboard');
    global $Translation;
	

	// process search
	//$memberID = $memberInfo['username'];
	$departmentID = max(0, intval($_GET['departmentID']));
	$tableName = new Request('tableName');
	$page = max(1, intval($_GET['page']));
	$searchText = makeSafe($_GET['searchText']);
	$start = ($page - 1) * $adminConfig['recordsPerPage'];
	$recordsPerPage = $adminConfig['recordsPerPage'];

	$continueFlag = 1;
	if(strlen($searchText) < 3){
		$continueFlag = 0;
	}

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

	if($memberID->sql != ''){
		$where .= ($where ? " and " : "") . "r.memberID like '{$memberID->sql}%'";
	}

	if ($continueFlag != 0){
		$tableList = getTableList2(true);
		$sqlSetCountQuery = searchQueryBuilder($departmentID, $tableName->sql, $searchText, $sort, $sortDir, $dateStart, $dateEnd, 1, $start, $recordsPerPage);
		//print_r($sqlSetCountQuery);
		$sqlSetCount = array();
		foreach($sqlSetCountQuery as $tn => $queryCount){
			// print_r($queryCount);
			$sqlSetCount[$tn] = sqlValue($queryCount);
		}
		// print_r($sqlSetCount);
		$sqlSetQuery; // $eo['silentErrors']=true;
		$sqlSetResult;
		$keywords = preg_split("/[\s,\']+/", $searchText);
		$keywordsCount = count($keywords);
		$sqlSet = array();
		$totalCount = 0;

		foreach($sqlSetCount as $tn => $count){
			$currDepartment = getTableDepartment($tn);
			if($count != 0){
				$totalCount += $count;
				$tableDisplayName = getTableDisplayName($tn);
				$sqlSetQuery = searchQueryBuilder($departmentID, $tn, $searchText, $sort, $sortDir, $dateStart, $dateEnd, 0, $start, $recordsPerPage);
				// print_r($sqlSetQuery);
				$sqlSetResult = sql($sqlSetQuery[$tn], $eo);
				$sqlCurrSet = array();
				if($sqlSetResult->num_rows > 0){
					while($row=db_fetch_row($sqlSetResult)){
						//print_r($row);
						$match = '';
						foreach($keywords as $i => $w){
							foreach($row as $x){
								$match .= (stristr( (string) $x, (string) $w )) ? stristr( (string) $x, (string) $w ) . "..." : "";
							}
						}
						$dC = array_slice($row, -2)[0];
						$dM = array_slice($row, -1)[0];
						
						$sqlCurrSet[] = array($tableDisplayName, substr(getCSVData($tn, $row[0]), 0, 80) . "..." . $dC . ", " . $dM, substr($match, 0, 30), $tn, $row[0]);
						// print_r($sqlSet);
					}
					
					$sqlSet[$currDepartment][$tableDisplayName] = array($count, $sqlCurrSet);
				}
			}
		}
	}
	// print_r($sqlSet);
	


	// $numRecords = sqlValue("select count(1) from membership_userrecords r left join membership_departments g on r.departmentID=g.departmentID {$where}");
	$numRecords = $totalCount;
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
<div class="page-wrapper ps ps--theme_default">
<div class="container-fluid">
	<form method="get" action="search.php" id="searchPageForm">
		<input type="hidden" name="page" value="1">
		<input type="hidden" id="dateStart" name="dateStart" value="">
		<input type="hidden" id="dateEnd" name="dateEnd" value="">
		<div class="form-row">
		
			<div class="form-group col-lg-3 col-md-3 pr-2">
				<label for="departmentID" class="control-label"><?php echo $Translation['department']; ?></label> &nbsp;
				<?php 
					$departmentsSelect = array_merge(array('0' => $Translation['all departments']), array_keys($departments));
					$arrFields = array_keys($departmentsSelect);
					$arrFieldCaptions = array_values($departmentsSelect);
					echo htmlSelect('departmentID', $arrFields, $arrFieldCaptions, $departmentID);
				?>
			</div>
			<div class="form-group col-lg-3 col-md-3 pr-2">
				<label for="tableName" class="control-label"><?php echo $Translation['show records'] ; ?></label> &nbsp;
				<?php
					$tables = array_merge(array('' => $Translation['all tables']), getTableList2(true));
					foreach($tablesToExclude as $te){
						if(isset($tables[$te])) unset($tables[$te]);
					}
					$arrFields = array_keys($tables);
					$arrFieldCaptions = array_values($tables);
					echo htmlSelect('tableName', $arrFields, $arrFieldCaptions, $tableName->raw);
				?>
			</div>
			<div class="form-group col-lg-2 col-md-2 pr-2">
				<label for="reportrange" class="control-label"><?php echo $Translation['date range'] ; ?>&nbsp;<i class="fa fa-calendar"></i></label> &nbsp;
				<input id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
				
			</div>
			<div class="form-group col-lg-2 col-md-2 pr-2">
				<label for="sort" class="control-label"><?php echo $Translation['sort records'] ; ?></label> &nbsp;
				<?php
					$arrFields = array('dateAdded', 'dateUpdated');
					$arrFieldCaptions = array( $Translation['date created'] , $Translation['date modified'] );
					echo htmlSelect('sort', $arrFields, $arrFieldCaptions, $sort);
				?>
			</div>
			<div class="form-group col-lg-2 col-md-2 pr-2">
			<label for="sortDir" class="control-label"><?php echo $Translation['sort order'] ; ?></label> &nbsp;
				<?php
					$arrFields=array('desc', '');
					$arrFieldCaptions = array( $Translation['newer first'] , $Translation['older first'] );
					echo htmlSelect('sortDir', $arrFields, $arrFieldCaptions, $sortDir);
				?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-lg-10 col-md-10 pr-2">
				<label for="searchText" class="control-label"><?php echo $Translation['search for'] ; ?></label> &nbsp;
				<input type="text" id="searchText" name="searchText" value="<?php echo $searchText ?>" >
			</div>
			<div class="form-group col-lg-2 col-md-2 pr-2 text-center">
				<br><br>
				<button id="submitSearch" type="submit" class="btn btn-secondary"><i class="glyphicon glyphicon-search"></i> <?php echo $Translation['find'] ; ?></button>&nbsp;&nbsp;&nbsp;
				<button type="button" id="reset-search" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> <?php echo $Translation['reset'] ; ?></button>
			</div>
		</div>
	</form>
<table class="table table-striped table-condensed table-hover" >
	<thead>
		<tr>
			<th style="width: 4%">&nbsp;</td>
			<th style="width: 48%"><?php echo $Translation['data'] ; ?></th>
			<th style="width: 48%"><?php echo $Translation['matched'] ; ?></th>
		</tr>
	</thead>
</table>
		<?php 
	$maxIndexArr = array();
	if(isset($sqlSet)){
		foreach($sqlSet as $department => $data){
			if($departmentID == 0){
		?>
		<div>
			<div class="row" colspan="7">
				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#departmentID-<?php echo $department; ?>" aria-expanded="false">
					<?php echo $department; ?> (<?php $countDepartment = 0; foreach($data as $table => $tableData){ $countDepartment += $tableData[0]; } echo $countDepartment; ?> results)
				</button>
			</div>
		</div>
		<br>
		<div class="collapse" id="departmentID-<?php echo $department; ?>">
			<div class="card card-body">
		

	<?php 
		}
	?>
	
	<?php 
	
			foreach($data as $table => $tableData){
	?>
	
		
	<?php
				foreach($tableData[1] as $index => $tableDataValue){

	?>
	<table class="table table-striped table-condensed table-hover">
	<?php if($index == 0) { 
		$record1 = $start + 1;
		$record2 = $start + $recordsPerPage;
		$record2 = ($record2 > $tableData[0]) ? $tableData[0] : $record2;
		$originalValues =  array('<RECORDNUM1>', '<RECORDNUM2>', '<RECORDS>');
		$maxIndexArr[] = $tableData[0];
		$replaceValues = array($record1, $record2, $tableData[0]);
	?>
		
		<tr class="success">
			<td colspan='12' class="text-left">
				<?php echo $tableDataValue[0]; ?> (<?php echo str_replace($originalValues, $replaceValues, $Translation['displaying records']); ?> )
			</td>
		</tr>
	<?php } ?>
		<tr>
			<td style="width: 4%"><a href="<?php echo $tableDataValue[3]; ?>_view.php?SelectedID=<?php echo $tableDataValue[4]; ?>" target="_blank"><i class="glyphicon glyphicon-new-window"></i></a></td>
			<td style="width: 48%"><?php echo $tableDataValue[1]; ?></td>
			<td style="width: 48%"><?php echo $tableDataValue[2]; ?></td>
		</tr>
	</table>
	<?php
	
				}
			}
	?>
		</div> <!-- div collapse department-id end -->
	</div> <!-- div card card-body end -->
	<?php
		}
	}
?>
<table class="table table-striped table-condensed table-hover" >
	<tfoot>
		<tr>
			<td colspan="4" class="text-left flip" style="width: 25%;">
				<?php if($start){ ?>
					<a href="search.php?page=<?php echo ($page > 1 ? $page - 1 : 1); ?>&departmentID=<?php echo $departmentID; ?>&tableName=<?php echo $tableName->url; ?>&dateStart=<?php echo $dateStart; ?>&dateEnd=<?php echo $dateEnd; ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>&searchText=<?php echo $searchText;?>" class="btn btn-secondary"><?php echo $Translation['previous'] ; ?></a>
				<?php } ?>
			</td>
			<td colspan="8" class="text-center">
				<?php
					$originalValues =  array('<RECORDS>');
					$replaceValues = array($numRecords);
					echo str_replace($originalValues, $replaceValues, $Translation['displaying records table']);
				?>
			</td>
			<td colspan="4" class="text-right flip" style="width: 25%;">
				<?php if(count($maxIndexArr)){ if(($start + $recordsPerPage) < max($maxIndexArr)){ ?>
					<a href="search.php?page=<?php echo ($page<ceil($numRecords/$adminConfig['recordsPerPage']) ? $page+1 : ceil($numRecords/$adminConfig['recordsPerPage'])); ?>&departmentID=<?php echo $departmentID; ?>&tableName=<?php echo $tableName->url; ?>&dateStart=<?php echo $dateStart; ?>&dateEnd=<?php echo $dateEnd; ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>&searchText=<?php echo $searchText;?>" class="btn btn-secondary"><?php echo $Translation['next'] ; ?></a>
				<?php } }?>
			</td>
		</tr>
	</tfoot>
</table>


<!-- <div class="modal fade" tabindex="-1" id="view-record-modal">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<button type="button" class="close hspacer-md vspacer-md" data-dismiss="modal">&times;</button>
		<div class="modal-body" style="-webkit-overflow-scrolling:touch !important; overflow-y: auto;">
			<iframe width="100%" height="100%" sandbox="allow-forms allow-scripts allow-same-origin" src="" id="view-record-iframe"></iframe>
		</div>
	</div>
</div>
</div> -->
</div> <!-- div container-fluid end -->
</div> <!-- div page-wrapper end -->
<style>
.form-inline .form-group{ margin: .5em 1em; }
</style>

<script>
	$j(function(){
		$j(document).ready(function () {
			$j("div[id^='departmentID-']").each(function(i, el) {
				if (i === 0){
					$j(el).collapse('show');
				}
			});
		});

		$j('.collapse').on('show.bs.collapse', function () {
			$j('.collapse.show').each(function(){
				$j(this).collapse('hide');
			});
		});


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

		$j('#tableName, #departmentID, #reportrange, #sort, #sortDir, #searchText').addClass('form-control');

		$j('#departmentID').on('change', function(){
			var departmentID = $j( "#departmentID" ).val();
			$j.ajax({
				url: "ajax_crud_search.php",
				method: "POST",
				data: {
					'd': departmentID
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

		var start = moment().subtract(365, 'days');
		if(dateStartURL != ''){
			start = moment(dateStartURL);
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
            "startDate": moment().subtract(365, 'days'),
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
