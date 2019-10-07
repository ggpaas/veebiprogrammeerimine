<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_gevin_paas_1";
  
  //kui pole sisse logtiud
  if(!isset($_SESSION["userFirstName"])){
	  //siis jõuga sisse logimise lehele
	  header("Location; page.php");
	  exit();
  }
    
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: page.php");
	    exit();
	}
  $userName = $_SESSION["userFirstName"] ." ".$_SESSION["userLastName"];
  
  require("header.php");
?>

<body>
  <?php
  echo "<h1>" .$userName ." koolitöö leht </h1>";
  ?>
  
  <p>See leht on tehtud kooli tööks mõeldud tööks ja ei sisalda tõsiselt võetavat sisu! </p>
  <hr>
  <p><a href="?Logout=1">Logi välja</p>
 
<body>
</html>