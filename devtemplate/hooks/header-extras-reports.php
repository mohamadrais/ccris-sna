<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('46', {
        packages: ['corechart', 'table']
    });
    google.charts.setOnLoadCallback();

    function load_default_data() {
        $j.ajax({
            url: "hooks/reports-fetch.php",
            method: "POST",
            data: {
                'type': 'load_default_data'
            },
            dataType: "JSON",
            beforeSend: function() {
                $j("div[id^='summaryfor']").each(function(i, el) {
                    $j(el).addClass("dis");
                });
                if($j('#chartLoading').length) $j('#chartLoading').html('<div style="direction: ltr;"><img src="loading.gif"> <?php echo addslashes($Translation['Loading ...']); ?></div>');
		    },
            success: function(data) {
                draw_default_data(data);
            },
            complete: function() {
                if($j('#chartLoading').length) $j('#chartLoading').html('');
                $j("div[id^='summaryfor']").each(function(i, el) {
                    $j(el).removeClass("dis");
                });
            },            
            error: function(data) {
                // console.log('error from ajax: '+ data.responseText);
            }
        });
    }

    function draw_default_data(chart_data) {
        var combined_data = chart_data;

        var topMemberData = new google.visualization.DataTable();
        topMemberData.addColumn('string', 'Members');
        topMemberData.addColumn('number', 'Records');
        topMemberData.addColumn({ type: 'string', role: 'annotation' });

        var memberStatsData = new google.visualization.DataTable();
        memberStatsData.addColumn('string', 'Metric');
        memberStatsData.addColumn('number', 'Count');
        memberStatsData.addColumn({ type: 'string', role: 'style' });

        var topMemberDataPieOptions = {
            legend: 'bottom'
        };

        var topMemberDataBarOptions = {
            legend: 'none',
            annotations: {
                alwaysOutside: true
            },
        };

        var memberStatsDataOptions = {
            legend: {
                position: 'none'
            }
        };

        $j.each(combined_data, function(i, jsonData) {
            if(i < combined_data.length-1){
                var members = jsonData.members;
                var record_counts = parseFloat($j.trim(jsonData.record_counts));

                topMemberData.addRows([
                    [members, record_counts, record_counts.toString()]
                ]);
            }
            else {
                memberStatsData.addRows([
                    ['Total groups', parseFloat($j.trim(jsonData.total_groups)), 'blue'],
                    ['Active members', parseFloat($j.trim(jsonData.active)), 'green'],
                    ['Memebrs awaiting approval', parseFloat($j.trim(jsonData.awaiting)), 'orange'],
                    ['Banned members', parseFloat($j.trim(jsonData.banned)), 'red'],
                    ['Total members', parseFloat($j.trim(jsonData.total_members)), 'purple'],
                ]);
            }

            
        });
        
        var pieTopMembersChart = new google.visualization.PieChart(document.getElementById("pieTopMembers"));
        pieTopMembersChart.draw(topMemberData, topMemberDataPieOptions);
        
        var barTopMembersChart = new google.visualization.BarChart(document.getElementById("barTopMembers"));
        barTopMembersChart.draw(topMemberData, topMemberDataBarOptions);

        var columnMemberStatsChart = new google.visualization.ColumnChart(document.getElementById('columnMemberStats'));
        columnMemberStatsChart.draw(memberStatsData, memberStatsDataOptions);
    }

    function load_data(report, report2, startDate, endDate) {
        var temp_title = report + ' Summary for ' + startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY');
        $j.ajax({
            url: "hooks/reports-fetch.php",
            method: "POST",
            data: {
                'report2': report2.substr(report2.indexOf("-") + 1, report2.length),
                'startDate': startDate.format('YYYY-MM-DD'),
                'endDate': endDate.format('YYYY-MM-DD')
            },
            dataType: "JSON",
            beforeSend: function() {
                $j("div[id^='summaryfor']").each(function(i, el) {
                    $j(el).addClass("dis");
                });
                $j("div[id='defaultReports']").addClass("hideDiv");
                $j("#titleReport").html('');
                if($j('#chartLoading').length) $j('#chartLoading').html('<div style="direction: ltr;"><img src="loading.gif"> <?php echo addslashes($Translation['Loading ...']); ?></div>');
		    },
            success: function(data) {
                draw_data(data, temp_title, report);
            },
            complete: function() {
                if($j('#chartLoading').length) $j('#chartLoading').html('');
                $j("div[id^='summaryfor']").each(function(i, el) {
                    $j(el).removeClass("dis");
                });
            },            
            error: function(data) {
                // console.log('error from ajax: '+ data.responseText);
            }
        });
    }

    function draw_data(chart_data, chart_main_title, report) {
        $j("#titleReport").html(chart_main_title);
        var jsonData = chart_data;
        if (jsonData == null || (jsonData.length && jsonData.length < 1)){
            $j("div[id='noResult']").removeClass("hideDiv");
            $j("div[id='noResult']").html("No results found!");
            $j("div[id$='Chart']").each(function(i, el) {
            $j(el).addClass("hideDiv");
        });
            return;
        }
        $j("div[id='noResult']").addClass("hideDiv");
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Total Count');
        data.addColumn('number', 'Total Approvals Closed');
        data.addColumn('number', 'Total Reviews Closed');
        data.addColumn('number', 'Total IMS Controls Closed');

        $j.each(jsonData, function(i, jsonData) {
            var date = jsonData.date;
            var total_count = parseInt($j.trim(jsonData.total_count));
            var total_reviews_closed = parseInt($j.trim(jsonData.total_reviews_closed));
            var total_approvals_closed = parseInt($j.trim(jsonData.total_approvals_closed));
            var total_ims_controls_closed = parseInt($j.trim(jsonData.total_ims_controls_closed));

            data.addRows([
                [date, total_count, total_reviews_closed, total_approvals_closed, total_ims_controls_closed]
            ]);
        });

        var barChartOptions = {
            // title: chart_main_title,
            vAxis: {
                title: "No. of " + report
            },
            legend: {
                position: 'bottom'
            }
        };

        var lineChartOptions = {
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var tableChartOptions = {
            showRowNumber: true, 
            width: '80%', 
            height: '80%'
        }
        
        $j("div[id$='Chart']").each(function(i, el) {
            $j(el).removeClass("hideDiv");
        });

        var barChart = new google.visualization.ColumnChart(document.getElementById('barChart'));
        barChart.draw(data, barChartOptions);
        
        var lineChart = new google.visualization.LineChart(document.getElementById('lineChart'));
        lineChart.draw(data, lineChartOptions);

        var tableChart = new google.visualization.Table(document.getElementById('tableChart'));
        tableChart.draw(data, tableChartOptions);
    }

    $j(document).ready(function() {
        load_default_data();

        var start = moment().startOf('month');
        var end = moment();

        function cb(start, end) {
            $j('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $j('#reportrange').daterangepicker({
            "showDropdowns": true,
            "minYear": 2000,
            "maxYear": moment().add(100, 'years').year(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "linkedCalendars": false,
            "startDate": moment().startOf('month'),
            "endDate": moment()
        }, cb);
        cb(start, end);


        $j("div[id^='summaryfor']").each(function(i, el) {
            $j(el).click(function() {
                console.log(`id clicked: ${el.id}`);
                if ($j('#reportrange').html() != '') {
                    var startDate = moment($j('#reportrange').html().substr(0, $j('#reportrange').html().indexOf("-") - 1));
                    var endDate = moment($j('#reportrange').html().substr($j('#reportrange').html().indexOf("-") + 1, $j('#reportrange').html().length));

                    
                    if (el.id != '' && startDate.isValid() && endDate.isValid()) {
                        load_data($j(el).find('a:first').text(), el.id, startDate, endDate);
                    }
                }
            });
        });

    });
</script>