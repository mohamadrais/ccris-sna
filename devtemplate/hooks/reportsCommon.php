<script type="text/javascript">
    function load_default_data() {
        $j.ajax({
            url: "hooks/reportsFetch.php",
            method: "POST",
            data: {
                'type': 'load_default_data'
            },
            dataType: "JSON",
            beforeSend: function() {
                disable_click('default');
		    },
            success: function(data) {
                draw_default_data(data);
            },         
            error: function(response) {
                console.log('load_default_data error: ' + response.statusText);
                notify('Oops... something went wrong. Ajax query returned ' + response.statusText + '.', 'success');
            },
            complete: function() {
                enable_click();
            }   
        });
    }

    function draw_default_data(chart_data) {
        try {
            if (!canAccessGoogleVisualization()){
                notify('Oops... something went wrong. Could not load Google charts library.', 'error');
                return;
            }

            var combined_data = chart_data;
            if (combined_data == null || (combined_data.length && combined_data.length < 1)){
                return;
            }

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
                        ['Members awaiting approval', parseFloat($j.trim(jsonData.awaiting)), 'orange'],
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
        catch(err){
            console.log('draw_default_data error: ' + err);
            notify('Oops... something went wrong. Please try again later.', 'error');
            return;
        }
        
    }

    function load_data(report, report2, startDate, endDate) {
        var temp_title = report + ' Summary for ' + startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY');
        $j.ajax({
            url: "hooks/reportsFetch.php",
            method: "POST",
            data: {
                'report2': report2.substr(report2.indexOf("-") + 1, report2.length),
                'startDate': startDate.format('YYYY-MM-DD'),
                'endDate': endDate.format('YYYY-MM-DD')
            },
            dataType: "JSON",
            beforeSend: function() {
                disable_click('nondefault');
		    },
            success: function(data) {
                draw_data(data, temp_title, report);
            },         
            error: function(response) {
                console.log('load_default_data error: ' + response.statusText);
                notify('Oops... something went wrong. Ajax query returned ' + response.statusText + '.', 'error');
            },
            complete: function() {
                enable_click();
            }
        });
    }

    function draw_data(chart_data, chart_main_title, report) {
        try {
            if (!canAccessGoogleVisualization()){
                notify('Oops... something went wrong. Could not load Google charts library.', 'error');
                return;
            }
            
            $j("#titleReport").html(chart_main_title);

            var jsonData = chart_data;
            if (jsonData == null || (jsonData.length && jsonData.length < 1)){
                hide_divs();
                return;
            }
            else {
                show_divs();
            }

            var keys = Object.keys(jsonData[0]);
            dataTable = [];

            let _dataColumnNames=[];
            for (i=0; i< keys.length; i++){
                _dataColumnNames.push(keys[i].replace(/_/g, ' '));
            }
            dataTable.push(_dataColumnNames);

            for(x=0; x< jsonData.length; x++){
                let _dataColumnValues=[];
                Object.keys(jsonData[x]).forEach(function(k){
                    _dataColumnValues.push(jsonData[x][k]);
                });
                dataTable.push(_dataColumnValues);
            }

            var data = google.visualization.arrayToDataTable(dataTable);

            var comboChartOptions = {
                hAxis: {title: 'Date'},
                seriesType: 'bars',
                series: [ {type: 'scatter'}, {}, {}, {}, {type: 'area'}, {type: 'line'} ]
            };

            var tableChartOptions = {
                showRowNumber: true, 
                width: '100%', 
                height: '80%'
            }
            
            var comboChart = new google.visualization.ComboChart(document.getElementById('comboChart'));
            comboChart.draw(data, comboChartOptions);

            var tableChart = new google.visualization.Table(document.getElementById('tableChart'));
            tableChart.draw(data, tableChartOptions);
        }
        catch(err){
            console.log('draw_data error: ' + err);
            notify('Oops... something went wrong. Please try again later.', 'error');
            return;
        }
    }

    function load_kpi(report, report2) {
        var temp_title = 'KPI metrics for ' + report;
        $j.ajax({
            url: "hooks/reportsFetch.php",
            method: "POST",
            data: {
                'kpi': 'true',
                'report2': report2.substr(report2.indexOf("-") + 1, report2.length)
            },
            dataType: "JSON",
            beforeSend: function() {
                disable_click('nondefault');
		    },
            success: function(data) {
                draw_kpi(data, temp_title, report);
            },         
            error: function(response) {
                console.log('load_kpi error: ' + response.statusText);
                notify('Apologies, we could not get KPI metrics for this table.');
            },
            complete: function() {
                enable_click();
            }
        });
    }

    function draw_kpi(kpi_data, chart_main_title, report) {
        try {            
            $j("#titleReport").html(chart_main_title);

            var jsonData = kpi_data;
            if (jsonData == null || (jsonData.length && jsonData.length < 1)){
                hide_divs();
                return;
            }
            else {
                show_divs();
            }

            kpiTable = [];
            Object.keys(jsonData[0]).forEach(function(k){
                kpiTable.push(jsonData[0][k]);
            });
   
            $j('#kpi_min_record_required').replaceWith("<span id='kpi_min_record_required' style='padding-left:50%; font-size:20px'>" + kpiTable[0] + "</span>");
            // $j('#kpi_task_completion_duration').replaceWith("<span id='kpi_task_completion_duration'>" + kpiTable[1] + "</span>");

            for(var i=0; i<parseInt(kpiTable[1]); i++){
                $j('#kpi_task_completion_duration .progress-bar').attr('style', 'width: ' + (Math.round((kpiTable[1]) / 365 * 100)) + '%;').html((kpiTable[1]));
            }
            var circular_chart_color = ''; var kpi_percentage = parseFloat(kpiTable[2], 2);
            if(kpi_percentage < 50.00) circular_chart_color = 'orange'; else if (kpi_percentage < 100.00) circular_chart_color = 'blue'; else circular_chart_color = 'green';
            
            $j('#kpi_percentage_kpi_achieved').replaceWith(
            `
                <div id="kpi_percentage_kpi_achieved" class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart ${circular_chart_color}">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <path class="circle"
                        stroke-dasharray="${kpi_percentage}, 100"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <text x="18" y="20.35" class="percentage">${kpiTable[2]}</text>
                    </svg>
                </div>
            
            `
            );
            

        }
        catch(err){
            console.log('draw_kpi error: ' + err);
            notify('Oops... something went wrong. Please try again later.', 'error');
            return;
        }
    }

    function disable_click(type) {
        $j("div[id^='summaryfor']").each(function(i, el) {
            $j(el).addClass("dis");
        });
        if($j('#chartLoading').length) {
            $j('#chartLoading').html('<div style="direction: ltr;"><img src="loading.gif"> <?php echo addslashes($Translation['Loading ...']); ?></div>');
        }
        if(type && type=='nondefault'){
            $j("div[id='defaultReports']").addClass("hideDiv");
            $j("#titleReport").html('');
        }
    }

    function enable_click() {
        if($j('#chartLoading').length) $j('#chartLoading').html('');
        $j("div[id^='summaryfor']").each(function(i, el) {
            $j(el).removeClass("dis");
        });
    }

    function hide_divs() {
        $j("div[id='noResult']").removeClass("hideDiv");
        $j("div[id='noResult']").html("No results were found for this report.");
        $j("div[id$='Chart']").each(function(i, el) {
            $j(el).addClass("hideDiv");
        });
        $j("#notify").html('');
        $j("#notify").addClass("hideDiv");
    }

    function show_divs() {
        $j("div[id='noResult']").addClass("hideDiv");
        $j("div[id='noResult']").html('');
        $j("div[id$='Chart']").each(function(i, el) {
            $j(el).removeClass("hideDiv");
        });
        $j("#notify").html('');
        $j("#notify").addClass("hideDiv");
    }

    function canAccessGoogleVisualization() {
        if ((typeof google === 'undefined') || (typeof google.visualization === 'undefined')) {
            return false;
        } 
        return true;
    }

    function notify(msg, status){
        /* show notification containing returned text */
        if($j("#notify") != undefined) {
            $j("#notify").removeClass("hideDiv");
            $j("#notify").html(msg);
        }

        if(status=='success'){
            if($j("#notify") != undefined) window.setTimeout(function(){ $j("#notify").hide(); }, 10000);
        }
        else{
            // error styling
        }
    }

    $j(document).ready(function() {
        if(getUrlVars()["kpi"] != "true"){
            google.charts.setOnLoadCallback( function() { load_default_data() });
        }

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
                if ($j('#reportrange').html() != '' && getUrlVars()["kpi"] != "true") {
                    var startDate = moment($j('#reportrange').html().substr(0, $j('#reportrange').html().indexOf("-") - 1));
                    var endDate = moment($j('#reportrange').html().substr($j('#reportrange').html().indexOf("-") + 1, $j('#reportrange').html().length));

                    
                    if (el.id != '' && startDate.isValid() && endDate.isValid()) {
                        load_data($j(el).find('a:first').text(), el.id, startDate, endDate);
                    }
                }
                else if (getUrlVars()["kpi"] == "true") {
                    load_kpi($j(el).find('a:first').text(), el.id);
                }
            });
        });

    });

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
</script>