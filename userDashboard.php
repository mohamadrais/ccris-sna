<?php // if(!isset($Translation)){ @header('Location: index.php'); exit; } 
?>
<?php
$currDir = dirname(__FILE__);
include_once("{$currDir}/defaultLang.php");
include_once("{$currDir}/language.php");
include_once("{$currDir}/lib.php");
include_once("$currDir/header.php");
?>
<?php if (!defined('PREPEND_PATH')) define('PREPEND_PATH', ''); ?>
<?php
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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="assets/scss/style.scss">
<style>
	.panel-body-description {
		margin-top: 10px;
		height: 100px;
		overflow: auto;
	}

	.panel-body .btn img {
		margin: 0 10px;
		max-height: 32px;
	}
</style>
<script>
</script>



<!-- <div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse1" id="dash-sidebar-nav">
		<ul class="nav" id="side-menu" style="padding: 12px;"> -->
<div class="page-wrapper ps ps--theme_default">
	<div class="container-fluid">
		<div class="col-lg-6">
			<div class="card mt-0 p-0" style="height: 606px">
				<div class="card-body">
					<h4 class="card-title">Portfolio</h4>
					<h6 class="card-subtitle">
						user's entries and work log records.
						<div class="pull-right">
							<i class="ti-list mr-2"></i>156 entries
						</div>
					</h6>
					<div class="table-responsive tableFixHead m-t-40" style="height: 470px;">
						<table class="table table-hover v-middle" style="max-height: 600px; overflow: scroll;">
							<thead>
								<tr>
									<th style="width: 60px;"> Company </th>
									<th> Table </th>
									<th> Created </th>
									<th> Modified </th>
									<th> Data </th>
								</tr>
							</thead>
							<tbody class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 570px;">
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-circle" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									<td>
										Doc Control
									</td>
									<td> 12/01/2020 </td>
									<td> 12/01/2020 </td>
									<td>
										Lorum Ipsum
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="card mt-0 p-0">
				<div class="card-body">
					<h4 class="card-title">Company List</h4>
					<h6 class="card-subtitle">
						user's company related.
					</h6>
					<div class="company-list-container">
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
						<div class="card float mt-0 mb-3">
							<section class="cardHeader">
								<div class="row">
									<div class="col-md-2">
										<img class="img-circle" style="width: 90px;" src="assets/images/no-logo.png" alt="user" width="50"> </td>
									</div>
									<div class="col-md-10">
										<h4 href="#" class="card-title font-bold">Puffer Group
										<button class="btn btn-xs btn-primary ml-3 pull-right">Login Account</button></h4>
										<h6 class="card-subtitle">
											Kawasan Perindustrian, Bukit Serdang, 43300 Seri Kembangan, Selangor.
										</h6>
									</div>
								</div>
							</section>
							<section class="nonSharedContent">
								<section class="greySquaresContainer">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover v-middle">
												<thead>
													<tr>
														<th> Table </th>
														<th> Created </th>
														<th> Modified </th>
														<th> Data </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
													<tr>
														<td>
															Doc Control
														</td>
														<td> 12/01/2020 </td>
														<td> 12/01/2020 </td>
														<td>
															Lorum Ipsum
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card float mt-0 mb-3">
			<div class="card-body">
			<ul class="text-themecolor m-b-0 m-t-0">
				<?php
				/* accessible tables */
				$userLoggedIn = true;
				$resultUserDashboardData = $_SESSION['resultUserDashboardData'];
				$token = $_SESSION['token'];
				$username = $_SESSION['memberID'];
				if ($resultUserDashboardData && count($resultUserDashboardData) > 0) { ?>
					<!-- <h4 style="border-bottom:1px"> I am logged in as 
						<?php
							// echo $username 
							?> with token 
						<?php
							// echo $token 
							?> </h4> -->
					<!-- <div style="width:100%;background:teal; padding:2em; color:white">
						<h4> I am logged in as <?php echo $username ?> </h4>
					</div> -->
					<?php
						// 					$table = <<< TABLE
						// 		<table border="0">
						// 		<tbody><tr><td>
						// TABLE;
						// if($resultUserDashboardData && count($resultUserDashboardData)>0){

						// $i=0;
						foreach ($resultUserDashboardData as $arr) {

							$j = 0;
							$url = '';
							foreach ($arr as $a) {

								if ($j == 0) {
									$url = $a;
								} else if ($j == 1) {
									//company name
									?>
									<div class="w3-container">
									<div class="card">
		
		<!-- <div class="front side">
		<h1 class="logo">Zach Saucier</h1>
		</div>
		
		<div class="back side">
		<h3 class="name">Zach Saucier</h3>
		<div>Front-end developer</div>      
		<div class="info">
			<p><span class="property">Email: </span>hello@zachsaucier.com</p>
			<p><span class="property">Twitter: </span>@ZachSaucier</p>
			<p><span class="property">Phone: </span>(123) 456-7890</p>
			<p><span class="property">Website: </span>zachsaucier.com</p>
		</div>
		</div> -->
		
	</div>
									<h3>
										<b><u><?php echo $a ?></b></u>
									</h3>
								<?php
								} else if ($j == 2) {
								// company address
								?>
									<h4>
										<?php echo $a ?>
									</h4>
									<h5>Continue as</h5>

									<form method="post" action="<?php echo $url ?>/index.php">
										<input type="hidden" name="token" id="token" value="<?php echo $token ?>">

										<input type="hidden" name="rememberMe" id="rememberMe" value="1">
										<button name="signIn" type="submit" id="submit" value="signIn" style="background: none;color: inherit;border:1px solid grey;padding: 5px;font: inherit;cursor: pointer;outline: inherit;width:inherit" class="w3-hover-shadow">
											<img src="assets/images/cutomer-icon-copy.png" alt="Admin-logo" style="width:50%;">
										<?php
								} else if ($j == 3) {
								//username/memberID
										?> 
											<input type="hidden" name="username" id="username" value="<?php echo $a ?>">
										<?php
								} else if ($j == 4) {
								//username/email
										?> 
										<div class="w3-container w3-center">
											<h4>
												<?php echo $a ?>
											</h4>
										<?php
								} else if ($j == 6) {
								//role
										?>
											<h5>
												<?php echo '(' . $a . ')' ?>
											<h5>
										</div>
										</button>
									</form>
							<?php
								}
										$j++;
							}
									// $table .='<td>';
									// $table .='</td>';
									?>
								</div>
								<hr /> <?php
												// $i++;
						}



											// $table .= "test</td></tr></tbody></table>";
											// printf($table);

											// }

											?>

							<!-- <div class="w3-container">
						<h3>PGS66 - 66 Sdn Bhd</h3>
						<h4>No 1, Jalan Terus 1, Putra Heights, 47650 Subang Jaya</h4>
						<h5>Continue as</h5>
						<form method="post" action="pgs66/index.php">
							<input type="hidden" name="username" id="username" value="administrator">
							<input type="hidden" name="password" id="password" value="administrator">
							<input type="hidden" name="rememberMe" id="rememberMe" value="1">
							<button name="signIn" type="submit" id="submit" value="signIn" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;width:inherit" class="w3-hover-shadow">
								<div class="w3-card-4" style="height:280px;text-align:center;padding:2em;">
									<img src="assets/images/cutomer-icon-copy.png" alt="Admin-logo" style="width:50%;">
									<div class="w3-container w3-center">
										<h4>Adminsitrator</h4>
										<h5>(Admin)</h5>
									</div>
								</div>
							</button>
						</form>
					</div> -->
						<?php
						} else {
							?><script>
								window.location = 'index.php?signIn=1';
							</script><?php
										}
										?>
			</ul>
		</div>
	<!-- /.sidebar-collapse -->
		</div>
	</div>]
