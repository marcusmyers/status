<?php

function parseCalendarFeed($feed_url, $count = 6) {
	$fCache = new Memcache();
	$fCache->connect('localhost',11211);
	$arr = array();
	if($fCache->get('events')){
		$arr = $fCache->get('events');
	} else {
		$content = simplexml_load_file($feed_url,'SimpleXmlElement');
		foreach($content->children() as $node){
			foreach($node->children() as $element){
				$arrTemp['Desc'] = $element->ShortDesc;
				$arrTemp['Date'] = parseDate($element->Date);
				$arr[] = $arrTemp;
			}
		}	
	}
	$arr = array_slice($arr, 0, $count);
	return $arr;
} // end parseCalendarFeed

function parseDate($date)
{
	$arrDate = explode("/",$date);
	return $arrDate[0]."/".$arrDate[1];
}

function getVisitors() 
{
	$url = "http://chart.apis.google.com/chart?chf=a,s,000000AF|bg,s,000000|c,s,E0E0E0&chxr=0,0,46&chxt=y&chs=450x300&cht=lc&chco=3D7930&chd=s:Xhiugtqi&chdlp=l&chg=14.3,-1,1,1&chls=2,4,0&chm=B,C5D4B5BB,0,0,0&chtt=Website+Visitors";

}

function getSchedule() {
	$feed = "http://www.dynacal.com/napoleon.k12.oh/WebToolBox_WS.asp?XML=Y&DR=7&CalType=C&CATIDS=6940,6974,7002,6899,18764,30797,7003,6975,30802,38029,9012,35733,35734,35735,35736,35738,35740,35741,35743,59845,59543,53796,59544,35745,7350,59843,38257,36006,38256,35746,35748,35749,39165,59821,35751,35752,45577,35762,35764,35753,35755,35758,35760,38947,6150,35766,38259,35767,38258,38554,59842,48440,44214,35768,35770,35771,65894,35772,56575,35773,35775,35776,38897,44926,35777,35781,35780,35778,35779,52597,35782,35783,59844,6962,30804,31854,45094,45095,6963,6969,45096,31855,45092,45093,6968,45097,6965,45098,6966,45099,6970,6971,6972,6942,";
	$events = parseCalendarFeed($feed);
	$html = "";
	foreach($events as $event) {
		$html .= "<li><em>".$event['Date']."</em>";
		if(isset($event['Desc'])) {
			$html .= " <small>".$event['Desc']."</small></li>";
		} else {
			$html .= "</li>";
		}
	}
	return $html;
}

function getProjectUsers($pid){
    $sql = new mysqli('10.20.15.56', 'projuser', 'ttwu*data', 'projects')  or die('could not connect');
	$resultpp = $sql->query("SELECT * FROM tbl_project_perms  WHERE pid='".$pid."'");
	
	$arrProjPerms = array();
	while($row = $resultpp->fetch_object()){
	   $arrProjPerms[] = $row->uid;
	}
	return $arrProjPerms;
}

function getProjectTask($pid){
	$sql = new mysqli('10.20.15.56', 'projuser', 'ttwu*data', 'projects')  or die('could not connect');
	$resultt = $sql->query("SELECT * FROM tbl_task WHERE pid='".$pid."' AND is_todo = '1' and is_active='1'");
	$arrDone = array();
	$arrTotal = array();
	while($row = $resultt->fetch_object()){
	   if($row->is_done == '1'){
	       $arrDone[] = 1;
	   }
	   $arrTotal[] = 1;
	}
	$final = sizeof($arrTotal);
	$less = sizeof($arrDone);
	$count1 = $less / $final;
	$count2 = $count1 * 100;
	$count = number_format($count2, 0);
	return $count;
}

