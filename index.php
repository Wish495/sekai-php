<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); ?>
<!doctype html>
<html>
  <head>
    <title>Wish</title>
    <meta name="author" content="Wish">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="assets/favicon/wish/196.png" type="image/png" sizes="196x196">
    <link rel="icon" href="assets/favicon/wish/128.png" type="image/png" sizes="128x128">
    <link rel="icon" href="assets/favicon/wish/96.png" type="image/png" sizes="96x96">
    <link rel="icon" href="assets/favicon/wish/32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="assets/favicon/wish/16.png" type="image/png" sizes="16x16">
    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>$(document).ready(function(){$("[data-toggle='tooltip']").tooltip();});</script>
    <script>
      var discord = 0;
      function Discord(){if(discord==0){showDiscord();discord=1}else{hideDiscord();discord=0}}
      function showDiscord(){document.getElementById("discord").classList.add("visible")}
      function hideDiscord(){document.getElementById("discord").classList.remove("visible")}
      function showLogin(){document.getElementById("links").classList.add("trigger");document.getElementById("login").classList.add("trigger")}
      function showLinks(){document.getElementById("links").classList.remove("trigger");document.getElementById("login").classList.remove("trigger")}
      function anonLogin(){window.location.href="php/anon_login.php";}
    </script>
  </head>
  <body>
    <?php if (isset($_GET["e"])) { if ($_GET["e"] == "1"): ?><div class="alert alert-warning alert-dismissible fade show">
      <strong>Error</strong> &mdash; The user entered does not exist.
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div><?php echo "\n    "; elseif ($_GET["e"] == "2"): ?><div class="alert alert-warning alert-dismissible fade show">
      <strong>Error</strong> &mdash; The incorrect password was entered.
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div><?php echo "\n    "; endif; } ?>
    <div class="links" id="links">
      <h1>Wish</h1>
      <a class="link" href="//twitter.com/Wish495" target="_blank">
        <img src="assets/svg/twitter.svg" data-toggle="tooltip" data-placement="top" title="Twitter">
      </a>
      <a class="link" href="//youtube.com/user/wish495" target="_blank">
        <img src="assets/svg/youtube.svg" data-toggle="tooltip" data-placement="top" title="YouTube">
      </a>
      <a class="link" href="//twitch.tv/TheRealWish" target="_blank">
        <img src="assets/svg/twitch.svg" data-toggle="tooltip" data-placement="top" title="Twitch">
      </a>
      <a class="link" href="//github.com/Wish495" target="_blank">
        <img src="assets/svg/github.svg" data-toggle="tooltip" data-placement="top" title="GitHub">
      </a>
      <a class="link" onclick="Discord()">
        <img src="assets/svg/discord.svg" data-toggle="tooltip" data-placement="top" title="Discord">
      </a>
      <a class="link" href="//steamcommunity.com/id/sadwish" target="_blank">
        <img src="assets/svg/steam.svg" data-toggle="tooltip" data-placement="top" title="Steam">
      </a>
      <a class="link" href="//osu.ppy.sh/users/Wishu" target="_blank">
        <img src="assets/svg/osu.svg" data-toggle="tooltip" data-placement="top" title="osu!">
      </a>
      <a class="link" href="//last.fm/user/Wish495" target="_blank">
        <img src="assets/svg/lastfm.svg" data-toggle="tooltip" data-placement="top" title="Last.fm">
      </a>
      <a class="link" href="//myanimelist.net/profile/Ain" target="_blank">
        <img src="assets/svg/myanimelist.svg" data-toggle="tooltip" data-placement="top" title="MyAnimeList">
      </a>
      <br>
      <?php if (isset($_SESSION["username"])): ?><a href="/chan/" class="btn btn-dark jp">
        &#x304A;&#x3063;&#x3059;&#x3001;<b><?php echo $_SESSION["username"]; ?></b>!&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i>
      </a>
      <?php else: ?><button class="btn btn-dark jp" onclick="showLogin()">
        &#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i>
      </button><?php endif; echo "\n"; ?>
    </div>
    <div class="login card bg-dark text-white" id="login">
      <h5 class="card-header jp">&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;</h5>
      <form class="card-body" action="php/login.php" method="post">
        <div class="form-group">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-user-circle fa-fw"></i></div>
            <input class="form-control jp" type="text" placeholder="&#x30E6;&#x30FC;&#x30B6;&#x30FC;&#x540D;" name="username" maxlength="16" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
            <input class="form-control jp" type="password" placeholder="&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;" name="password" maxlength="16" required>
          </div>
        </div>
        <div class="form-group">
          <div class="btn-group">
            <a class="btn btn-secondary jp" onclick="showLinks()">&#x7D42;&#x4E86;</a>
            <input class="btn btn-primary jp" type="submit" value="&#x30ED;&#x30B0;&#x30A4;&#x30F3;">
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-success" type="button" onclick="anonLogin()">Anonymous&#x3068;&#x3057;&#x3066;&#x30ED;&#x30B0;&#x30A4;&#x30F3;</button>
        </div>
      </form>
    </div>
    <div class="views">
      <?php include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");$query=$db->prepare("SELECT num FROM views ORDER BY num DESC LIMIT 1");$query->execute();$result=$query->fetchColumn();$result=str_split($result+1);foreach($result as $key=>$value){$value="<img src=\"assets/views/$value.gif\">";echo $value;}$query=$db->prepare("INSERT INTO views (ip) VALUES (:ip)");$query->bindValue(":ip",$_SERVER["REMOTE_ADDR"]);$query->execute();echo "\n"; ?>
    </div>
    <div id="discord">
      <iframe src="https://discordapp.com/widget?id=212908561771134977&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
    </div>
    <div class="github">
      <?php $proc=proc_open("git rev-parse --short HEAD",array(array("pipe","r"),array("pipe","w"),array("pipe","w")),$pipes);$commit=trim(stream_get_contents($pipes[1])); ?><a target="_blank" href="//github.com/Wish495/sekai-php/commit/<?php echo $commit; ?>">
        <button class="btn btn-dark"><i class="fa fa-github"></i>&nbsp;<?php echo $commit; ?></button>
      </a>
    </div>
    <div class="copyright">
      <button class="btn btn-dark">&copy; Wish 2016-2018</button>
    </div>
    <div class="ms">
      <button class="btn btn-dark"><?php $time = explode(' ', microtime()); $finish = $time[1] + $time[0]; echo round(($finish-$start),5) * 1000 . "ms"; ?></button>
    </div>
  </body>
</html>
