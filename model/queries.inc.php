<?php
include_once '../controller/validation.php';
include_once 'dbh.inc.php';

class queries extends Dbh{

	public function insertUser($username,$email,$password) 
	{
		$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?);";
		$conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../signup.php?error=SqlError");
			exit();
		} else {
			$hash_password = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hash_password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
			header("Location: ../views/signup.php?signup=success");
			exit();
		}
	}

}
?>