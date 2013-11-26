 var chartPopularPages;
            $(document).ready(function() {
                
                // Radialize the colors
                var colors = $.map(Highcharts.getOptions().colors, function(color) {
                    return {
                        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                });
                        
                var options = {
                    chart: {
                        renderTo: 'pagePopularity',
                        defaultSeriesType: 'pie',
                        //margin: [50,50,100,80],
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Page Popularity'
                    },
                    xAxis: {
                        //type: 'datetime',
                        gridLineWidth: 1,
                        labels: {
                            rotation: -45,
                            align: 'right',
                            /*
                            formatter: function() {
                                return this.value;
                            }
                            */
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Page views'
                        }/*,
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]*/
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>' + this.point.name +'</b>: <i>'+ this.y+" visit"+((this.y>1)?"s":"") + '</i>';
                        }
                    },
                    /*
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                formatter: function() {
                                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                                }
                            }
                        }
                    },*/
                    legend: {
                      enabled: false
                    },
                    series: [{
                        type: 'pie',
                        name: 'Count',
                        color: colors
                    }]
                }
                // Load data asynchronously using jQuery. On success, add the data
                // to the options and initiate the chart.
                // This data is obtained by exporting a GA custom report to TSV.
                // http://api.jquery.com/jQuery.get/
                var sql = "SELECT page as visit_stamp, COUNT(visit_id) as visit_count FROM my_visits WHERE action = 'arrived' GROUP BY page ORDER BY visit_count DESC;";
                console.log("sql:"+sql);
                jQuery.post(
                'pages/admin/reportData/visits.php', 
                {"query": sql},
                function(tsv) 
                {
                console.log("page_popularity-tsv:"+tsv);
                    var lines = [];
                    var traffic = [];
                    try {
                        // split the data return into lines and parse them
                        tsv = tsv.split(/\n/g);
                        jQuery.each(tsv, function(i, line) {
                            line = line.split(/\t/);
                            console.log("line:"+line);
                            page = line[0];
                            traffic.push([
                                page,
                                parseInt(line[1].replace(',', ''), 10)
                            ]);
                        });
                    } catch (e) { console.log(e); }
                    console.log("traffic:"+traffic);
                    options.series[0].data = traffic;
                    
                    chart = new Highcharts.Chart(options);
                });
            });
   