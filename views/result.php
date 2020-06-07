<?php 
  if(!isset($_SESSION['user_email'])) { 
    include_once 'header.php';
echo "<div class='outcome'>
    <p class='result'> you got ".$_GET['correct_answer']." out of 6 answers correct</p>
    <p class='result-leaderboard'>to check your Rank visit leaderboard page from above. </p>
    </div>"; 
    include_once 'footer.php';
}

?>