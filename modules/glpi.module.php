<?php
$title = $_GET["title-header"];
$url = urldecode($_GET["url"]);
$json_data = file_get_contents($url);

$new_data = json_decode($json_data);
?>
<style>
#tickets {
    background-color: #494949;
    color: #f3f3f3;
    text-align: center;
    border-radius:15px;
    -moz-border-radius:15px;
    -webkit-border-radius:15px;
}

#tickets h1 {
    padding: 10px;
    background-color: #000046;
    width: 100%;
    border-top-right-radius: 15px;
    border-top-left-radius: 15px;
    -moz-border-radius-topright: 15px;
    -moz-border-radius-topleft: 15px;
    -webkit-border-top-right-radius: 15px;
    -webkit-border-top-left-radius: 15px;
}

#tickets p {
    margin:0px;
    font-size: 825%;
}
</style>
<div id="tickets">
	<h1><?php echo $title; ?></h1>
        <p><?php echo $new_data->tickets;?></p>
</div>

