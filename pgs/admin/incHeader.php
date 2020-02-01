<?php
include_once("../webapp/functions.php");
$self_baseurl = _baseurl();
?>
<!DOCTYPE html>
<?php if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php echo datalist_db_encoding; ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PufferGroup | <?php echo $Translation['admin area']; ?><?php echo html_attr(isset($GLOBALS['page_title']) ? " | {$GLOBALS['page_title']}" : ''); ?></title>
<!-- start webapp -->
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1.0, user-scalable=yes" name="viewport">
<meta content="notranslate" name="google">
<meta content="noarchive" name="googlebot">
<link href="<?php echo $self_baseurl;?>/../webapp/favicon.ico" type="image/x-icon" rel="shortcut icon">
<meta content="#000000" name="theme-color">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="yes" name="mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="IMS" name="application-name">
<meta content="IMS" name="apple-mobile-web-app-title">
<meta content="telephone=no" name="format-detection">
<meta content="none" name="msapplication-config">
<link href="<?php echo $self_baseurl;?>/../manifest-json.php" rel="manifest">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-iphone.png" sizes="57x57" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-ipad.png" sizes="76x76" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-iphone-retina.png" sizes="120x120" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-ipad-retina.png" sizes="152x152" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-ipad-pro.png" sizes="167x167" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/webapp-iphone-6-plus.png" sizes="180x180" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-192x192.png" sizes="192x192" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-128x128.png" sizes="128x128" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-96x96.png" sizes="96x96" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-64x64.png" sizes="64x64" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-48x48.png" sizes="48x48" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-48x48.png" sizes="48x48" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/icon-32x32.png" sizes="32x32" rel="icon">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-320x460.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (device-height: 460px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-1536x2008.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/../webapp/apple-touch-startup-image-2048x1496.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

