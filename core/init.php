<?php
session_start();
global $db;
$pdo = NEW PDO('mysql:host=www.badfraggle.com;dbname=mysit297_badfraggle', 'mysit297_Rich', 't00wkpjrsg');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'www.badfraggle.com',
        'username' => 'mysit297_Rich',
        'password' => 't00wkpjrsg',
        'db' => 'mysit297_badfraggle'
    ),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800 
	),
	'session' => array(
		'session_name'=> 'user',
		'token_name' => 'token'
	)
);

define('APP_ROOT', __DIR__);
define('VIEW_ROOT', APP_ROOT . '/views');
define('BASE_URL', 'http://badfraggle.com/');

//THIS FUNCTION LOADS ALL THE CLASSES IN THE CLASSES FOLDER
spl_autoload_register(function($class){
	require_once 'classes/' . $class . '.php';
});
require_once 'functions/sanitize.php';
require_once 'functions/images.php';
//https://www.youtube.com/watch?v=d8DRVp2kdCc&index=19&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session',array('hash','=', $hash));
	if($hashCheck->count()){
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
?>