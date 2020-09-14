<?php

require 'app/start.php';

$pages = $db->query("
	SELECT id, label, slug
	FROM pages
")->fetchALL(PDO::FETCH_ASSOC);

require VIEW_ROOT . '/home.php';