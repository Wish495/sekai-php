<?php
$proc = proc_open(
  "git rev-parse --short HEAD",
  array(
    array(
      "pipe",
      "r"
    ),
    array(
      "pipe",
      "w"
    ),
    array(
      "pipe",
      "w"
    )
  ),
  $pipes
);
$commit = trim(
  stream_get_contents(
    $pipes[1]
  )
);
echo "<a target=\"_blank\" href=\"//gitlab.com/wishu/sekai-php/commit/$commit\">"
?>