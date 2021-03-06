<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <title>&#x4E16;&#x754C; &raquo; Anime</title>
    <?php include("{$_SERVER["DOCUMENT_ROOT"]}/php/sources.php"); ?>
  </head>
  <body>
    <div id="animeList" class="accordion">
    <?php
      $files = array_slice(scandir("./"), 2);
      $anime = [];
      $i = 1;
      foreach ($files as $key) {
        if (is_dir($key)) {
          array_push($anime, $key);
        }
      }
      foreach ($anime as $key): ?>
      <div class="card bg-dark">
        <button class="card-header mb-0 btn d-flex collapsed text-white" data-toggle="collapse" data-target="#a<?php echo $i; ?>"><?php echo $key; ?></button>
        <div id="a<?php echo $i; ?>" class="collapse" data-parent="#animeList">
          <p class="card-text bg-light">
            <?php
              $json = json_decode(fread(fopen("$key/info.json", "r"), filesize("$key/info.json")));
              echo $json->{"description"};
            ?>
          </p>
        </div>
      </div>
    <?php $i++; endforeach; ?>
    </div>
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>$(document).ready(function(){$("[data-toggle='collapse']").collapse();});</script>
    <?php include("{$_SERVER["DOCUMENT_ROOT"]}/php/buttons.php"); ?>
  </body>
</html>
