<?php require('statBoard.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta http-equiv="refresh" content="1800" />
    <title>Status Board</title>
	<!--<script src="https://www.google.com/jsapi?key=ABQIAAAAeiV8QcjRzVreooy6xD2vvxQ1dKXbrvPhpjOqskkBCj21hFZHRxS1n9icvB_eYHCyT1az6-qbDljOPg" type="text/javascript"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/status/js/jquery.jdigiclock.js"></script>
	<script type="text/javascript" src="/status/js/twitterlib.min.js"></script>
    <script type="text/javascript" src="/status/js/jquery.flot.min.js"></script>
    <script type="text/javascript" src="/status/js/jquery.pauseanimate.js"></script>
	<script type="text/javascript" src="/status/js/statBoard.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.jdigiclock.css" />
	<link rel="stylesheet" type="text/css" href="default.css" />
    <script type="text/javascript">
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
                board.getSiteStats('#sitestats');
            });
    </script>

</head>
<body>
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
			<div id="sitestats"></div>
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
