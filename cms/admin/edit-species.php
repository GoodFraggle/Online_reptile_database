<?php

require '../app/start.php';

if (!empty($_POST)) {
	$id	   = $_POST['id'];
	$latin = $_POST['latin'];
    $common = $_POST['common'];
	
	$updatePage = $db->prepare("
		UPDATE species
		SET
			common = :common,
			latin = :latin
		WHERE id = :id
	");
	
	$updatePage->execute([
	'id' => $id,
	'common' => $common,
	'latin' => $latin,
	]);
	
	header('Location: ' . BASE_URL . '/admin/index-species.php');
}

if (!isset($_GET['id'])) {
	header('Location: ' . BASE_URL . '/admin/index-species.php');
	die();
}

$species = $db->prepare("
	SELECT id, common, latin
	FROM species
	WHERE id =:id
");

$species->execute(['id' => $_GET['id']]);

$species = $species->fetch(PDO::FETCH_ASSOC);



require VIEW_ROOT . '/admin/edit-species.php';