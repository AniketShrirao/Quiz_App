<?php 
  include_once 'header.php'; 
?>  
  <div class="quiz-page">
    <!-- quiz heder start -->
    <div class="quiz-header">
      <div class="quiz-user">
        <span class="user">user name</span>
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
          <!-- quiz control buttons start-->
            <div class="quiz-buttons">
              <div>
              <input type="submit" class="btn-sub" value="submit">
              </div>              
            </div> 
          <!-- quiz control buttons end-->   
        </form>        
      </div>
      <!-- quiz body end -->
  </div>
<?php include_once 'footer.php'; ?>