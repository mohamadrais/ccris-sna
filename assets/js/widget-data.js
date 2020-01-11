/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function () {
    "use strict";
    // ============================================================== 
    // Foo1 total visit
    // ============================================================== 
    var opts = {
          angle: 0, // The span of the gauge arc
          lineWidth: 0.42, // The line thickness
          radiusScale: 1, // Relative radius
          pointer: {
            length: 0.64, // // Relative to gauge radius
            strokeWidth: 0.04, // The thickness
            color: '#000000' // Fill color
          },
          limitMax: false,     // If false, the max value of the gauge will be updated if value surpass max
          limitMin: false,     // If true, the min value of the gauge will be fixed unless you set it manually
          colorStart: '#ad3a62',   // Colors
          colorStop: '#ad3a62',    // just experiment with them
          strokeColor: '#E0E0E0',  // to see which ones work best for you
          generateGradient: true,
          highDpiSupport: true     // High resolution support
        };
    var target = document.getElementById('foo'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 3000; // set max gauge value
    gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge.animationSpeed = 45; // set animation speed (32 is default value)
    gauge.set(1850); // set actual value 
    // ============================================================== 
    // Foo1 total visit
    // ============================================================== 
    var opts = {
          angle: 0, // The span of the gauge arc
          lineWidth: 0.42, // The line thickness
          radiusScale: 1, // Relative radius
          pointer: {
            length: 0.64, // // Relative to gauge radius
            strokeWidth: 0.04, // The thickness
            color: '#000000' // Fill color
          },
          limitMax: false,     // If false, the max value of the gauge will be updated if value surpass max
          limitMin: false,     // If true, the min value of the gauge will be fixed unless you set it manually
          colorStart: '#173C6A',   // Colors
          colorStop: '#173C6A',    // just experiment with them
          strokeColor: '#E0E0E0',  // to see which ones work best for you
          generateGradient: true,
          highDpiSupport: true     // High resolution support
        };
    var target = document.getElementById('foo2'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 3000; // set max gauge value
    gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge.animationSpeed = 45; // set animation speed (32 is default value)
    gauge.set(850); // set actual value 
    // ============================================================== 
    // Foo1 total visit
    // ============================================================== 
    var opts = {
          angle: 0, // The span of the gauge arc
          lineWidth: 0.42, // The line thickness
          radiusScale: 1, // Relative radius
          pointer: {
            length: 0.64, // // Relative to gauge radius
            strokeWidth: 0.04, // The thickness
            color: '#000000' // Fill color
          },
          limitMax: false,     // If false, the max value of the gauge will be updated if value surpass max
          limitMin: false,     // If true, the min value of the gauge will be fixed unless you set it manually
          colorStart: '#f62d51',   // Colors
          colorStop: '#f62d51',    // just experiment with them
          strokeColor: '#E0E0E0',  // to see which ones work best for you
          generateGradient: true,
          highDpiSupport: true     // High resolution support
        };
    var target = document.getElementById('foo3'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 3000; // set max gauge value
    gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge.animationSpeed = 45; // set animation speed (32 is default value)
    gauge.set(1250); // set actual value 
    
    // ============================================================== 
    // Foo1 total visit
    // ============================================================== 
    var opts = {
          angle: 0, // The span of the gauge arc
          lineWidth: 0.42, // The line thickness
          radiusScale: 1, // Relative radius
          pointer: {
            length: 0.64, // // Relative to gauge radius
            strokeWidth: 0.04, // The thickness
            color: '#000000' // Fill color
          },
          limitMax: false,     // If false, the max value of the gauge will be updated if value surpass max
          limitMin: false,     // If true, the min value of the gauge will be fixed unless you set it manually
          colorStart: '#55ce63',   // Colors
          colorStop: '#55ce63',    // just experiment with them
          strokeColor: '#E0E0E0',  // to see which ones work best for you
          generateGradient: true,
          highDpiSupport: true     // High resolution support
        };
    var target = document.getElementById('foo4'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 3000; // set max gauge value
    gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge.animationSpeed = 45; // set animation speed (32 is default value)
    gauge.set(2850); // set actual value   

    // ============================================================== 
    // sparkline charts
    // ==============================================================
    var sparklineLogin = function() { 
       
  
        $("#spark1").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#55ce63',
            fillColor: '#55ce63',
            maxSpotColor: '#55ce63',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#55ce63'
        });
        $("#spark2").sparkline([0,2,8,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#ad3a62',
            fillColor: '#ad3a62',
            minSpotColor:'#ad3a62',
            maxSpotColor: '#ad3a62',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#ad3a62'
        });
        $("#spark3").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#173C6A',
            fillColor: '#173C6A',
            maxSpotColor: '#173C6A',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#173C6A'
        });
        $("#spark4").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#fff',
            fillColor: '#173C6A',
            maxSpotColor: '#173C6A',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#173C6A'
        });
        $("#spark5").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#fff',
            fillColor: '#ad3a62',
            maxSpotColor: '#ad3a62',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#ad3a62'
        });
        $("#spark6").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#fff',
            fillColor: '#55ce63',
            maxSpotColor: '#55ce63',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#55ce63'
        });
        $("#spark7").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#fff',
            fillColor: '#ffbc34',
            maxSpotColor: '#ffbc34',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#ffbc34'
        });
        $('#spark8').sparkline([ 4, 5, 0, 10, 9, 12, 4, 9], {
            type: 'bar',
            width: '100%',
            height: '70',
            barWidth: '8',
            resize: true,
            barSpacing: '5',
            barColor: '#55ce63'
        });
         $('#spark9').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            width: '100%',
            height: '70',
            barWidth: '8',
            resize: true,
            barSpacing: '5',
            barColor: '#173C6A'
        });
          $('#spark10').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            width: '100%',
            height: '70',
            barWidth: '8',
            resize: true,
            barSpacing: '5',
            barColor: '#03a9f3'
        });
           $('#spark11').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            width: '100%',
            height: '70',
            barWidth: '8',
            resize: true,
            barSpacing: '5',
            barColor: '#f62d51'
        });
        $('#sparklinedash').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#55ce63'
        });
         $('#sparklinedash2').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#173C6A'
        });
          $('#sparklinedash3').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#03a9f3'
        });
           $('#sparklinedash4').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#f62d51'
        });
       
   }
    var sparkResize;
 
        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 500);
        });
        sparklineLogin();
});