</div>
<!-- /.navbar-static-side -->
<footer class="footerd">
	Powered by Supply Network Agency PLT
</footer>
<!-- /#page-wrapper -->
<!-- <script>
	$j(function(){
		//demo.initBarChartMoris();
		
		$j('.container').removeClass('container').addClass('container-full');
		$j('.sidebar').perfectScrollbar();
		$j('#page-wrapper').perfectScrollbar();
		$j("li a:contains('Misc.')").hide();
		var table_descriptions_exist = false;
		$j('div[id$="-tile"] .panel-body-description').each(function(){
			if($j.trim($j(this).html()).length) table_descriptions_exist = true;
		});
		//$j('.navbar-default.sidebar').css("background","#f96332")
		$j('#fa-WorkLocation').removeClass().addClass('fa fa-map-marker fa-5x');
		$j('#fa-Client').removeClass().addClass('fa fa-user fa-5x');
		$j('#fa-Inquiry').removeClass().addClass('fa fa-paperclip fa-5x');
		// $j('#WorkLocation-cd').css("margin" ,"55px 0px");

		$j('#panel-orders').removeClass().addClass('panel panel-green');
		$j('#panel-TeamSoftBoard').removeClass().addClass('panel panel-yellow');
		$j('#panel-IMSReport').removeClass().addClass('panel panel-red');

		$j('#counter-TeamSoftBoard').find('span').text(0)
		$j('#counter-IMSReport').find('span').text(0)

		$j('#caption-TeamSoftBoard').text('Account Payables')
		$j('#caption-IMSReport').text('Claim Submission')
		
        // icon
        $j('#fa-orders').removeClass().addClass('fa fa-file-o fa-5x');
        $j('#fa-TeamSoftBoard').removeClass().addClass('fa fa-briefcase fa-5x');
        $j('#fa-IMSReport').removeClass().addClass('fa fa-check-square-o fa-5x');

		//link
		$j('#href-TeamSoftBoard').attr('href','AccountPayables_view.php')
		$j('#href-IMSReport').attr('href','ClaimRecord_view.php')

		setTimeout(function(){ 
			var getValAccountPayables_view = $j('#AccountPayables_view').contents().find('table tbody').find('tr').length - 1
			if (getValAccountPayables_view > 0){
				$j('#counter-TeamSoftBoard').find('span').text(getValAccountPayables_view)
			}
			var getValueClaimRecord_view = $j('#ClaimRecord_view').contents().find('table tbody').find('tr').length - 1
			if(getValueClaimRecord_view >  0){
				$j('#counter-IMSReport').find('span').text(getValueClaimRecord_view)
			}

		}, 4000);

		
		$j(window).resize(function() {
			if($j(window).width() <= 750){
				$j('.hidden-print').eq(1).css('display','none');
				$j('.hidden-print').eq(2).css('display','none');
				$j('#dash-sidebar-nav').css('margin-top',50);
				$j('.ps__scrollbar-x').css('display','none');
				$j('#side-menu').css('display','none');
				$j('#upperNav').css('display','block');
				$j('#if1').css({"overflow":"scroll","-webkit-overflow-scrolling":"touch"})
				$j('#if2').css({"overflow":"scroll","-webkit-overflow-scrolling":"touch"})
				//style="overflow: scroll; -webkit-overflow-scrolling: touch;"
			}else{
				$j('.hidden-print').eq(1).css('display','block');
				$j('.hidden-print').eq(2).css('display','none');
				$j('#dash-sidebar-nav').css('margin-top',0)
				$j('#side-menu').css('display','block');
				$j('#upperNav').css('display','none');
				$j('#if1').css({"overflow":"unset","-webkit-overflow-scrolling":"touch"})
				$j('#if2').css({"overflow":"unset","-webkit-overflow-scrolling":"touch"})
			}

		});

		if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)){
			$j('iframe').css({'width': '1px','min-width': '100%','*width': '100%'})
		}else{
			//console.log('not match')
		}
		
		 $j('#projects-cd').css("margin" ,"15px 0px");
		$j('#OrgContentContext-mainIco').removeClass().addClass('fa fa-users');
		$j('#employees-mainIco').removeClass().addClass('fa fa-user-secret');
		$j('#orders-mainIco').removeClass().addClass('fa fa-database');
		$j('#vendor-mainIco').removeClass().addClass('fa fa-building');
		$j('#CommConsParticipate-mainIco').removeClass().addClass('fa fa-medkit');
		$j('#TeamSoftBoard-mainIco').removeClass().addClass('fa fa-pie-chart');
		

		if(!table_descriptions_exist){
			$j('div[id$="-tile"] .panel-body-description').css({height: 'auto'});
		}

		$j('.panel-body .btn').height(32);

		$j('.btn-add-new').click(function(){
			var tn = $j(this).attr('id').replace(/_add_new$/, '');
			modal_window({
				url: tn + '_view.php?addNew_x=1&Embedded=1',
				size: 'full',
				title: $j(this).prev().children('.table-caption').text() + ": <?php echo html_attr($Translation['Add New']); ?>" 
			});
			return false;
		});

		/* adjust arrow directions on opening/closing groups, and initially open first group */
		$j('.collapser').click(function(){
			$j(this).children('.glyphicon').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
		});

		/* hide empty table groups */
		$j('.collapser').each(function(){
			var target = $j(this).attr('href');
			if(!$j(target + " .row div").length) $j(this).hide();
		});
		/*$j('.collapser:visible').eq(0).click();*/
	});
</script> -->

<script>
// Initialize
const allCardsHeaders = document.getElementsByClassName("cardHeader");
for(header of allCardsHeaders) {
    header.addEventListener("click", clickCard);
}

function clickCard(e) {
    this.parentElement.classList.toggle('cardActive');
}
</script>

<?php include_once("$currDir/footer.php"); ?>