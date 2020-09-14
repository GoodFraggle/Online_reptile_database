<?php
class Config{
	/*this function allows me to pull relevant information from the GLOBALS
  	array in core/init.php*/
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);
	 		
			foreach($path as $bit){
				if(isset($config[$bit])){
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}
?>
