<?php
function _basehost($hostonly = false) {
    if ( isset($_SERVER["HTTP_HOST"]) && !is_null($_SERVER["HTTP_HOST"]) ) {
        $schema = ( isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? "https://": "http://";
        $host = $_SERVER["HTTP_HOST"];
        return ( $hostonly ? $host : $schema.$host );
    }
    return null;
}

function _baseurl() {
    if ( isset($_SERVER['SCRIPT_NAME']) && !is_null($_SERVER['SCRIPT_NAME']) ) {
        $base = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
        if ( $base != '/') $base = rtrim($base,'/');
        $host = _basehost();
        $base = ( !is_null($host) ? ( ( $base != '/' ) ? $host.$base : $host."/".$base ) : ( ( $base != '/' ) ? $base : "" ) );
        return rtrim($base,'/');
    }
    return null;
}

