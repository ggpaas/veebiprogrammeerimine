<?php
require("../../../config_vp2019.php");
require("functions_film.php");
  $userName = "Gevin Paas";
  $database = "if19_gevin_paas_1";
  
  $filmInfoHTML = readAllFilms();
  
  
?>

<body>
  <?php
  echo "<h1>" .$userName ." koolitöö leht </h1>";
  ?>
  
  <p>See leht on tehtud kooli tööks mõeldud tööks ja ei sisalda tõsiselt võetavat sisu! </p>
  
  <hr>
  <h2>Eesti filmid</h2>
  <p>Pregu on andmebaasis järgmised filmid:</p>
  <?php
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  echo $filmInfoHTML;
  ?>
  </body>
</html>