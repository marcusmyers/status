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
    $style = "";
    if($module->width) $style .= " width: {$module->width}";
    //$style = "width: {$module->width}px;";
    //if ($module->height) $style .= " height: {$module->height}px";
    echo "<div class='$module->class' id='$module->name' style='".$style."'></div>\n";
    echo "\t<script type='text/javascript'>activate_module('$module->name', $module->update, $argstr);</script>\n\n";
}

$js = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8' />
    <title><?php echo (isset($data->title) ? $data->title : 'generic status board') ?></title>
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="js/board.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <?php

	foreach($data->modules as $module){
	    if($module->js){
		$js .= "\t<script src='".$module->js."'></script>\n";
	    }
	    if($module->css){
		echo "\t<link rel='stylesheet' type='text/css' href='".$module->css."' />\n";
	    }
        }
    ?>
</head>
<body> 
	<div id="board">
			<?php
			foreach($data->modules as $module){
			    render($module);
			}
			?>
	</div>
	<?php
	echo $js;
	?>
</body>
</html>
