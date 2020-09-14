<?php
class Redirect{

	/*Make very easy redirects with this 
	simple function
	https://www.youtube.com/watch?v=VEzJHww-QwM&index=15&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc*/
	public static function to($location = null){
		if($location){
			if(is_numeric($location)){
				switch($location){
					case 404;
					header('HTTP 1.0 404 Not Found');
					include 'includes/errors/404.php';
					exit();
					break;
				}
			}
			header('Location: '.$location);
			exit();
		}
	}
}
?>