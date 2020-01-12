<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['data records'];
	include("{$currDir}/incHeader.php");

	// process search
	$memberID = new Request('memberID', 'strtolower');
	$groupID = max(0, intval($_GET['groupID']));
	$tableName = new Request('tableName');
	$page = max(1, intval($_GET['page']));

	// process sort
	$sortDir = ($_GET['sortDir'] == 'desc' ? 'desc' : '');
	$sort = makeSafe($_GET['sort']);
	if($sort != 'dateAdded' && $sort != 'dateUpdated'){ // default sort is newly created first
		$sort = 'dateAdded';
		$sortDir = 'desc';
	}

	if($sort){
		$sortClause = "order by {$sort} {$sortDir}";
	}

	if($memberID->sql != ''){
		$where .= ($where ? " and " : "") . "r.memberID like '{$memberID->sql}%'";
	}

	if($groupID){
		$where .= ($where ? " and " : "") . "g.groupID='{$groupID}'";
	}

	if($tableName->sql != ''){
		$where .= ($where ? " and " : "") . "r.tableName='{$tableName->sql}'";
	}

	if($where){
		$where = "where {$where}";
	}

	$numRecords = sqlValue("select count(1) from membership_userrecords r left join membership_groups g on r.groupID=g.groupID {$where}");
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

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h3>
						<?php echo $Translation['data records'] ; ?>
					</h3>
				
				<table class="table">
					<thead>
						<tr>
							<th colspan="12">
								<form method="get" action="pageViewRecords.php">
									<div class="row">
										<div class="col-md-3">
											<input type="hidden" name="page" value="1">

											<div class="form-group">
												<label for="groupID" class="control-label"><?php echo $Translation["group"]; ?></label>
												<?php echo htmlSQLSelect("groupID", "select groupID, name from membership_groups order by name", $groupID); ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="memberID" class="control-label"><?php echo $Translation["member username"] ; ?></label>
												<input type="text" class="form-control" id="memberID" name="memberID" value="<?php echo $memberID->attr; ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="tableName" class="control-label"><?php echo $Translation['show records'] ; ?></label>
												<?php
													$tables = array_merge(array('' => $Translation['all tables']), getTableList(true));
													$arrFields = array_keys($tables);
													$arrFieldCaptions = array_values($tables);
													echo htmlSelect('tableName', $arrFields, $arrFieldCaptions, $tableName->raw);
												?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="sort" class="control-label"><?php echo $Translation['sort records'] ; ?></label>
												<?php
													$arrFields = array('dateAdded', 'dateUpdated');
													$arrFieldCaptions = array( $Translation['date created'] , $Translation['date modified'] );
													echo htmlSelect('sort', $arrFields, $arrFieldCaptions, $sort);
												?>
												<div class="m-2"></div>
												<?php
													$arrFields=array('desc', '');
													$arrFieldCaptions = array( $Translation['newer first'] , $Translation['older first'] );
													echo htmlSelect('sortDir', $arrFields, $arrFieldCaptions, $sortDir);
												?>
											</div>
										</div>
										<div class="col-md-12 button-group text-right">
											<button type="button" id="reset-search" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> <?php echo $Translation['reset'] ; ?></button>
											<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> <?php echo $Translation['find'] ; ?></button>
										</div>
									</div>
								</form>
							</th>
						</tr>
						<tr>
							<th>&nbsp;</td>
							<th><a><?php echo $Translation['username'] ; ?></a></th>
							<th><a><?php echo $Translation["group"] ; ?></a></th>
							<th><a><?php echo $Translation["table"] ; ?></a></th>
							<th><a><?php echo $Translation['created'] ; ?></a></th>
							<th><a><?php echo $Translation['modified'] ; ?></a></th>
							<th><a><?php echo $Translation['data'] ; ?></a></th>
						</tr>
					</thead>
					<tbody>
				<?php

					$res = sql("select r.recID, r.memberID, g.name, r.tableName, r.dateAdded, r.dateUpdated, r.pkValue from membership_userrecords r left join membership_groups g on r.groupID=g.groupID $where $sortClause limit $start, " . $adminConfig['recordsPerPage'], $eo);
					while($row = db_fetch_row($res)){
						?>
						<tr>
							<td class="text-center">
								<a href="pageEditOwnership.php?recID=<?php echo $row[0]; ?>" title="<?php echo $Translation['change record ownership'] ; ?>"><i class="glyphicon glyphicon-user"></i></a>
								<a href="pageDeleteRecord.php?recID=<?php echo $row[0]; ?>" onClick="return confirm('<?php echo $Translation['sure delete record'] ; ?>');" title="<?php echo $Translation['delete record'] ; ?>"><i class="glyphicon glyphicon-trash text-danger"></i></a>
							</td>
							<td><a><?php echo $row[1]; ?></a></td>
							<td><a><?php echo $row[2]; ?></a></td>
							<td><a><?php echo $row[3]; ?></a></td>
							<td class="<?php echo ($sort == 'dateAdded' ? 'warning' : '');?>"><a><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[4]); ?></a></td>
							<td class="<?php echo ($sort == 'dateUpdated' ? 'warning' : '');?>"><a><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[5]); ?></a></td>
							<td>
								<a href="#" class="view-record" data-record-id="<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-search hspacer-md"></i></a>
								<a><?php echo substr(getCSVData($row[3], $row[6]), 0, 80) . " ... "; ?></a>
							</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
				<div class="row pagination-section">
					<div class="col-xs-4 col-md-3 col-lg-2 vspacer-lg">
						<?php if($start){ ?>
							<button class="btn btn-outline-primary btn-block" href="pageViewRecords.php?groupID=<?php echo $groupID; ?>&memberID=<?php echo $memberID->url; ?>&tableName=<?php echo $tableName->url; ?>&page=<?php echo ($page > 1 ? $page - 1 : 1); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>"><span class="hidden-xs"><?php echo $Translation['previous']; ?></span><i class="glyphicon glyphicon-chevron-left"></i></button>
						<?php } ?>
					</div>
					<div class="col-xs-4 col-md-6 col-lg-8 text-center">
						<?php
							$record1 = $start + 1;
							$record2 = $start + db_num_rows($res);
							$originalValues =  array('<RECORDNUM1>', '<RECORDNUM2>', '<RECORDS>');
							$replaceValues = array($record1, $record2, $numRecords);
							echo str_replace($originalValues, $replaceValues, $Translation['displaying records']);
						?>
					</div>
					<div class="col-xs-4 col-md-3 col-lg-2 vspacer-lg">
						<?php if($record2 < $numRecords){ ?>
							<button class="btn btn-primary btn-block" href="pageViewRecords.php?groupID=<?php echo $groupID; ?>&memberID=<?php echo $memberID->url; ?>&tableName=<?php echo $tableName->url; ?>&page=<?php echo ($page<ceil($numRecords/$adminConfig['recordsPerPage']) ? $page+1 : ceil($numRecords/$adminConfig['recordsPerPage'])); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>" ><span class="hidden-xs"><?php echo $Translation['next'] ; ?></span><i class="glyphicon glyphicon-chevron-right"></i></button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
			window.location = 'pageViewRecords.php';
		});

		$j('#tableName, #groupID, #sort, #sortDir').addClass('form-control');
	})
</script>

<?php
	include("{$currDir}/incFooter.php");
