<?php

require '../app/start.php';

$species = $db->query("
	SELECT id, common, latin
	FROM species
	ORDER BY common DESC
")->fetchALL(PDO::FETCH_ASSOC);

require VIEW_ROOT . '/admin/list-species.php';