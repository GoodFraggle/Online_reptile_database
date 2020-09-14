<?php
class Token {
  /*https://www.youtube.com/watch?v=3yrpRfdtYc4&index=12&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
  Create security tokens on pages to prevent
  unecessary malicious attacks by generating tokens that can be validated against.
  */
  public static function generate(){
    return Session::put(Config::get('session/token_name'), md5(uniqid()));
  }

  public static function check($token){
    $tokenName = Config::get('session/token_name');
    if(Session::exists($tokenName) && $token === Session::get($tokenName)){
      Session::delete($tokenName);
      return true;
    }
    return false;
  }
}

?>