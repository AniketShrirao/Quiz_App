<?php


if (isset($_POST['signup_submit'])) {

  require_once '../model/dbh.inc.php';
  require_once 'validation.php';
  include_once 'getInputs.inc.php';

  $Input_values = new InputValues;
  $Input_values->getValues();
  // $inputArray = ['email','password','confirm_password'];
  // $inputs = array_compact('username',$inputArray);
  $validator = new Validation();
  $is_name = $validator->nameValidator($Input_values->username);
  $is_email =  $validator->emailValidator($Input_values->email);
  $is_new_user = $validator->alreadyUser($Input_values->email);
  $is_password = $validator->passwordValidator($Input_values->password);
  $is_confirm_password = $validator->confirmValidator($Input_values->password,$Input_values->confirm_password);

  if($is_name || $is_email || $is_new_user || $is_password || $is_confirm_password) {
    header("Location: ../view/quiz.php");
  }

}

?>