<!-- /start webapp -->

		<!-- <link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>resources/table_icons/administrator.png"> -->
		<link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>../images/logo/browser-icon.png">

		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/bootstrap.css">
		<!--[if gt IE 8]><!-->
			<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/bootstrap-theme.css">
		<!--<![endif]-->
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dynamic.css.php">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/css/style.css">

		<!--[if lt IE 9]>
			<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->
		<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery-1.12.4.min.js"></script>
		<script>var $j = jQuery.noConflict(); var AppGini = AppGini || {};</script>
		<script src="toolTips.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/bootstrap.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/scriptaculous.js?load=effects"></script>
		<script>

			// VALIDATION FUNCTIONS FOR VARIOUS PAGES

			function jsValidateEmail(address){
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if(reg.test(address) == false){
					modal_window({ message: '<div class="alert alert-danger">'+"<?php echo $Translation['invalid email'];?>"+'</div>', title: "<?php echo $Translation['error'] ; ?>"  });
					return false;
				}else{
					return true;
				}
			}

			function jsShowWait(){
				return window.confirm("<?php echo $Translation['sending mails']; ?>");
			}

			function jsValidateAdminSettings(){
				var p1=document.getElementById('adminPassword').value;
				var p2=document.getElementById('confirmPassword').value;
				if(p1=='' || p1==p2){
					return jsValidateEmail(document.getElementById('senderEmail').value);
				}else{
					modal_window({ message: '<div class="alert alert-error">'+"<?php echo $Translation['password mismatch']; ?>"+'</div>', title: "<?php echo $Translation['error'] ; ?>" });
					return false;
				}
			}

			function jsConfirmTransfer(){
				var confirmMessage;
				var sg=document.getElementById('sourceGroupID').options[document.getElementById('sourceGroupID').selectedIndex].text;
				var sm=document.getElementById('sourceMemberID').value;
				var dg=document.getElementById('destinationGroupID').options[document.getElementById('destinationGroupID').selectedIndex].text;
				if(document.getElementById('destinationMemberID')){
					var dm=document.getElementById('destinationMemberID').value;
				}
				if(document.getElementById('dontMoveMembers')){
					var dmm=document.getElementById('dontMoveMembers').checked;
				}
				if(document.getElementById('moveMembers')){
					var mm=document.getElementById('moveMembers').checked;
				}

				//confirm('sg='+sg+'\n'+'sm='+sm+'\n'+'dg='+dg+'\n'+'dm='+dm+'\n'+'mm='+mm+'\n'+'dmm='+dmm+'\n');

				if(dmm && !dm){
					modal_window({ message: '<div>'+"<?php echo $Translation['complete step 4']; ?>"+'</div>', title: "<?php echo $Translation['info']; ?>", close: function(){ /* */ jQuery('#destinationMemberID').focus(); } });
					return false;
				}

				if(mm && sm!='-1'){

					confirmMessage = "<?php echo $Translation['sure move member']; ?>";
					confirmMessage = confirmMessage.replace(/<MEMBER>/, sm).replace(/<OLDGROUP>/, sg).replace(/<NEWGROUP>/, dg);
					return window.confirm(confirmMessage);

				}
				if((dmm || dm) && sm!='-1'){

					confirmMessage = "<?php echo $Translation['sure move data of member']; ?>";
					confirmMessage = confirmMessage.replace(/<OLDMEMBER>/, sm).replace(/<OLDGROUP>/, sg).replace(/<NEWMEMBER>/, dm).replace(/<NEWGROUP>/, dg);                 
					return window.confirm(confirmMessage);
				}

				if(mm){

					confirmMessage = "<?php echo $Translation['sure move all members']; ?>";
					confirmMessage = confirmMessage.replace(/<OLDGROUP>/, sg).replace(/<NEWGROUP>/, dg);
					return window.confirm(confirmMessage);
				}

				if(dmm){


					confirmMessage = "<?php echo $Translation['sure move data of all members']; ?>";
					confirmMessage = confirmMessage.replace(/<OLDGROUP>/, sg).replace(/<MEMBER>/, dm).replace(/<NEWGROUP>/, dg);
					return window.confirm(confirmMessage);
				}
			}

			function showDialog(dialogId){
				$$('.dialog-box').invoke('addClassName', 'hidden-block');
				$(dialogId).removeClassName('hidden-block');
				return false
			};

			function hideDialogs(){
				$$('.dialog-box').invoke('addClassName', 'hidden-block');
				return false
			};


			$j(function(){
				$j('input[type=submit],input[type=button]').each(function(){
					var label = $j(this).val();
					var onclick = $j(this).attr('onclick') || '';
					var name = $j(this).attr('name') || '';
					var type = $j(this).attr('type');

					$j(this).replaceWith('<button class="btn btn-primary" type="' + type + '" onclick="' + onclick + '" name="' + name + '" value="' + label + '">' + label + '</button>');
				});

				/* fix links inside alerts */
				$j('.alert a:not(.btn)').addClass('alert-link');
			});

		</script>

		<link rel="stylesheet" href="adminStyles.css">

		<style>
			.dialog-box{
				background-color: white;
				border: 1px solid silver;
				border-radius: 10px 10px 10px 10px;
				box-shadow: 0 3px 100px silver;
				left: 30%;
				padding: 10px;
				position: absolute;
				top: 20%;
				width: 40%;
			}
			.hidden-block{
				display: none;
			}
			.menu-item-icon{
				margin-right: .5em;
			}
			.rtl .menu-item-icon{
				margin-right: inherit !important;
				margin-left: .5em;
			}
		</style>


