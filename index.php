<?php 
define('CONFIG','./config.json');

// FIRST: read in the configuration
$data = file_get_contents(CONFIG);
$data = json_decode($data);

if (!$data) die('JSON syntax error in "'.CONFIG.'"');

function render($module) {
    $argstr = array();
    $args = $module->args;
    $args->width = $module->width;
    foreach($args as $key => $val) {
        $argstr[] = "$key=" . urlencode($val);
    }
    $argstr = "'" . implode("&", $argstr) . "'";
    
    //$style = "width: {$module->width}px;";
    //if ($module->height) $style .= " height: {$module->height}px";
    echo "<div class='$module->class' id='$module->name' "/*style='$style'*/."></div>\n";
    echo "\t<script type='text/javascript'>activate_module('$module->name', $module->update, $argstr);</script>\n\n";
}

//require('statBoard.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8' />
    <meta http-equiv="refresh" content="1800" />
    <title><?php echo (isset($data->title) ? $data->title : 'generic status board') ?></title>

    <script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
    <script src="js/jquery.flot.min.js"></script>
    <script src="js/jquery.pauseanimate.js"></script>
    <script src="js/statBoard.js"></script>
    <script src="js/board.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <script>
            function draw(){
            var canvas = document.getElementById('tutorial');
            if (canvas.getContext){
                  var ctx = canvas.getContext('2d');
                }
              }
            $(document).ready(function() {
                var board = statBoard();
                //board.getTickets();
                //board.twitterize('#our_tweets','timeline','nastechdept');
                
                //board.getSiteStats('#sitestats');
            });
    </script>
    <style>
      canvas { border: 1px solid #ffffff; }
    </style>

</head>
<body> <!-- onload="draw();" -->
	<div id="board">
		<!--<div id="data">
			<div id="tickets">
			     <h1>OPEN TICKETS</h1>
			     <p></p>
			</div>
			<div id="schedule">
				<h1>Events</h1>
				<ul>
					<?php //echo getSchedule(); ?>
				</ul>
			</div>
		</div>
		<div id="data2">
			<div id="sitestats"></div>-->
			<?php
			foreach($data->modules as $module)
			    render($module);
			?>
		<!--</div>
		<br/>
		<div id="twitter">
			<div id="our_tweets"></div>
		</div>-->
		<div id="projects">
            <?php
            //echo getProjects(); 
            ?>
		</div>
	</div>
</body>
</html>
