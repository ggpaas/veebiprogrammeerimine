<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");   
  $database = "if19_gevin_paas_1";
  
  
   
  $notice = null;
  $mydescription = "";
  $mybgcolor = "#ffffff";
  $mytxtcolor = "#000000";
  $picture = "";
  
  
  $nameError = null;
   $userId = $_SESSION["userId"];
   
  if(isset($_POST["submitProfile"])){
	  	if(isset($_POST["description"]) and !empty($_POST["description"])){
		$mydescription = test_input($_POST["description"]);
		}
		if(isset($_POST["bgcolor"])){
			$mybgcolor = $_POST["bgcolor"];
		}
		if(isset($_POST["txtcolor"])){
			$mytxtcolor = $_POST["txtcolor"];
		}
	 $notice = updateuserprofile($userId, $mydescription ,$mybgcolor, $mytxtcolor);
	  
  }
  
  
?>
<!DOCTYPE html>
<html lang="et">
  <head>
  <style>
	body{background-color: #e8eaf9; 
	color: #000000} 
</style>
    <meta charset="utf-8">
	<title>Katselise veebi uue kasutaja loomine</title>
  </head>
  <body>
    <h1>Loo endale kasutajaprofiil</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>
	 </body>
</html>