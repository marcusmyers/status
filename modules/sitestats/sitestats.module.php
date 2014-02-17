<?php

$result = file_get_contents('http://apps.napoleonareaschools.org/piwik/?module=API&method=VisitsSummary.getVisits&idSite=1&date=last10&period=day&format=XML&token_auth=e7537a5e133fd9b1f835a7ca206652cf');
$contents = simplexml_load_string($result);

//var_dump($contents);
//exit();

$visits = array();
$count = '';
for($i = 0; $i < 10; $i++){
        $date = (string) $contents->result[$i]->attributes()->date;
        $count .= (int)$contents->result[$i];
        if($i != 9){
        	$count .= ",";
        }
        // $aDate = (int)strtotime($date);
        // $aDate = $aDate . "000";
        // $visits[$aDate] = $count;
}
?>


<canvas id="myChart" width="512"></canvas>
<script type="text/javascript">
	var lineChartData = {
			labels : ["9","8","7","6","5","4","3","2","1","Today"],
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php echo $count; ?>]
				}
			]
		};
	//Get the context of the canvas element we want to select
    var ctx = document.getElementById("myChart").getContext("2d");
	new Chart(ctx).Line(lineChartData);
</script>