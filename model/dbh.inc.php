<?php 

class Dbh 
{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	public $conn;
	
	public function __construct()
	{
		$this->connect();
		return $this->conn;
	}

	public function connect() 
	{
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "quiz_app";

		try {
			$conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
			if($conn->connect_errno) {
				throw new Exception($conn->connect_error); 
			}
			return $conn;
		} catch(Exception $e ) {    
			echo "Connection Failed: ". $e->getMessage() . "<br >";
			exit();
		}
	}
}