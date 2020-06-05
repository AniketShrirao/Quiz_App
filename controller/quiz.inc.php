<?php
  if (isset($_POST['quiz_submit'])) {
    $answer_one = $_POST['1']; 
    $answer_two = $_POST['2']; 
    $answer_three = $_POST['3']; 
    $answer_four = $_POST['4']; 
    $answer_five = $_POST['5']; 
    $answer_six = $_POST['6']; 

    require_once '../model/queries.inc.php';
    $query = new queries;
    $is_correct_one = $query->checkAnswer($answer_one);
    $is_correct_two = $query->checkAnswer($answer_two);
    $is_correct_three = $query->checkAnswer($answer_three);
    $is_correct_four = $query->checkAnswer($answer_four);
    $is_correct_five = $query->checkAnswer($answer_five);
    $is_correct_six = $query->checkAnswer($answer_six);

    $result = $is_correct_one+$is_correct_two+$is_correct_three+$is_correct_four+$is_correct_five+$is_correct_six;
    header("Location: ../views/result.php?correct_answer=".$result);

  }

?>