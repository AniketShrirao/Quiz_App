<?php
include_once '../model/dbh.inc.php';
class Validation extends Dbh
{
	public $username,$email;
	
	public function CurrentInputValues($u_name,$email) 
	{
		$this->username = $u_name;
		$this->email = $email;
	}

	protected function locate($error,$username,$email) 
	{
		header("Location: ../views/signup.php?error=".$error."&username=".$this->username."&mail=".$this->email);
	}

	public function emptyValidator($input) 
	{
		if(empty($input)) {
			$this->locate('EmptyFields',$this->username,$this->email);
			exit();
		}  else {
			return true;
		}
	}

	public function nameValidator($username) 
	{
		if($this->emptyValidator($username)) {
			if(!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
				$this->locate('InvalidName',$username,$this->email);
				exit();
			} else {
				return true;
			}
		}
	}

	public function emailValidator($email) 
	{
		if($this->emptyValidator($email)) {
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$this->locate('InvalidEmail',$this->username,$email);
				exit();
			} else {
				return true;
			}
		}
	}

	public function passwordValidator($password) 
	{
		if($this->emptyValidator($password)) {
			if(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/",$password)) {
				$this->locate('InvalidPassword',$this->username,$this->email);
				exit();
			} elseif(strlen($password)  < 8) {
				$this->locate('shortPassword',$this->username,$this->email);
				exit();
			} elseif(strlen($password)  > 15) {
				$this->locate('longPassword',$this->username,$this->email);
				exit();
			} else {
				return true;
			}
		}
	}

	public function confirmValidator($password,$confirm_password) 
	{
		if($this->emptyValidator($confirm_password)) {
			if ($password !== $confirm_password) {
				$this->locate('PasswordNotMatch',$this->username,$this->email);
				exit();
			}	else {
				return true;
			}
		}
	}

	public function alreadyUser($email) 
	{
		global $db;
		$sql = "SELECT email FROM users WHERE email= ?;";
		$conn = $this->connect();
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
		  header("Location: ../signup.php?error=SqlError");
		  exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result_check = mysqli_stmt_num_rows($stmt);
			if($result_check > 0) {
				$this->locate('EmailTaken',$username,$email);
				exit();
			}
			else {
				return true;
			}
		}
	}
}

?>
