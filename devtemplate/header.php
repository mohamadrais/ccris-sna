<?php
include_once("./webapp/functions.php");
$self_baseurl = _baseurl();
?>
<!DOCTYPE html>
<?php if(!defined('PREPEND_PATH')) define('PREPEND_PATH', ''); ?>
<?php if(!defined('datalist_db_encoding')) define('datalist_db_encoding', 'iso-8859-1'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php echo datalist_db_encoding; ?>">
		<title><?php echo ucwords('PufferGroup'); ?> | <?php echo (isset($x->TableTitle) ? $x->TableTitle : ''); ?></title>
		<link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>images/logo/browser-icon.png">
<!-- start webapp -->
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1.0, user-scalable=yes" name="viewport">
<meta content="notranslate" name="google">
<meta content="noarchive" name="googlebot">
<link href="<?php echo $self_baseurl;?>/webapp/favicon.ico" type="image/x-icon" rel="shortcut icon">
<meta content="#000000" name="theme-color">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="yes" name="mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="IMS" name="application-name">
<meta content="IMS" name="apple-mobile-web-app-title">
<meta content="telephone=no" name="format-detection">
<meta content="none" name="msapplication-config">
<link href="<?php echo $self_baseurl;?>/manifest-json.php" rel="manifest">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-iphone.png" sizes="57x57" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-ipad.png" sizes="76x76" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-iphone-retina.png" sizes="120x120" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-ipad-retina.png" sizes="152x152" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-ipad-pro.png" sizes="167x167" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/webapp-iphone-6-plus.png" sizes="180x180" rel="apple-webapp">
<link href="<?php echo $self_baseurl;?>/webapp/icon-192x192.png" sizes="192x192" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-128x128.png" sizes="128x128" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-96x96.png" sizes="96x96" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-64x64.png" sizes="64x64" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-48x48.png" sizes="48x48" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-48x48.png" sizes="48x48" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/icon-32x32.png" sizes="32x32" rel="icon">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-320x460.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (device-height: 460px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-1536x2008.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="<?php echo $self_baseurl;?>/webapp/apple-touch-startup-image-2048x1496.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

<!-- /start webapp -->

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/bootstrap.css">
		<!--[if gt IE 8]><!-->
			<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/bootstrap-theme.css">
		<!--<![endif]-->
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/lightbox/css/lightbox.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/select2/select2.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/datepicker/css/datepicker.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dynamic.css.php">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/css/perfect-scrollbar.css">
		
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dist/metisMenu/metisMenu.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dist/css/sb-admin-2.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dist/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/demo/demo.css" />
		<!-- Morris Charts CSS -->
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dist/morrisjs/morris.css" >
		
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/css/style.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/css/daterangepicker.css">

		<!--[if lt IE 9]>
			<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->
		<script src="<?php echo PREPEND_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery-1.12.4.min.js"></script>
		<script>var $j = jQuery.noConflict();</script>
		<script src="<?php echo PREPEND_PATH; ?>resources/moment/moment-with-locales.min.js"></script>
   		<!-- Bootstrap tether Core JavaScript -->
		<script src="<?php echo PREPEND_PATH; ?>assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- slimscrollbar scrollbar JavaScript -->
		<script src="<?php echo PREPEND_PATH; ?>assets/js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="<?php echo PREPEND_PATH; ?>assets/js/waves.js"></script>
		<!--Menu sidebar -->
		<script src="<?php echo PREPEND_PATH; ?>assets/js/sidebarmenu.js"></script>
		<!--stickey kit -->
		<script src="<?php echo PREPEND_PATH; ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
		<!--Custom JavaScript -->
		<script src="<?php echo PREPEND_PATH; ?>assets/js/custom.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery.mark.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/bootstrap.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/scriptaculous.js?load=effects"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/select2/select2.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/jscookie/js.cookie.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/datepicker/js/datepicker.packed.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>common.js.php"></script>
		
		<script src="<?php echo PREPEND_PATH; ?>dist/metisMenu/metisMenu.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>dist/js/sb-admin-2.js"></script>
		<!-- <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>../assets/css/style.css"> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/js/perfect-scrollbar.jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/js/perfect-scrollbar.min.js"></script>
		<!-- Morris Charts JavaScript -->
		<script src="<?php echo PREPEND_PATH; ?>dist/raphael/raphael.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>dist/morrisjs/morris.min.js"></script>
		<!-- <script src="assets/js/plugins/chartjs.min.js"></script> -->
		<!-- <script src="assets/demo/demo.js"></script> -->
		<script src="<?php echo PREPEND_PATH; ?>assets/js/daterangepicker.min.js"></script>
		
		<?php if(isset($x->TableName) && is_file(dirname(__FILE__) . "/hooks/{$x->TableName}-tv.js")){ ?>
			<script src="<?php echo PREPEND_PATH; ?>hooks/<?php echo $x->TableName; ?>-tv.js"></script>
		<?php } ?>

<!-- start webapp -->
<script>
function _service_worker() {

    if ( location.hostname && location.protocol ) {
        var hostname = location.hostname;
        var protocol = location.protocol;
        protocol = protocol.replace(/:/,'');

        if ( protocol !== 'https' && hostname !== 'localhost' ) {
            return;
        }
    }

    if ( 'serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?php echo $self_baseurl;?>/worker-js.php').then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
};
_service_worker();
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
		
			<?php if(function_exists('handle_maintenance')) echo handle_maintenance(true); ?>

			<?php if(!$_REQUEST['Embedded']){ ?>
				<?php if(function_exists('htmlUserBar')) echo htmlUserBar(); ?>
			<?php } ?>

			<?php if(class_exists('Notification')) echo Notification::placeholder(); ?>

			<!-- process notifications -->
			<?php $notification_margin = ($_REQUEST['Embedded'] ? '15px 0px' : '-15px 0 -45px'); ?>
			<?php if(function_exists('showNotifications')) echo showNotifications(); ?>

			<?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/header-extras.php')){ include(dirname(__FILE__).'/hooks/header-extras.php'); } ?>
			<!-- Add header template below here .. -->

