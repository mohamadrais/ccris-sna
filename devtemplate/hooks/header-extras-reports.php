<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('46', {
        packages: ['corechart', 'table']
    });
    google.charts.setOnLoadCallback();


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
            success: function(data) {
                draw_data(data, temp_title, report);
            },
            error: function(data) {
                // console.log('error from ajax: '+ data.responseText);
            }
        });
    }

    function draw_data(chart_data, chart_main_title, report) {
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Total Count');
        data.addColumn('number', 'Total Approvals Closed');
        data.addColumn('number', 'Total Reviews Closed');
        data.addColumn('number', 'Total IMS Controls Closed');

        $j.each(jsonData, function(i, jsonData) {
            var date = jsonData.date;
            var total_count = parseFloat($j.trim(jsonData.total_count));
            var total_reviews_closed = parseFloat($j.trim(jsonData.total_reviews_closed));
            var total_approvals_closed = parseFloat($j.trim(jsonData.total_approvals_closed));
            var total_ims_controls_closed = parseFloat($j.trim(jsonData.total_ims_controls_closed));

            data.addRows([
                [date, total_count, total_reviews_closed, total_approvals_closed, total_ims_controls_closed]
            ]);
        });
        var barChartOptions = {
            title: chart_main_title,
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

        var barChart = new google.visualization.ColumnChart(document.getElementById('barChart'));
        barChart.draw(data, barChartOptions);
        
        var lineChart = new google.visualization.LineChart(document.getElementById('lineChart'));
        lineChart.draw(data, lineChartOptions);

        var tableChart = new google.visualization.Table(document.getElementById('tableChart'));
        tableChart.draw(data, tableChartOptions);
    }

    $j(document).ready(function() {
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