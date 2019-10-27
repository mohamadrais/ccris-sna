<?php
include_once("./webapp/functions.php");
$self_baseurl = _baseurl();
header("Content-Type: application/javascript; charset=UTF8");
?>
'use strict';
var __nww_root = '<?php echo $self_baseurl;?>/';
var __nww_version = '20180407abc';
var __nww_cachename = 'nwservice-worker'+__nww_version;
var __nww_offline = __nww_root+'webapp-offline.html';
var __nww_flashpng = __nww_root+'webapp/icon-96x96.png';

var __nww_files = [
        __nww_root,
        __nww_offline,
        __nww_flashpng
    ];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(__nww_cachename).then(function(cache) {
            return cache.addAll(__nww_files);
        }).then(function () {
            return self.skipWaiting();
        })
    );
});

/* offline */
self.addEventListener('fetch', function(event) {
    var request = event.request;

    if ( request.mode === 'navigate' 
        || (request.method === 'GET' 
        && request.headers.get('accept').includes('text/html')) ) {
        event.respondWith(
            fetch(request).then(function(response) {
                if ( !response.ok ) {
                    var code = response.status;
                    if ( /^\d+$/.test(code) == null ) {
                        throw Error(response.status);
                    }
                }
                return response;
            }).catch(function(error) {
                return caches.open(__nww_cachename).then(function (cache) {
                    return cache.match(__nww_offline);
                });
            })
        );
    } else{
        // Respond with everything else if we can
        event.respondWith(
            caches.match(event.request).then(function (response) {
                return response || fetch(event.request);
            })
        );
    }
});

/* updates */
self.addEventListener('activate', function(event) {
    var cacheWhitelist = [__nww_cachename];

    event.waitUntil(
        caches.keys(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if ( cacheWhitelist.indexOf(cacheName) == -1 ) {
                        return caches.delete(cacheName);
                    }
                })
            )
        })
    );
});
