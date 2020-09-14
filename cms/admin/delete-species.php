<?php

require '../app/start.php';

if (isset($_GET['id'])) {
	$deleteSpecies = $db->prepare("
		DELETE FROM species
		WHERE id = :id
	");
	$deleteSpecies->execute(['id' => $_GET['id']]);
};

header('Location: ' . BASE_URL . '/admin/index-species.php');