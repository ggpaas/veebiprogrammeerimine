<?php
require("../../../config_vp2019.php");
 require("functions_film.php");
  $userName = "Gevin Paas";
  $database = "if19_gevin_paas_1";
  
  //var_dump($_POST);
  //kui on nuppu vajutatud
  if(isset($_POST["submitFilm"])){
	  //salvestame vähemalt kui pealkiri on olemas
	  if(!empty($_POST["filmTitle"])){
	 saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenrs"], $_POST["filmCompany"], $_POST["filmDirectors"]);
  }}
  
  
?>

<body>
  <?php
  echo "<h1>" .$userName ." koolitöö leht </h1>";
  ?>
  
  <p>See leht on tehtud kooli tööks mõeldud tööks ja ei sisalda tõsiselt võetavat sisu! </p>
  
  <hr>
  <h2>Eesti filmid, lisaem uue</h2>
  <p>Täida kõik failid ja lisa film andmebaasi.</p>
  <form method="POST">
  <label>Sisesta pealkiri: </label><input type="text" name="filmTitle">
  <br>
  <label>Filmi tootmisaasta</label><input type="number" max="2019" value="2019" name="filmYear">
  <br>
  <label>Filmi kestus (min): </label><input type="number" min="1" max="300" value="80" name="filmDuration">
  <br>
  <label>Filmi zanr: </label><input type="text" name="filmGenrs">
  <br>
  <label>Filmi tootja: </label><input type="text" name="filmCompany">
  <br>
  <label>Filmi lavastaja: </label><input type="text" name="filmDirectors">
  <br>
  <input type="submit" value="Salvesta filmi info" name="submitFilm">
  </form>
  <?php
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  //echo $filmInfoHTML;
  ?>
  </body>
</html>