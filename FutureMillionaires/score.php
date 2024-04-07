<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="play.css">
  <title>Document</title>
</head>
<body>

  <?php

  include "common.php";

  $score;
  $status;
  $username;

  if (array_key_exists("score", $_GET) && array_key_exists("status", $_GET) && array_key_exists("username", $_COOKIE)) {
      $score = $_GET["score"];
      $status = $_GET["status"];
      $username = $_COOKIE["username"];

      $dataToWrite = "$username,$score\n";
      file_put_contents('user_scores.txt', $dataToWrite, FILE_APPEND);
  } else {
      header("Location: index.html");
      exit(); // Ensure that subsequent code is not executed after redirection
  }

  ?>

  <?php echo createNav()?>
  <main style="align-items:center;">

    <?php
    if ($status == "lost") {
        // Corrected the string interpolation
        $str = "<h1>Aww! Nice try $username. Your score: $score</h1>
        <div class='links'>
          <a href='play.php'>Click here to play again</a>
          <a href='leaderboard.php'>Click here to check the leaderboard</a>
        </div>";
        echo $str;
    }
    else{
      $str = "<h1>Wowww $username!! You became a millionaire.</h1>
        <div class='links'>
            <a href='play.php'>Click here to play again</a>
            <a href='leaderboard.php'>Click here to check the leaderboard</a>
          </div>";

      echo $str;
    }
    ?>
  </main>
</body>
</html>