function getProjects() {
	$sql = new mysqli('10.20.15.56', 'projuser', 'ttwu*data', 'projects')  or die('could not connect');
	$resultu = $sql->query("SELECT * FROM tbl_users");
	
	$html = "<table>";
	
	$arrUsers = array();
	while($row = $resultu->fetch_object()){
	   $arrUsers[$row->id] = $row->f_name;
	}

	$resultp = $sql->query("SELECT * FROM tbl_projects WHERE is_active = '1'");
	
	$arrProjects = array();
	while($row = $resultp->fetch_object()){
	   $arrProjects[$row->id] = $row->p_name;
	}
	
	
	foreach($arrProjects as $pid=>$name){
		$html .= "<tr><td>$name</td>";
		$html .= "<td>";
		$html .= getProjectTask($pid);
		$html .= "%</td>";
		$html .= "<td>";
		$arrPUser = getProjectUsers($pid);
		foreach($arrPUser as $key=>$uid){
		  $imgName = $arrUsers[$uid];
		  $html .= "<img src='/status/images/$imgName.png' alt='$imgName' />";
		}
		$html .= "</td>";
	}
	$html .= "</table>";
	return $html;
	
}

/*function getOpenTickets(){
    $dbh = new mysqli('10.20.15.56','glpiuser','ttwu*data','glpi') or die('could not connect');
    $result = $dbh->query("SELECT COUNT( ID ) FROM glpi_tracking WHERE closedate IS NULL");
    $row = $result->fetch_array();
    
    return $row[0];
}*/

function getWeather(){
    $memcache = new Memcache();
    $memcache->connect('localhost',11211);
    $weather = 'http://xoap.weather.com/weather/local/USOH0648?cc=*&dayf=2&link=xoap&prod=xoap&par=1075495930&key=21cfbdc902ba1753';
    $xmlStr = file_get_contents($weather,0);
    $xml = new SimplexmlElement($xmlStr);
    $cc = $xml->cc;
    $strReturn = "\t\t<div id='current_logo'><img src='/status/images/icons/".$cc->icon.".png' /></div>\n\t\t<div id='current_text'>".$cc->tmp."&deg;<p>".$cc->t."</p><p class='loc'>Napoleon, OH</p></div><br/>";
    $strReturn .= "<div id='day_text'>\n\t\t\t\t";
    $strReturn .= "<div id='today_text'>Today</div>\n\t\t\t\t";
    $strReturn .= "<div id='tomorrow_text'>Tomorrow</div>\n\t\t\t";
    $strReturn .= "</div><br/>\n\t<div id='two_day'>\n\t\t";
    $i = 0;
    $strR1 = "";
    foreach($xml->dayf->day as $item){
	if($memcache->get('day1')){
	    //$strReturn .= $memcache->get('day1');
	    $test = true;
	} else {
	    $test = false;	
	}
        if($i == 0){
            //$strReturn .= "<div id='two_day_1'>\n\t\t\t";
	    $strR1 .= "<div id='two_day_1'>\n\t\t\t";
        } else {
            $strReturn .= "<div id='two_day_2'>\n\t\t\t";
        }
        foreach($item->part as $pData){
            if("d" === (string) $pData['p']){
		if($i==0){
                    //$strReturn .= "<img src='/status/images/icons/".$pData->icon.".png' /><br/>";
                    //$strReturn .= $pData->t . "<br />";
		    $strR1 .= "<img src='/status/images/icons/".$pData->icon.".png' /><br/>";
		    $strR1 .= $pData->t ."<br/>";
		} else {
		    $strReturn .= "<img src='/status/images/icons/".$pData->icon.".png' /><br/>";
		    $strReturn .= $pData->t . "<br/>";
		}
            }
        }
	if($i==0){
      	    //$strReturn .= $item->hi."&deg;/".$item->low."&deg;";
            //$strReturn .= "</div>\n\t\t";
	    $strR1 .= $item->hi."&deg;/".$item->low."&deg;";
	    $strR1 .= "</div>\n\t\t";
	    if($test){
		$strReturn .= $memcache->get('day1');
	    } else {
	    	$strReturn .= $strR1;
	    }
	} else {
	    $strReturn .= $item->hi."&deg;/".$item->low."&deg;";
	    $strReturn .= "</div>\n\t\t";
	}
	if($i==0 && date('G')> 12 && date('G')<14 && !$test){
	    $memcache->add('day1',$strR1, false, 49800);
	}
	$i++;
    }
    $strReturn . "</div></div>";
    return $strReturn;
}

?>
