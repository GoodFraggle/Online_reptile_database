<?php 
class Hash{
	//Encode strings with sha256 algorithm
	//https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
	public static function make($string, $salt = ''){
		//return hash('sha256', $string, $salt);
		return hash('sha256', $string . $salt);
	}

	public static function salt($length){
		//return mcrypt_create_iv($length);
		return openssl_random_pseudo_bytes($length);
	}

	public static function unique(){
		return self::make(uniqid());
	}
}
?>