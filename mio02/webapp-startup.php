<?php
include_once("./webapp/functions.php");
$self_baseurl = _baseurl();
?>
<html>
<head>
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
<meta content="notranslate" name="google">
<meta content="noarchive" name="googlebot">
<meta content="noindex,nofollow,noodp,noydir" name="robots">
<meta content="no-cache, no-store, must-revalidate" http-equiv="cache-control">
<meta content="no-cache" http-equiv="pragma">
<meta content="-1" http-equiv="expires">
<title></title>
<script>
function _is_mobile() { 
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}
if ( _is_mobile() ) {
    self.location.replace('<?php echo $self_baseurl.'/';?>');
}
</script>
</head>
<body>
<center>
<img src="<?php echo $self_baseurl;?>/webapp/icon-96x96.png">
</center>
<script>
setTimeout(function() {
    self.location.replace('<?php echo $self_baseurl.'/';?>');
}, 2000);
</script>
</body>
</html>

