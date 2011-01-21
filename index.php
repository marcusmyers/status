<?php require('statBoard.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta http-equiv="refresh" content="1800" />
    <title>Status Board</title>
	<!--<script src="https://www.google.com/jsapi?key=ABQIAAAAeiV8QcjRzVreooy6xD2vvxQ1dKXbrvPhpjOqskkBCj21hFZHRxS1n9icvB_eYHCyT1az6-qbDljOPg" type="text/javascript"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> -->
	<script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
    <script src="/status/js/jquery.jdigiclock.js"></script>
	<script src="/status/js/twitterlib.min.js"></script>
    <script src="/status/js/jquery.flot.min.js"></script>
    <script src="/status/js/jquery.pauseanimate.js"></script>
	<script src="/status/js/statBoard.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.jdigiclock.css" />
	<link rel="stylesheet" type="text/css" href="default.css" />
    <script>
            function draw(){
            var canvas = document.getElementById('tutorial');
            if (canvas.getContext){
                  var ctx = canvas.getContext('2d');
                }
              }
            $(document).ready(function() {
                var board = statBoard();
                board.getTickets();
                board.twitterize('#our_tweets','timeline','nastechdept');
                $('#digiclock').jdigiclock(
                     {
                        clockImagesPath: '/status/images/clock/',
                        weatherImagesPath: '/status/images/weather/',
                        lang: 'en',
                        am_pm: true,
                        weatherLocationCode: '43545',
                        weatherMetric: 'F',
                        weatherUpdate: 10,
                        proxyType: 'php'
    
                     }
                );
                //board.getSiteStats('#sitestats');
            });
    </script>
    <style>
      canvas { border: 1px solid #fffff; }
    </style>

</head>
<body onload="draw();">
	<div id="wrap">
		<div id="data">
			<div id="tickets">
			     <h1>OPEN TICKETS</h1>
			     <p></p>
			</div>
			<div id="schedule">
				<h1>Events</h1>
				<ul>
					<?php echo getSchedule(); ?>
				</ul>
			</div>
		</div>
		<div id="data2">
			<div id="sitestats">
			    <object type="application/x-shockwave-flash" bgcolor="#FFFFFF" data="http://apps.napoleonareaschools.org/piwik/libs/open-flash-chart/open-flash-chart.swf?piwik=1.1.1" width="100%" height="300" id="VisitsSummarygetEvolutionGraphChart_swf" style="visibility: visible; "><param name="allowScriptAccess" value="always"><param name="wmode" value="transparent"><param name="flashvars" value="data-file=http%3A//apps.napoleonareaschools.org/piwik/index.php%3Fmodule%3DVisitsSummary%26action%3DgetEvolutionGraph%26columns%5B%5D%3Dnb_visits%26idSite%3D1%26period%3Dday%26date%3Dlast10%26viewDataTable%3DgenerateDataChartEvolution&id=VisitsSummarygetEvolutionGraphChart_swf&loading=Loading..."></object> 
                <!--<object type="application/x-shockwave-flash" bgcolor="#FFFFFF" data="http://apps.napoleonareaschools.org/piwik/libs/open-flash-chart/open-flash-chart.swf?piwik=1.1.1" width="100%" height="300" id="VisitFrequencygetEvolutionGraphChart_swf" style="visibility: visible; "><param name="allowScriptAccess" value="always"><param name="wmode" value="transparent"><param name="flashvars" value="data-file=http%3A//apps.napoleonareaschools.org/piwik/index.php%3Fmodule%3DVisitFrequency%26action%3DgetEvolutionGraph%26columns%5B%5D%3Dnb_visits%26idSite%3D1%26period%3Dday%26date%3Dlast10%26viewDataTable%3DgenerateDataChartEvolution&id=VisitFrequencygetEvolutionGraphChart_swf&loading=Loading..."></object>-->
			</div>
			<div id="digiclock"></div>
		</div>
		<br/>
		<div id="twitter">
			<div id="our_tweets"></div>
		</div>
		<div id="projects">
            <?php
            echo getProjects(); 
            ?>
		</div>
	</div>
</body>
</html>
