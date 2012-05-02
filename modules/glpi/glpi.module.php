<?php
$title = $_GET["title-header"];
$url = urldecode($_GET["url"]);
$json_data = file_get_contents($url);

$new_data = json_decode($json_data);
?>
<div id="tickets">
	<h1><?php echo $title; ?></h1>
        <p><?php echo $new_data->tickets;?></p>
</div>

