<?php
$title = $_GET["title-header"];
$videoFeed = $_GET["vfeed"];
?>
<style>
#rtsp {
    background-color: #494949;
    color: #f3f3f3;
    height: 480px;
    text-align: center;
    border-radius:15px;
    -moz-border-radius:15px;
    -webkit-border-radius:15px;
}

#rtsp h1 {
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
</style>
<div id="rtsp">
    <h1><?php echo $title; ?></h1>
    <p>
	<embed type="application/x-vlc-plugin" pluginspace="http://www.videolan.org" width="100%" height="320" src="<?php echo $videoFeed; ?>"/>
    </p>
</div>
