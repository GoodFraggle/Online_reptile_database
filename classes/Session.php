<?php

class Session{

  /*https://www.youtube.com/watch?v=3yrpRfdtYc4&index=12&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
  Create, check, and delete sessions for user activities.
  Also, you can show specific messages for specific session*/

 public static function exists($name){
    return (isset($_SESSION[$name])) ? true : false;
  }

  public static function put($name, $value) {
    return $_SESSION[$name] = $value;
  }

  public static function get($name){
    return $_SESSION[$name];
  }

  public static function delete($name){
    if(self::exists($name)){
      unset($_SESSION[$name]);
    }
  }

  //https://www.youtube.com/watch?v=T_abxlvA1VE&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=13
  public static function flash($name, $string = ''){

    if(self::exists($name)){
      $session = self::get($name);

      self::delete($name);
      return $session;
    }else{
      self::put($name, $string);
    }
    return '';
  }
}

?>