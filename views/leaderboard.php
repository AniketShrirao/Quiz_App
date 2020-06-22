<?php 
  // if(!isset($_SESSION['user_email'])) { 
  include_once 'header.php';
?>
<h1 class="leaderboard-title">Leaderboard</h1>
<ul class='Ranking'>
<li class="rank-head">
    <p>Image</p>
    <p>Name</p>
    <p>Date</p>
    <p>Score</p>
  </li>
  <?php 
      require_once '../model/queries.inc.php';
      $query = new queries;
      $query->displayRanks();
    ?>
</ul>
<?php 
  include_once 'footer.php';
// }

?>