<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_gevin_paas_1";
  
  $userName = "Sisselogitud kasutaja!";

  
  $notice = "";
  $emailError = "";
  $passwordError = "";
  $email = "";
  
 
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  if($hourNow < 8){
	$partOfDay = "varane hommik";  
  }
  if($hourNow <= 1) {
	  $partOfDay = "Gevin õpib"; 	  
  }
  if($hourNow >= 8) {
	  $partOfDay = "Gevin koolis"; 	  
  }
  
  //info semestri kulgemise kohta.
  $semesterStart = new DateTime("2019-9-2");
  $semesterEnd = new DateTime("2019-12-13");
  $semesterDuration = $semesterStart->diff($semesterEnd);
  $today = new DateTime("now");
  $fromsemesterStart = $semesterStart->diff($today);
  //var_dump($fromsemesterStart);
  $semesterInfoHTML = "<p>Siin peaks olemas info semesteri kohta! <p>";
  $elapsedValue = $fromsemesterStart->format("%r%a");
  $durationValue = $semesterDuration->format("%r%a");
  //echo $testValue; 
  //<meter min="0" max="155" value="33">Väärtus</meter>
  if($elapsedValue > 0){
	  $semesterInfoHTML = "<p>Semester on täies hoos: ";
	  $semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
	  $semesterInfoHTML .= 'value = "' .$elapsedValue .'">';
	  $semesterInfoHTML .= round($elapsedValue /$durationValue * 100, 1) ."%";
	  $semesterInfoHTML .="</meter>";
	  $semesterInfoHTML .="</p>";
  }
  elseif ($elapsedValue > $durationValue){
	  $semesterInfoHTML = '<p>Semester on läbi! </p>';
  }
  else {
	  $semesterInfoHTML = '<p>Semester pole veel alanud! </p>';
  }
  
  //Foto lisamine lehele
  $allPhotos = [];
  $dirContent = array_slice(scandir($photoDir), 2);
  //var_dump($dirContent);
  foreach ($dirContent as $file){
	  $fileInfo = getImageSize($photoDir .$file);
	  //var_dump($fileInfo);
	  if(in_array($fileInfo["mime"], $picFileTypes) == true){
		  array_push($allPhotos, $file);
	  }
  }
  
  
  
  //var_dump($allPhotos);
  $picCount = count($allPhotos);
  //echo $picCount;
  $picNum = mt_rand(0, ($picCount - 1));
  //echo $allPhotos [$picNum];
  $photoFile = $photoDir .$allPhotos[$picNum];
  $randomImgHTML = '<img src="' . $photoFile .'" alt="TLÜ Terra õppehoone ">';
  
  if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}
	  }
//lisame lehe päise
require("header.php");
?>

<body>
  <?php
  echo "<h1>" .$userName ." koolitöö leht </h1>";
  ?>
  
  <p>See leht on tehtud kooli tööks mõeldud tööks ja ei sisalda tõsiselt võetavat sisu! </p>
  <?php
  echo $semesterInfoHTML;
    
  ?>
  
  <hr>
  <p>Lehe avamise hetkel oli aeg:
  <?php
    echo $fullTimeNow;
  ?>
  .</p>
  <?php
    echo "<p>Lehe avamise hetkel oli " .$partOfDay .	".</p>"; 

  ?>
<hr>
<h3>Siit saad sisse logida: </h3>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
	<h2>Loo kasutja</h2>
	<p>Loo endale meie lehe <a herf="newuser.php">kasutaja</a></p>
	<hr>
  <?php
  echo $randomImgHTML; 
  ?>
  <hr>
  

<body>
</html>