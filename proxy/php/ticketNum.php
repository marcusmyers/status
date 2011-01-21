<?php

$dbh = new mysqli('10.20.15.56','glpiuser','ttwu*data','glpi') or die('could not connect');
$result = $dbh->query("SELECT COUNT( ID ) as tickets  FROM glpi_tickets WHERE glpi_tickets.status = 'assign'");
$row = $result->fetch_array();

echo '{"tickets":'. $row[0] . '}';

