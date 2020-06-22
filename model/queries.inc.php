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

	public function changeStatus($name,$status) 
	{
		$sql = "SELECT name,status FROM users WHERE name = ?;";
		$conn = $this->connect();
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../views/quiz.php?error=SqlErrorone");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$name);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$result_check = mysqli_num_rows($result);
			while($row = mysqli_fetch_array($result)) {
				if($row['name'] == $name) {
					if($row['status'] != $status) {
						$sql = "UPDATE users SET status = ? WHERE name = ?;";
						$conn = $this->connect();
						$stmt = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt, $sql)){
							header("Location: ../views/quiz.php?error=SqlErrortwo");
							exit();
						} else {
							mysqli_stmt_bind_param($stmt,"ss",$status,$name);
							mysqli_stmt_execute($stmt);
						}
					}
				}
			}
		}
	}

	public function checkStatus($email) 
	{
		$sql = "SELECT email,status FROM users WHERE email = ?;";
		$conn = $this->connect();
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../views/signup.php?error=SqlError");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$result_check = mysqli_num_rows($result);
			while($row = mysqli_fetch_array($result)) {
				if($row['status'] == 1) {
					$sql = "SELECT score FROM leaderboard WHERE email = ?;";
					$conn = $this->connect();
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../views/index.php?error=SqlError");
						exit();
					}
					else {
						mysqli_stmt_bind_param($stmt,"s",$email);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$result_check = mysqli_num_rows($result);
						while($fetched_values = mysqli_fetch_array($result)) { 
							$score = $fetched_values['score'];
							header("Location: ../views/result.php?correct_answer=$score");
						}
					}
				} else {
					return true;
				}
			}
		}
	}

	public function assignRanking($name,$email,$score) 
	{
		$sql = "INSERT INTO leaderboard (name, email, score) VALUES (?, ?, ?);";
		$conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../views/quiz.php?error=SqlErrorrank");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt,"sss",$name,$email,$score);
			// echo $name.$email.$score;
			mysqli_stmt_execute($stmt);
			// mysqli_stmt_close($stmt);
			// mysqli_close($conn);
			// exit();
		}		
	}

	public function displayRanks() 
	{
		$topper_name;
	function pre_r($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		}
		$sql = "SELECT * FROM leaderboard ORDER BY score DESC LIMIT 1;";
		$conn = $this->connect();
		$rank_one = mysqli_query($conn ,$sql);
		while($row = mysqli_fetch_array($rank_one)) {
			$topper_name = $row['name'];
		echo '
		<li class="top">
			<figure>
			<img src="https://via.placeholder.com/250/A4DE02/000/?text='.substr($row['name'],0,1).'" alt="'.$row['name'].'">
			</figure>
			<h4>'.$row['name'].'</h4>
			<span>'.$row['quizzed_at'].'</span>     
			<div>
			<a class="rating">'.$row['score'].'</a>
			</div>
		</li>';
		}
		$sequel = "SELECT * FROM leaderboard ORDER BY score DESC;";
		$conn = $this->connect();
		$rankings = mysqli_query($conn ,$sequel);
		while($row_two = mysqli_fetch_array($rankings)) {
			if($topper_name !== $row_two['name']) {
				echo '
				<li>
				<figure>
				<img src="https://via.placeholder.com/250/A4DE02/000/?text='.substr($row_two['name'],0,1).'" alt="'.$row_two['name'].'">
				</figure>
				<h4>'.$row_two['name'].'</h4>
				<span>'.$row_two['quizzed_at'].'</span>     
				<div>
					<a class="rating">'.$row_two['score'].'</a>
				</div>
				</li>';
			}
		}
	}
}
?>