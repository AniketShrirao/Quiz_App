<?php
  session_start();
?>
<!doctype html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <title>Home | Quiz app</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" media="screen" href="assets/vendor/font-awesome/css/all.min.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" media="screen" href="../assets/css/style.css" >
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <div class="wrapper">
        <div class="logo">
          <h1>
            <a href="index.html" title="quizapp"><img src="https://via.placeholder.com/100x100/A4DE02/000/?text=QZ" alt="quizapp"></a>
          </h1>
        </div>
        <nav>
          <ul>
            <?php if(isset($_SESSION['user_email'])) { ?>
            <li>
              <a href="../controller/logout.inc.php" title="Logout">Logout</a>
            </li>
            <?php } ?>
            <?php if(isset($_GET['correct_answer'])) { ?>
            <li>
              <a href="../views/leaderboard.php" title="leaderboard">Leaderboard</a>
            </li>
            <?php } ?>
          </ul>
        </nav> 
      </div>
    </header>
    <!--header section end-->