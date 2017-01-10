<!DOCTYPE html>
<html>
  <head>
    <meta name="robots" content="noindex">
    <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/webassets/style.css" type="text/css">
    <title>
      Login
    </title>
  </head>
  <body style="background:linear-gradient(to left,#EECDA3,#EF629F);">
    <div class="centerDiv">
      <h2 style="text-align:center;margin-top:0px;">
        Login to Sekai
      </h2>
      <form style="text-align:center;color:white;" action="/access/login.php" method="post" accept-charset="UTF-8">
        <label>
          <b>
            Username
          </b>
        </label>
        <br>
        <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="16" required>
        <br>
        <label>
          <b>
            Password
          </b>
        </label>
        <br>
        <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="16" required>
        <br>
        <button type="submit">
          Login
        </button>
        <a href="/register">
          <button type="button">
            Register
          </button>
        </a>
      </form>
    </div>
    <p class="beta">
      DEV 0.5
    </p>
    <p class="pageTitle">
      <b>Sekai</b>
    </p>
<?php
    session_start();
    include("access/sql.php");
    mysqli_select_db($link,"views");
    $ip = $_SERVER['REMOTE_ADDR'];
    $getView = 'SELECT count FROM views ORDER BY count DESC LIMIT 1';
    $getView = mysqli_query($link,$getView);
    $getView = mysqli_fetch_array($getView,MYSQLI_ASSOC);
    $newView = $getView["count"] + 1;
    if($ip != "::1") {
      $postIp = "INSERT INTO views (ip) VALUES ('$ip')";
      if(mysqli_query($link,$postIp)) {
        mysqli_close($link);
        echo('    <div class="viewcount">
');
        $showView = str_split($newView);
        $places = count($showView);
        $x = 0;
        while($x < $places) {
          echo('      <img src="/webassets/views/'.$showView[$x].'.gif">
');
          $x += 1;
        }
        echo('    </div>
');
      } else {
        mysqli_close($link);
      }
    } elseif($ip == "::1") {
      #echo('<div class="viewcount"><p style="margin-bottom:10px;margin-right:10px;font-size:300%;">Ohayo ヰシュー様!</p></div>');
    }
    if(isset($_SESSION["loginerror"])) {
      echo('<div class="centerDiv" style="padding-bottom:1em;">
      <div class="errorDiv">
        <p class="errorText">
          ');
      if($_SESSION["loginerror"]==1) {
        echo("User not found.");
      } elseif($_SESSION["loginerror"]==2) {
        echo("Your account has not been approved yet.");
      } elseif($_SESSION["loginerror"]==3) {
        echo("Incorrect password.");
      }
      echo("
        </p>
      </div>
    </div>
");}
    ?>
  </body>
</html>
<?php session_destroy();?>
