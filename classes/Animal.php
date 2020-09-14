<?php
class Animal{
	private $_db;
	public $db;
	
	
  
 public function addanimal($fields = array()){
 		$this->_db = DB::getInstance();
    if(!$this->_db->insert('animals', $fields)){
      throw new Exception('Problem adding new animal');    
   } 
  }


}





?>