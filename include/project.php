<?php
/**
* Description:	This is a class for member.
* Author:		Joken Villanueva
* Date Created:	January 31, 2019
* Revised By:		
*/
require_once(LIB_PATH.DS.'database.php');
class Project{
	
	protected static $tbl_name = "tblproject";
	function db_fields(){
		global $mydb;
		return $mydb->getFieldsOnOneTable(self::$tbl_name);
	}
	function listOfProjects(){
		global $mydb;
		$mydb->setQuery("Select * from ".self::$tbl_name);
		$cur = $mydb->loadResultList();
		return $cur;
	
	}
	function single_project($id=0){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tbl_name." Where `PROJECTID`= {$id} LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}

	function find_all_projects($name=""){
			global $mydb;
			$mydb->setQuery("SELECT * 
							FROM  ".self::$tbl_name." 
							WHERE  `ACCOUNT_NAME` ='{$name}'");
			$cur = $mydb->executeQuery();
			$row_count = $mydb->num_rows($cur);//get the number of count
			return $row_count;
	}

	function sumProjectExpenses($projid = 0){
		//SELECT `EXPTYPE`, SUM(`EXPENSES`) as expenses FROM `tblexpenses` WHERE PROJECTID =".$_SESSION['id']."
			global $mydb;
			$mydb->setQuery("SELECT SUM(EXPENSES) as 'expenses' 
							FROM  tblexpenses WHERE PROJECTID ={$projid}");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}

	function noOfprojects(){
			global $mydb;
			$mydb->setQuery("SELECT COUNT(*) as 'noOfprojects' 
							FROM  ".self::$tbl_name." ");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}

	function noOfprojectsOngoing(){
			global $mydb;
			$mydb->setQuery("SELECT COUNT(*) as 'noOfprojects' 
							FROM  ".self::$tbl_name." WHERE PROJECTSTATUS='ONGOING'");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function noOfprojectsFinished(){
			global $mydb;
			$mydb->setQuery("SELECT COUNT(*) as 'noOfprojects' 
							FROM  ".self::$tbl_name." WHERE PROJECTSTATUS='FINISHED' ");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}

	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  $attributes = array();
	  foreach($this->db_fields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tbl_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";

	  return  $mydb->InsertThis($sql);
	}

	public function updateproject($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tbl_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE PROJECTID=". $id;
	   return  $mydb->InsertThis($sql);
		
	}
	

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tbl_name;
		  $sql .= " WHERE PROJECTID=". $id;
		  $sql .= " LIMIT 1 ";
		   return  $mydb->InsertThis($sql);
	
	}
		
}
?>