<!-- start webapp -->
<script>
/* safari fix */
(function(document,navigator,standalone) {                          
    if (standalone in navigator && navigator[standalone]) {         
        var curnode,location=document.location,stop=/^(a|html)$/i;  
        document.addEventListener("click", function(e) {            
            curnode=e.target;                                       
            while (!stop.test(curnode.nodeName)) {                  
                curnode=curnode.parentNode;                         
            }                                                       
            if ("href" in curnode && (curnode.href.indexOf("http") || ~curnode.href.indexOf(location.host)) && curnode.target == false) {
                e.preventDefault();                                 
                location.href=curnode.href;                         
            }                                                       
        },false);                                                   
    }                                                               
})(document,window.navigator,"standalone");
</script>
<!-- /start webapp -->

	</head>
	<body>
		<!-- top navbar -->
	<header class="topbar" style="position: fixed; top: 0px; width: 100%;">
		<nav class="navbar top-navbar navbar-expand-md navbar-light" role="navigation">
			<!-- ============================================================== -->
			<!-- Logo -->
			<!-- ============================================================== -->
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo PREPEND_PATH; ?>index.php">
					<!-- Logo icon --><b>
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
						<img src="../images/logo/icon.png" alt="homepage" class="icon dark-logo">
						<!-- Light Logo icon -->
						<img src="../images/logo/light-icon.png" alt="homepage" class="light-logo">
					</b>
					<!--End Logo icon -->
					<!-- Logo text --><span>
						<!-- dark Logo text -->
						<img src="../images/logo/text.png" alt="homepage" class="text dark-logo">
						<!-- Light Logo text -->    
						<img src="../images/logo/light-text.png" class="light-logo" alt="homepage"></span> </a>
			</div>
			<!-- ============================================================== -->
			<!-- End Logo -->
			<!-- ============================================================== -->
			<!-- <div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only"><?php echo $Translation['toggle navigation'];?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand" href="pageHome.php"><span class="text-info"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></span></a>
			</div> -->

		<div class="navbar-collapse">
			<ul class="navbar-nav mr-auto mt-md-0 "></ul>
			<ul class="navbar-nav my-lg-0">
			<div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:grey !important;"><i class="fa fa-user-circle" style="font-size: 4rem;vertical-align: middle;"></i></a>
				<div class="dropdown-menu dropdown-menu-right animated flipInY">
					<ul class="dropdown-user">
						<li>
							<div class="dw-user-box">
								<div class="u-img"><i class="fa fa-user-circle" style="font-size: 5rem;"></i></div>
								<div class="u-text">
									<h4><?php echo getLoggedMemberID(); ?></h4>
									<a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="btn btn-rounded btn-danger btn-sm no-margin">View Profile</a></div>
							</div>
						</li>
						<?php if(getLoggedAdmin()){ ?>
						<li role="separator" class="divider"></li>
						<li><a class="user-menu" href="<?php echo PREPEND_PATH; ?>index.php"><i class="fa fa-cog"></i><?php echo $Translation["user's area"] ; ?></a></li>
						<?php } ?>
						<li role="separator" class="divider"></li>
						<li><a class="user-menu" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="fa fa-power-off"></i> <?php echo $Translation['sign out']; ?></a></li>
					</ul>
				</div>
			</div>
			</ul>
		</div>
		</nav>
	</header>

	<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
				<nav class="sidebar-nav active" role="navigation">
					<div class="navbar-header">
							<ul class="in top-menu" style="display: -webkit-inline-box;">
								<li class="dropdown">
									<a href="#" class="topbar dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-globe"></i> <?php echo $Translation['groups']; ?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="pageViewGroups.php"><i class="glyphicon menu-item-icon text-info glyphicon-eye-open"></i> <?php echo $Translation['view groups']; ?></a></li>
										<li><a href="pageEditGroup.php"><i class="glyphicon menu-item-icon text-info glyphicon-plus"></i> <?php echo   $Translation['add group']  ; ?></a></li>
										<li class="divider"></li>
										<li><a href="pageEditGroup.php?groupID=<?php echo sqlValue("select groupID from membership_groups where name='" . makeSafe($adminConfig['anonymousGroup']) . "'"); ?>"><i class="glyphicon menu-item-icon text-info glyphicon-user"></i> <?php echo  $Translation['edit anonymous permissions'] ; ?></a></li>
									</ul>
								</li>

								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $Translation['members']  ;?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="pageViewMembers.php"><i class="glyphicon menu-item-icon text-info glyphicon-eye-open"></i> <?php echo $Translation['view members'] ; ?></a></li>
										<li><a href="pageEditMember.php"><i class="glyphicon menu-item-icon text-info glyphicon-plus"></i> <?php echo $Translation['add member']  ; ?></a></li>
										<li class="divider"></li>
										<li><a href="pageViewRecords.php"><i class="glyphicon menu-item-icon text-info glyphicon-th"></i> <?php echo $Translation["view members' records"]; ?> </a></li>
									</ul>
								</li>

								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation["utilities"] ; ?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="pageSettings.php"><i class="glyphicon menu-item-icon text-info glyphicon-cog"></i> <?php echo $Translation["admin settings"]  ; ?></a></li>
										<li class="divider"></li>
										<li><a href="pageRebuildThumbnails.php"><i class="glyphicon menu-item-icon text-info glyphicon-picture"></i> <?php echo  $Translation["rebuild thumbnails"]  ; ?></a></li>
										<li><a href="pageRebuildFields.php"><i class="glyphicon menu-item-icon text-info glyphicon-refresh"></i> <?php echo  $Translation['rebuild fields'] ; ?></a></li>
										<li><a href="pageUploadCSV.php"><i class="glyphicon menu-item-icon text-info glyphicon-upload"></i> <?php echo $Translation['import CSV'] ; ?></a></li>
										<li><a href="pageTransferOwnership.php"><i class="glyphicon menu-item-icon text-info glyphicon-random"></i> <?php echo $Translation['batch transfer'] ; ?></a></li>
										<li><a href="pageMail.php?sendToAll=1"><i class="glyphicon menu-item-icon text-info glyphicon-envelope"></i> <?php echo $Translation['mail all users'] ; ?></a></li>
										<li><a href="pageBackupRestore.php"><i class="glyphicon menu-item-icon text-info glyphicon-tasks"></i> <?php echo $Translation['database backups'] ; ?></a></li>
										<li class="divider"></li>
										<li><a href="https://forums.appgini.com" target="_blank"><i class="glyphicon menu-item-icon text-info glyphicon-new-window"></i> <?php echo $Translation['AppGini forum']; ?></a></li>
									</ul>
								</li>

								<?php $plugins = get_plugins(); ?>

								<?php if(count($plugins)){ ?>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-plus"></i> <?php echo $Translation["plugins"] ; ?> <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<?php foreach($plugins as $plugin){ ?>
												<?php
													$plugin_icon = '';
													if($plugin['glyphicon']) $plugin_icon = "<i class=\"glyphicon glyphicon-{$plugin['glyphicon']}\"></i> ";
													if($plugin['icon']) $plugin_icon = "<img src=\"{$plugin['admin_path']}/{$plugin['icon']}\"> ";
												?>
												<li><a target="_blank" href="<?php echo $plugin['admin_path']; ?>"><?php echo $plugin_icon . $plugin['title']; ?></a></li>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
							</ul>
					</div>
				</nav>
			</div>
		</aside>

	
<div class="page-wrapper ps ps--theme_default">
<div class="container-fluid">

		<script>
			/* periodically check if user is still signed in */
			setInterval(function(){
				$j.ajax({
					url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
					success: function(username){
						if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
					}
				});
			}, 60000);
		</script>

		<?php echo handle_maintenance(true); ?>
		<div style="height: 40px;"></div>

		<?php echo Notification::placeholder(); ?>

		<!-- tool tips support -->
		<div id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100"></div>
		<script src="toolTipData.js"></script>
		<!-- /tool tips support -->

<?php
	if(!strstr($_SERVER['PHP_SELF'], 'pageSettings.php') && $adminConfig['adminPassword'] == md5('admin')){
		$noSignup=TRUE;
		?>
		<div class="alert alert-danger">
			<p><strong><?php echo $Translation["attention"] ; ?></strong></p>
			<p><?php if($adminConfig['adminUsername'] == 'admin'){
					echo $Translation['security risk admin'];
			}else{
					echo $Translation['security risk'];
			} ?></p>
		</div>
	<?php  } ?>

