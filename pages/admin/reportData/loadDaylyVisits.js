 var chartHourlyVisits;
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'daylyVisits',
                        defaultSeriesType: 'line',
                        marginRight: 130,
                        marginBottom: 25
                    },
                    title: {
                        text: 'Dayly Visits on all Pages',
                        x: -20 //center
                    },
                    subtitle: {
                        text: '',
                        x: -20
                    },
                    xAxis: {
                        type: 'datetime',
                        tickInterval: 24*3600 * 1000, // one day
                        tickWidth: 0,
                        gridLineWidth: 1,
                        labels: {
                            align: 'center',
                            x: -3,
                            y: 20,
                            formatter: function() {
                                return Highcharts.dateFormat('%d', this.value);
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Visits'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return Highcharts.dateFormat('%A, %b %d, %Y', this.x-(24*1000*3600)) +'-'+ Highcharts.dateFormat('%A, %b %d, %Y', this.x) +': <b>'+ this.y+" visits" + '</b>';
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: [{
                        name: 'Count'
                    }]
                }
                // Load data asynchronously using jQuery. On success, add the data
                // to the options and initiate the chart.
                // This data is obtained by exporting a GA custom report to TSV.
                // http://api.jquery.com/jQuery.get/
                var sql = "SELECT COUNT(visit_id) as visit_count, DATE_FORMAT(date_time,'%Y-%m') as visit_month, DATE_FORMAT(date_time,'%Y-%m-%d') as visit_day, DATE_FORMAT(date_time, '%W, %M %d, %Y') as visit_stamp FROM my_visits WHERE action = 'arrived' AND DATE(date_time) >= CURDATE() - INTERVAL 1 MONTH GROUP BY visit_stamp ORDER BY visit_day LIMIT 0,31;";
                //var sql = "SELECT COUNT(visit_id) as visit_count, DATE_FORMAT(date_time,'%Y-%m') as visit_month, DATE_FORMAT(date_time,'%Y-%m-%d') as visit_day, DATE_FORMAT(date_time, '%W, %M %d, %Y') as visit_stamp FROM my_visits WHERE action = 'arrived' GROUP BY visit_stamp HAVING visit_month = DATE_FORMAT(CURDATE(), '%Y-%m') ORDER BY visit_day;";
                console.log("sql:"+sql);
                jQuery.post(
                'pages/admin/reportData/visits.php', 
                {"query": sql},
                function(tsv) 
                {
                console.log("dayly-tsv:"+tsv);
                    var lines = [];
                    traffic = [];
                    try {
                        // split the data return into lines and parse them
                        tsv = tsv.split(/\n/g);
                        jQuery.each(tsv, function(i, line) {
                            line = line.split(/\t/);
                            console.log("line:"+line);
                            date = Date.parse(line[0] +' UTC');
                            console.log("date:"+date);
                            traffic.push([
                                date,
                                parseInt(line[1].replace(',', ''), 10)
                            ]);
                        });
                    } catch (e) {  }
                    options.series[0].data = traffic;
                    chart = new Highcharts.Chart(options);
                });
            });
   