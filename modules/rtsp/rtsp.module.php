<?php
$title = $_GET["title-header"];
$videoFeed = $_GET["vfeed"];
?>
<div id="rtsp">
    <h1><?php echo $title; ?></h1>
    <p>
	<embed type="application/x-vlc-plugin" pluginspace="http://www.videolan.org" width="100%" height="320" src="<?php echo $videoFeed; ?>"/>
    </p>
</div>
