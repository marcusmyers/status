<?php

define('PIWIK_INCLUDE_PATH', '/media/data2/web/www/app/piwik');
define('PIWIK_ENABLE_DISPATCH', false);
define('PIWIK_ENABLE_ERROR_HANDLER', false);
define('PIWIK_ENABLE_SESSION_START', false);

require_once PIWIK_INCLUDE_PATH . "/index.php";
require_once PIWIK_INCLUDE_PATH . "/core/API/Request.php";

Piwik_FrontController::getInstance()->init();

$request = new Piwik_API_Request('
		method=VisitsSummary.getVisits
		&idSite=1
		&date=last10
		&period=day
		&format=XML
		&token_auth=e7537a5e133fd9b1f835a7ca206652cf
');

$result = $request->process();
$contents = simplexml_load_string($result);

$visits = array();

for($i = 0; $i < 10; $i++){
	$date = (string) $contents->result[$i]->attributes()->date;
	$count = (int)$contents->result[$i];
	$aDate = (int)strtotime($date);
	$aDate = $aDate . "000";
	$visits[$aDate] = $count;
}

header("Content-type: application/json");
echo json_encode($visits);
