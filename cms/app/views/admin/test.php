<?php
require '../app/start.php';
if(!empty($_POST)){
    $latin = $_POST['latin'];
    $common = $_POST['common'];
   
    $insertpage = $db->prepare("
        INSERT INTO species (latin, common) 
        VALUES (:latin, :common )
    ");
    $insertpage->execute([
        'latin' =>  $latin,
        'common' =>  $common,
    ]);
}	
	$species = $db->query("
	SELECT id, latin, common
	FROM species
	")->fetchALL(PDO::FETCH_ASSOC);
	
	

require VIEW_ROOT . '/admin/test.php';