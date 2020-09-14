<?php
class DB {
	private static $_instance = null;
	private $_pdo,
	$_query,
	$_error = false,
	$_results,
	$_count = 0;
	
		private function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	/*Make DB queries with simple function*/
	public function query($sql, $params = array()){
		$this->_error = false; 

    if($this->_query = $this->_pdo->prepare($sql)){
		$x = 1;
		if(count($params)){
			foreach($params as $param){
				$this->_query->bindValue($x, $param);
				$x++;
			}
		}
		
		if($this->_query->execute()){
			$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
		}else{
			$this->_error = true;
		}
    }
	
    return $this;
	}
	/*Specify action of query such as SELECT * WHERE col = 1*/
	public function action($action, $table, $where = array()){
		if(count($where) === 3){
			$operators = array('=', '>', '<', '>=', '<=');
			$field     = $where[0];
			$operator  = $where[1];
			$value     = $where[2];
			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ";
				if(!$this->query($sql, array($value))->error()){
					return $this;
				}
			}
		}
		return false;
	}

	/*Very simple function for performing only SELECT SQL queries*/
	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);
    }

	/*Very simple function for deleting rows in a table*/
	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}

	/*Very simple function that lets you insert rows by just entering the table 
	and the fields and values in array format
	https://www.youtube.com/watch?v=FCnZsU19jyo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=10*/
	public function insert($table, $fields = array()){
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
				foreach ($fields as $field) {
					$values .= '?';
					if ($x < count($fields)) {
						$values .= ', ';
					}
					$x++;
				}
			$sql = "INSERT INTO {$table} (`". implode('`,`', $keys) ."`) VALUES ({$values})";
				if (!$this->query($sql, $fields)->error()) {
					return true;
				}
		}
		return false;
	}
	
	//Simple function for updating rows
	public function update($table, $fields = array(), $id){
		$set = '';
		$x = 1;
		
		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if ($x < count($fields)) {
				$set .= ", ";
			}
			$x++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
		if(!$this->query($sql, $fields)->error()){
			return true;
		}
		return false;
	}

	/*pull the results from a query by using this function*/
	public function results() {
		return $this->_results;
	}
	/*https://www.youtube.com/watch?v=fFxGA4j83Jc&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=9*/
	/*Pull the first value of a SELECT query by using this function*/
	public function first(){
		return $this->results()[0];
	}
	

	/*Show all errors that may possibly occur during SQL queries*/
	public function error() {
		return $this->_error;
	}

	/*Count the number of results from your SQL queries*/
	public function count() {
		return $this->_count;
	}
}
?>