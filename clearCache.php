<?php
$memcache = new Memcache;
$memcache->connect('127.0.0.1',11211);

$memcache->flush();
