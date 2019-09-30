<?php
   require("../../../config_vp2019.php");
   require("functions_main.php");
   require("functions_user.php");   
  $database = "if19_gevin_paas_1";
  $notice = null;
  $name = null;
  $surname = null;
  $email = null;
  $gender = null;
  $birthMonth = null;
  $birthYear = null;
  $birthDay = null;
  $birthDate = null;
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
  
  //muutujad võimalike veateadetega
  $nameError = null;
  $surnameError = null;
  $birthMonthError = null;
  $birthYearError = null;
  $birthDayError = null;
  $birthDateError = null;
  $genderError = null;
  $emailError = null;
  $passwordError = null;
  $confirmpasswordError = null;
  
  //for tsükli näidis
  //$i = $+1;
  //$i+=1;
  //$i ++;
 /*for($i = 0; $i < 10; $i ++){ 
	   echo  "Tsükkel" .$i;
  }*/
  
  //kui on uue kasutaja loomise nuppu vajutatud
  if(isset($_POST["submitUserData"])) {
	  //kui on sisestatud nimi
	  if(isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		  $name = test_input($_POST["firstName"]);
	  } else {
		  $nameError = "Palun sisestage eesnimi";
		  
	//ajutine
	$surname = ($_POST["surName"]);
	$gender = ($_POST["gender"]);
	$email = ($_POST["email"]);
	//strlen($_POST["password"])<8  siis on liiga lühike
	  }	
	  //kontrollime, kas sünniaeg sisestati ja kas on korrektne
  if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])){
	  $birthDay = intval($_POST["birthDay"]);
  } else {
	  $birthDayError = "Palun vali sünnikuupäev!";
  }
  
  if(isset($_POST["birthMonth"]) and !empty($_POST["birthMonth"])){
	  $birthMonth = intval($_POST["birthMonth"]);
  } else {
	  $birthMonthError = "Palun vali sünnikuu!";
  }
  
  if(isset($_POST["birthYear"]) and !empty($_POST["birthYear"])){
	  $birthYear = intval($_POST["birthYear"]);
  } else {
	  $birthYearError = "Palun vali sünniaasta!";
  }

	 if(empty($nameError)and empty($surnameError)and empty($birthMonthError)and empty($birthYearError)and empty($birthDayError)and empty($birthDateError)and empty($genderError)and empty($emailError) and empty($passwordError) and empty($confirmpasswordError)){
		 echo "Perekonnanimi: " .$surname;
	echo "email: " .$email;
	echo "Sugu: " .$gender;
	echo "Sünnikuupäev: " .$birthDate;
	echo "Parool: " .$_POST["password"];
		  //$notice = signUp($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
		  
	  }
  
  }//kui on nuppu vajutatud
  
  
?>

<!DOCTYPE html>
<html lang = "et"> 
  <head> 
    <meta charset="utf-8">
	<title>Katselise veebi uue kasutaja loomine</title>
  </head>
  <body>
    <h1>Loo endale kasutajakonto</h1>
	<p>See leht on valminud TLÜ õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Eesnimi:</label><br>
	  <input name="firstName" type="text" value="<?php echo $name; ?>"><span><?php echo $nameError; ?></span><br>
      <label>Perekonnanimi:</label><br>
	  <input name="surName" type="text" value="<?php echo $surname; ?>"><span><?php echo $surnameError; ?></span><br>
	  <br>
	  <label>Sünnikuupäev: </label>
	  <?php
	  //sünnikuupäev
	  echo '<select name="birthDay">'."\n";
	  echo "\t \t" .'<option value="" selected disabled>päev</option>' ."\n";
	  for($i = 1; $i<32; $i ++) {
		  echo "\t \t" . '<option value="' .$i .'"';
		  if($i == $birthDay) {
			  echo " selected";
		  }
		  echo ">" .$i ."</option> \n";
	  }
	  
	  echo "\t </select> \n";
	  ?>
	    
	  <br>
	  <label>Sünnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthDateError ." " .$birthDayError ." " .$birthMonthError ." " .$birthYearError; ?></span>
	  
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>"><span><?php echo $emailError; ?></span><br>
	  <label>Salasõna (min 8 tähemärki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake salasõna:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Loo kasutaja"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>