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
          <div id="questions">
            <h3> </h3>
            <ul class="option-group">
              <li class="option">
              <input type="radio" id="answer" name="fourth_answer" value="">
              <div class="answer"> </div>
              </li>
              <li class="option">
              <input type="radio" id="answer" name="fourth_answer" value="">
              <div class="answer"> </div>
              </li>
              <li class="option">
              <input type="radio" id="answer" name="fourth_answer" value="">
              <div class="answer"> </div>
              </li>
              <li class="option">
              <input type="radio" id="answer" name="fourth_answer" value="">
              <div class="answer"> </div>
              </li>
            </ul> 
          </div>
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