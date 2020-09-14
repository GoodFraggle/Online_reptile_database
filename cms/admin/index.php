<?php

require '../app/start.php';

$pages = $db->query("
	SELECT id, label, title, slug
	FROM pages
	ORDER BY created DESC
")->fetchALL(PDO::FETCH_ASSOC);

require VIEW_ROOT . '/admin/list.php';