<?php
include_once("./webapp/functions.php");
$self_baseurl = _baseurl();
header("Content-Type: application/json; charset=UTF8");
?>
{
    "short_name": "SNA",
    "name": "SNA",
    "start_url": "<?php echo $self_baseurl;?>/webapp-startup.php",
    "display": "standalone",
    "background_color": "#FAFAFA",
    "theme_color": "#333333",
    "orientation": "portrait",
    "icons": [
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-48x48.png",
            "type": "image/png",
            "sizes": "48x48"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-96x96.png",
            "type": "image/png",
            "sizes": "96x96"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-144x144.png",
            "type": "image/png",
            "sizes": "144x144"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/touch-icon-ipad-retina.png",
            "type": "image/png",
            "sizes": "152x152"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-192x192.png",
            "type": "image/png",
            "sizes": "192x192"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-256x256.png",
            "type": "image/png",
            "sizes": "256x256"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-384x384.png",
            "type": "image/png",
            "sizes": "384x384"
        },
        {
            "src": "<?php echo $self_baseurl;?>/webapp/icon-512x512.png",
            "type": "image/png",
            "sizes": "512x512"
        }
    ]
}
