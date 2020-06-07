<?php 
  include_once 'header.php'; 
?>
  <!--main section start-->
    <main>
    <!--banner section start-->
      <section class="banner">
        <div class="wrapper">
          <h2>Quizz it up</h2>
        </div>
      </section>  
    <!--banner section end--> 
<?php 
  if(!isset($_SESSION['user_email'])) { 
    if(isset($_GET['error']) ) {
      include_once "errors.php";
      echo '<span class="error error-span">'.$error.'</span>';
    } 
    if (isset($_POST['login_submit'])) {
      require_once '../controller/validation.php';
      $validator = new Login_Validation();
      $validator->loginValidator($_POST['email'],$_POST['password']);
      require_once '../model/queries.inc.php';
      $query = new queries;
      $has_quizzed = $query->checkStatus($_POST['email']);
    }
?>
  <div class="login-form">
    <h3>Login Form</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
      <div class="form-group">
        <input type="text" name="email" placeholder="Email...">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="password...">
      </div>
      <div class="form-control">
      <button type="submit" name="login_submit" class="submit" title="Login">Login</button>
      </div>
    </form>
    <a href="signup.php" class="not-a-player" title="signup">Not yet quizzed ?</a>
  </div>
</main>
<!--main section end-->
<?php 
  include_once 'footer.php';
} else {
  session_unset();
  session_destroy();
  header("Location: signup.php");
}
?>