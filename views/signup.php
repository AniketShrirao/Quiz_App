<?php 
  include_once 'header.php';
  
  if (isset($_POST['signup_submit'])) {

    require_once '../controller/validation.php';
    $validator = new Validation();
    $validator->CurrentInputValues($_POST['fullname'],$_POST['email']);
    $is_name = $validator->nameValidator( $_POST['fullname']);
    $is_email =  $validator->emailValidator($_POST['email']);
    $is_password = $validator->passwordValidator($_POST['password']);
    $is_confirm_password = $validator->confirmValidator($_POST['password'],$_POST['confirm_password']);
    $is_new_user = $validator->alreadyUser($_POST['email']);

    if($is_name || $is_email ||  $is_password || $is_confirm_password || $is_new_user) {
      require_once '../model/queries.inc.php';
      $query = new queries;
      $query->insertUser( $_POST['fullname'],$_POST['email'],$_POST['password']); 
    }
  }
  if(isset($_GET['error']) ) {
    include_once "errors.php";
    echo '<span class="error-span">'.$error.'</span>';
  } 
  elseif (isset($_GET['signup'])) {
    echo '<span class="success-span">You are successfully signed up Login Now</span>';
  }
?>
  <div class="signup-form">
    <h3>Registeration Form</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
     <div class="form-group">
        <input type="text" name="fullname" placeholder="FullName..." value="<?php if(isset($_POST['signup_submit']))     echo $_POST['fullname']; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="email" placeholder="Email..." value="<?php if(isset($_POST['signup_submit']))     
        echo $_POST['email']; ?>">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="password...">
      </div>
      <div class="form-group">
        <input type="password" name="confirm_password" placeholder="confirm password...">
      </div>
      <div class="form-control">
      <button type="submit" name="signup_submit" class="submit" title="signup">signup</button>
      </div>
    </form>
    <a href="index.php" class="not-a-player" title="sign in">back to sign in ?</a>
  </div>
<?php include_once 'footer.php'; ?>