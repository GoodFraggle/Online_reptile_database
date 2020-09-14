<?php
//https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
  /*Specific functions created to create
  user accounts, update user information,
  find user information, login in users, check if user is logged in, and pull all user information in one function*/
class User{
  private $_db;
  private $_data; 
  private $_sessionName;
  private $_cookieName;
  private $_isLoggedIn;

  public function __construct($user = null){
    $this->_db = DB::getInstance();
    $this->_sessionName = Config::get('session/session_name'); 
    $this->_cookieName = Config::get('remember/cookie_name'); 

    if(!$user){
    	if(Session::exists($this->_sessionName)){
    		$user = Session::get($this->_sessionName);

    		if($this->find($user)){
    			$this->_isLoggedIn = true;
    		}else{
          Redirect::to('logout.php'); 
    		}
    	}
    }else{
    	$this->find($user);
    }
  }
  //https://www.youtube.com/watch?v=KL4oviBqnQk&index=20&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
  public function update($fields = array(), $id = null){
    if(!$id && $this->isLoggedIn()){
      $id = $this->data()->id;
    }
    if(!$this->_db->update('users', $fields, $id)){
      throw new Exception('There was a problem updating profile');
    }
  }
  //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
  public function create($fields = array()){
    if(!$this->_db->insert('users', $fields)){
      throw new Exception('Problem creating new account');    
   } 
  }
 
  //https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=16
  public function find($user = null){
  	if($user){
  		$field = (is_numeric($user)) ? 'id': 'username';
  		$data = $this->_db->get('users', array($field, '=', $user));
  		if($data->count()){
  			$this->_data = $data->first();
  			return true;
  		}
  	}
  }
  public function login($username = null, $password = null, $remember = false){
    if(!$username && !$password && $this->exists()){
      Session::put($this->_sessionName, $this->data()->id);
    }else{
    $user = $this->find($username);
  	if($user){
  		if($this->data()->password === Hash::make($password, $this->data()->salt)){
  			Session::put($this->_sessionName, $this->data()->id);
        //https://www.youtube.com/watch?v=d8DRVp2kdCc&index=19&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
        if($remember){
          $hash = Hash::unique();
          $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

          if(!$hashCheck->count()){
            $this->_db->insert('users_session', array(
              'user_id' => $this->data()->id,
              'hash' => $hash
              ));
          }else{
 
            $hash = $hashCheck->first()->hash;
          }
          Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
        }
  			return true;
  		}
  	}
    }
    return false;
  }

  //https://www.youtube.com/watch?v=BiTG6AqNWEs&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=23
  public function hasPermission($key){
    //check permission of users.
    $group = $this->_db->get('groups', array('id', '=', $this->data()->group));
    if($group->count()){
      $permissions = json_decode($group->first()->permissions, true);
      if($permissions[$key] == true){
        return true;
      }
    }
    return false;
  }

  public function exists(){
    return (!empty($this->_data)) ? true : false;
  }
  
  public function logout(){
    $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
    Session::delete($this->_sessionName);
    Cookie::delete($this->_cookieName);
  }
  
  public function data(){
  	return $this->_data;
  }
  
  public function isLoggedIn(){
  	return $this->_isLoggedIn;
  }
}
?>