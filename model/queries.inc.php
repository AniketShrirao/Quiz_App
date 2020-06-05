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

	public function displayData() 
	{
	function pre_r($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		}
		$sql = "SELECT * FROM questions;";
		$conn = $this->connect();
		$questions = mysqli_query($conn ,$sql);
		$row = mysqli_fetch_array($questions);

		echo '<div id="questions">';
		while($row = mysqli_fetch_array($questions)) {
			echo '<h3>'.$row['question'].'</h3>';
			echo '<ul class="option-group">';
			$answers = "SELECT * FROM answers WHERE question_id = ".$row['questions_id'].";";
			$conn = $this->connect();
			$ans = mysqli_query($conn ,$answers);
			while($row_two = mysqli_fetch_array($ans)) {
				echo '
				<li class="option">
				<input type="radio" id="answer" name="'.$row_two['question_id'].'" value="'.$row_two['answer_id'].'">
				<div class="answer">'.$row_two['answer'].'</div>
				</li>';
			}
			echo '</ul>';
		}
		echo '</div>';
	}

	public function checkAnswer($user_answer) 
	{
		$sql = "SELECT * FROM questions WHERE answer_id = ?;";
		$conn = $this->connect();
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../views/quiz.php?error=SqlError");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$user_answer);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$result_check = mysqli_num_rows($result);
			if($result_check > 0) { 
				return 1;
			} else {
				return 0;
			}
		}
	}

}
?>