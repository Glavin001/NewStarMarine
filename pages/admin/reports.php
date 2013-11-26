<?PHP include("../../common/top.php"); ?>

<!-- reports.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Administrator Reports</title>
<?PHP include("../../common/base.php"); ?>
<script type="text/javascript" src="scripts/highcharts/highcharts.js"></script>
<script type="text/javascript" src="scripts/highcharts/themes/dark-blue.js"></script>

<script type="text/javascript" src="pages/admin/reportData/loadHourlyVisits.js"></script>
<script type="text/javascript" src="pages/admin/reportData/loadDaylyVisits.js"></script>
<script type="text/javascript" src="pages/admin/reportData/loadMonthlyVisits.js"></script>
<script type="text/javascript" src="pages/admin/reportData/loadPopularPages.js"></script>

<!--
<script type="text/javascript">// <![CDATA[           
            var chart;
    $(document).ready(function() {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2010'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
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
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });
    });
    
// ]]></script>
-->

</head>

<body>
<div id="page">

<?PHP include("../../common/body_head.php"); ?>

<?PHP include("../../common/mainmenu.php"); ?>           

<div id="content">
<div id="text">

<h3>Reports:</h3>
<br />
<div id="hourlyVisits"></div>
<br />
<div id="daylyVisits"></div>
<br />
<div id="monthlyVisits"></div>
<br />
<div id="pagePopularity"></div>
<br />
<div id="container"></div>
<br />

</div>
</div>
<?PHP include("../../common/footer.php"); ?>

<br />

</div>

</body>
</html>