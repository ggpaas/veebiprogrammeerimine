<?php
  $userName = "Gevin Paas";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  if($hourNow < 8){
	$partOfDay = "varane hommik";  
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
    <?php
      echo $userName;
    ?>
    Leht</title>
</head>
<body>
  <?php
  echo "<h1>" .$userName ." koolitöö leht </h1>";
  ?>
  
  <p>See leht on tehtud kooli tööks mõeldud tööks ja ei sisalda tõsiselt võetavat sisu! </p>
  
  <hr>
  <p>Lehe avamise hetkel oli aeg:
  <?php
    echo $fullTimeNow;
  ?>
  .</p>
  <?php
    echo "<p>Leheavamise hetkel oli " .$partOfDay .	".</p>"; 
	
  ?>
</body>
</html>