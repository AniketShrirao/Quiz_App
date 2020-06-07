<?php 
  include_once 'header.php'; 
 if($_SESSION['block'] == true) { header("Location: ../views/index.php"); } 
?>  
  <div class="quiz-page">
    <!-- quiz heder start -->
    <div class="quiz-header">
      <div class="quiz-user">
        <span class="user"><?php if(isset($_SESSION['user_email'])) { echo $_SESSION['user_name']; } ?></span>
      </div>
    </div>
    <!-- quiz heder end -->
    <!-- quiz body start -->
    <div class="quiz-body">
      <!-- questions and options -->
      <form action="../controller/quiz.inc.php" class="quiz-form" method="post">
      <?php 
        if(isset($_SESSION['user_email'])) { 
          require_once '../model/queries.inc.php';
          $query = new queries;
          $query->displayData();
        }
        ?>
          <!-- questions and options end-->
          <div class="form-group">
            <input type="hidden" name="status" value="1">
          </div>
          <!-- quiz control buttons start-->
            <div class="quiz-buttons">
              <div>
              <input type="submit" class="btn-sub" name="quiz_submit" value="submit">
              </div>              
            </div> 
          <!-- quiz control buttons end-->   
        </form>        
      </div>
      <!-- quiz body end -->
  </div>
<?php include_once 'footer.php'; ?>