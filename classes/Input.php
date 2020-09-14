<?php
//https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=11
class Input {

  /*Retrieve and get input values these 2
  functions*/

	public static function exists($type = "post"){
		switch ($type) {
		  case 'post':
			return (!empty($_POST)) ? true : false;
			break;

			case 'get':
			return (!empty($_GET)) ? true : false;
			break;
			default:
			return false;
			break;
		}
	}

	public static function get($item){
	  if(isset($_POST[$item])){
		return $_POST[$item];
	  }else if (isset($_GET[$item])) {
		return $_GET[$item];
	  }
	  return '';
	}
}

 ?>
