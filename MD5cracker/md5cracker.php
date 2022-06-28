<html>
<head>
<title>Niels Meereboer MD5 cracker</title>
</head>
<body>
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash of a four digit pin and checks all 10000 combinations to determine the PIN.</p>
<p>
  <form action = "md5cracker.php" method = "GET">
     MD5: <input type="text" name="md5" size="40"> <br>
     <input type = "submit" value = "Crack MD5">
  </form>
</p>
<p style = "font-family:monospace">
<?php
$md5array = array();
if (isset($_GET["md5"])) {
    $md5 = $_GET["md5"];
    $time_start = microtime(true);
    for ($x = 0;$x < 10000;$x++) {
      $xfour = str_pad( "$x", 4, "0", STR_PAD_LEFT );
      $check = hash('md5', $xfour);
      $md5array[$check] = $xfour;
      if ($check == $md5) {
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        $new_md5array = array_slice($md5array, 0, 15, true);
        foreach ($new_md5array as $key => $value) {
          echo "$key " . "$value" . "<br/>\n";
        }
        echo "<br/>\n"."Total Execution Time: ".($execution_time*1000).' Milliseconds';
        echo "<br/>\n"."PIN : $xfour";
      }
    }
  if (array_key_exists($md5, $md5array))  {
    return False;
  }
  else {
    echo "<br/>\n"."PIN not found";
  }
}
else {
  echo "No MD5 entered yet";
}
?>
</p>
</body>
</html>
