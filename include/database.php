<?php

require_once(LIB_PATH.DS."config.php");
class Database {
	private $sql = '';

	private $sql_string = '';

	private $error_no = 0;
	private $error_msg = '';
	
	private $query = '';

	
	private $conn;
	private $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
	private $error;
	private $stmt;
	
	function __construct() {
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("real_escape_string");
	}
	
	public function open_connection() {
		$dsn = 'mysql:host='.DB_SERVER.';dbname='.DB_NAME;
		//Set Options
		$options = array(
			PDO::ATTR_PERSISTENT 		=> true,
			PDO::ATTR_ERRMODE 		   => PDO::ERRMODE_EXCEPTION
		);
		// Create new PDO
		try {
			$this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
		} catch(PDOException $e){
			 echo $this->error = "Problem in database connection! Contact administrator!". $e->getMessage();
		}
		
	}
	

	function InsertThis($sql='') {
		$this->sql_string=$sql;
		$this->query = $this->conn->prepare($this->sql_string);
		
		if($this->query->execute()) {
	   	 	return true;
			unset($sql);
			unset($this->sql_string);
			unset($this->query);
	 	 } else {
	    	return false;
	  	}
		$this->query->close();
		$this->conn->close();
	}
	
	function setQuery($sql='') {
		try {
		   $this->sql_string=$sql;
			$this->query = $this->conn->prepare($this->sql_string);
			$this->query->execute();

		  } catch (PDOException $e) {
		    echo "Failed to get query handle: " . $e->getMessage() . "\n";
		    exit;
		  }
		
	}
	
	function loadResultFetch() {
		
		$results = $this->query->fetch(PDO::FETCH_OBJ);
		return $results;
	}
	
	function loadResult() {
		
		$results = $this->query->fetchAll();
		return $results;
	}
	
	function loadResultFetch2() {
		
		$results = $this->query->fetch();
		return $results;
	}
	
	function loadResultList() {
		
		$results = $this->query->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}	
	
	function loadSingleResultAssoc() {
		
		$results = $this->query->fetch(PDO::FETCH_ASSOC);
		return $results;
	}	
	
	public function num_rows() {
		return $this->query->rowCount();
	}


	function loadSingleResult() {
		
		$results = $this->query->fetch(PDO::FETCH_OBJ);
		return $results;
	}
	
	function getFieldsOnOneTable( $tbl_name ) {
	
		$this->setQuery("DESC ".$tbl_name);
		$rows = $this->loadResultList();
		
		$f = array();
		for ( $x=0; $x<count( $rows ); $x++ ) {
			$f[] = $rows[$x]->Field;
		}
		
		return $f;
	}	

	public function fetch_array($result) {
		return mysqli_fetch_array($result);
	}
	//gets the number or rows	

	public function insert_id() {
    // get the last id inserted over the current db connection
		return $this->conn->lastInsertId();
	}
  
	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}
	
	 public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) {
			$value = trim($value);				
			$value = stripslashes($value);
		    $value = htmlspecialchars($value);
		    $value = (filter_var($value, FILTER_SANITIZE_STRING));
			}
			$value = $this->conn->real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
   	}
	
	public function close_connection() {
		if(isset($this->conn)) {
			$this->conn->close();
			unset($this->conn);
		}
	}
	
} 
$mydb = new Database();


?>

