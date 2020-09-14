<?php

ini_set('display_errors', 'On');

define('APP_ROOT', __DIR__);
define('VIEW_ROOT', APP_ROOT . '/views');
define('BASE_URL', 'http://www.badfraggle.com/cms');

$db = NEW PDO('mysql:host=www.gathereveryone.com;dbname=mysit297_badfraggle', 'mysit297_Rich', 't00wkpjrsg');

require 'functions.php';