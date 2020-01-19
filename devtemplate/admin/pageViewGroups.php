<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['groups'];
	include("{$currDir}/incHeader.php");

	if($_GET['searchGroups'] != ""){
		$searchSQL = makeSafe($_GET['searchGroups']);
		$searchHTML = html_attr($_GET['searchGroups']);
		$where = "where name like '%{$searchSQL}%' or description like '%{$searchSQL}%'";
	}else{
		$searchSQL = '';
		$searchHTML = '';
		$where = "";
	}

	$numGroups = sqlValue("select count(1) from membership_groups $where");
	if(!$numGroups && $searchSQL != ''){
		echo "<div class=\"alert alert-danger\">{$Translation['no matching results found']}</div>";
		$noResults = true;
		$page = 1;
	}else{
		$noResults = false;
	}

	$page = intval($_GET['page']);
	if($page < 1){
		$page = 1;
	}elseif($page > ceil($numGroups / $adminConfig['groupsPerPage']) && !$noResults){
		redirect("admin/pageViewGroups.php?page=" . ceil($numGroups / $adminConfig['groupsPerPage']));
	}

	$start = ($page - 1) * $adminConfig['groupsPerPage'];

?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h3>
							<?php echo $Translation['groups']; ?>
						</h3>
						<table class="table">
							<thead>
								<tr>
									<th colspan="8">
										<form method="get" action="pageViewGroups.php">
											<div class="input-group w-100">
												<label for="searchGroups" class="control-label"><?php echo $Translation['search groups'] ; ?></label> &nbsp;
												<input type="text" class="form-control" style="font-weight:100;" placeholder="Search group" id="searchGroups" name="searchGroups" value="<?php echo $searchHTML; ?>" size="20">
												<div class="input-group-append">
													<button type="submit" class="btn btn-primary search-btn">Go!</button>
												</div>
											</div>
										</form>
									</th>
								</tr>
								<tr>
									<th><a><?php echo $Translation["group"]  ; ?></a></th>
									<th><a><?php echo $Translation["description"] ; ?></a></th>
									<th><a><?php echo $Translation['members count'] ; ?></a></th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php

									$res = sql("select groupID, name, description from membership_groups $where limit $start, ".$adminConfig['groupsPerPage'], $eo);
									while( $row = db_fetch_row($res)){
										$groupMembersCount = sqlValue("select count(1) from membership_users where groupID='$row[0]'");
										?>
										<tr>
											<td><a href="pageEditGroup.php?groupID=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></td>
											<td><a><?php echo thisOr($row[2]); ?></a></td>
											<td class="text-left"><a><?php echo $groupMembersCount; ?></a></td>
											<td class="text-center">
												<a href="pageEditGroup.php?groupID=<?php echo $row[0]; ?>" title="<?php echo $Translation['Edit group']; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
												<?php if(!$groupMembersCount){ ?>
														<a href="pageDeleteGroup.php?groupID=<?php echo $row[0]; ?>" 
														title="<?php echo $Translation['delete group'] ; ?>" 
														onClick="return confirm('<?php echo $Translation['confirm delete group'] ; ?>');">
															<i class="glyphicon glyphicon-trash text-danger"></i>
														</a>
												<?php }else{ ?>
														<i class="glyphicon glyphicon-trash text-muted"></i>
												<?php } ?>
												<a href="pageEditMember.php?groupID=<?php echo $row[0]; ?>" title="<?php echo $Translation["add new member"]; ?>"><i class="glyphicon glyphicon-plus text-success"></i></a>
												<a href="pageViewRecords.php?groupID=<?php echo $row[0]; ?>" title="<?php echo $Translation['view group records'] ; ?>"><i class="ti-calendar"></i></a>
												<?php if($groupMembersCount){ ?>
														<a href="pageViewMembers.php?groupID=<?php echo $row[0]; ?>" title="<?php echo $Translation['view group members'] ; ?>"><i class="glyphicon glyphicon-user"></i></a>
														<a href="pageMail.php?groupID=<?php echo $row[0]; ?>" title="<?php echo $Translation['send message to group']; ?>"><i class="glyphicon glyphicon-envelope"></i></a>
												<?php }else{ ?>
														<i class="glyphicon glyphicon-user text-muted"></i>
														<i class="glyphicon glyphicon-envelope text-muted"></i>
												<?php } ?>
											</td>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>
						<div class="row pagination-section">
							<div class="col-xs-4 col-md-3 col-lg-2 vspacer-lg">
								<a href="pageViewGroups.php?searchGroups=<?php echo $searchHTML; ?>&page=<?php echo ($page > 1 ? $page - 1 : 1); ?>"><button class="btn btn-outline-primary btn-block"><span class="hidden-xs"><?php echo $Translation['previous']; ?></span><i class="glyphicon glyphicon-chevron-left"></i></button></a>
							</div>
							<div class="col-xs-4 col-md-6 col-lg-8 text-center">
								<?php 
									$originalValues =  array ('<GROUPNUM1>','<GROUPNUM2>','<GROUPS>' );
									$replaceValues = array ( $start+1 , $start+db_num_rows($res) , $numGroups );
									echo str_replace ( $originalValues , $replaceValues , $Translation['displaying groups'] );
								?>
							</div>
							<div class="col-xs-4 col-md-3 col-lg-2 vspacer-lg">
								<a href="pageViewGroups.php?searchGroups=<?php echo $searchHTML; ?>&page=<?php echo ($page < ceil($numGroups / $adminConfig['groupsPerPage']) ? $page + 1 : ceil($numGroups / $adminConfig['groupsPerPage'])); ?>"><button class="btn btn-primary btn-block"><span class="hidden-xs"><?php echo $Translation['next'] ; ?></span><i class="glyphicon glyphicon-chevron-right"></i></button></a>
							</div>
						</div>
						<hr>
						<div class="col-md-12 p-5">
							<b><?php echo $Translation['key'] ; ?></b>
							<div class="row">
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="glyphicon glyphicon-pencil text-info"></i> <?php echo $Translation['edit group details'] ; ?></div>
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="glyphicon glyphicon-trash text-danger"></i> <?php echo $Translation['delete group'] ; ?></div>
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="glyphicon glyphicon-plus text-success"></i> <?php echo $Translation['add member to group'] ; ?></div>
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="ti-calendar text-info"></i> <?php echo $Translation['view data records'] ; ?></div>
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="glyphicon glyphicon-user text-info"></i> <?php echo $Translation['list group members'] ; ?></div>
								<div class="col-sm-6 col-md-4 col-lg-3"><i class="glyphicon glyphicon-envelope text-info"></i> <?php echo $Translation['send email to all members'] ; ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="adminActions">
		<a class="btn btn-warning float-btn-2" href="pageEditGroup.php" title="Add Group"><i class="ti-plus"></i></a>
	</div>
</div>
<style>
	.form-inline .form-group{ margin: 0.5em 1em; }
</style>

<?php
	include("{$currDir}/incFooter.php");
?>
