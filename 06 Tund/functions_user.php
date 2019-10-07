<?php
  //Käivitame sessiooni
  session_start();
  var_dump($_SESSION);

function signUp($name, $surname, $email, $gender, $birthDate, $password){
/* 	echo "Perekonnanimi: " .$surname;
	echo "email: " .$email;
	echo "Sugu: " .$gender;
	echo "Sünnikuupäev: " .$birthDate;
	echo "Parool: " .$password;
	 */
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn-> prepare ("INSERT INTO vpusers3 (firstname, lastname, birthdate, gender, email, password) VALUES (?,?,?,?,?,?)");
	echo $conn->error;
	
	//valmistame parool salvestamiseks ette
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	$stmt->bind_param("sssiss",$name , $surname, $birthDate, $gender, $email, $pwdhash);
	
	if($stmt->execute()){
		$notice = "Salvestamine õnnestus!";
	} else {
		$notice = "Kastutaja loomisel tekkis tõrge: " .$stmt->error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}
	function signIn($email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT password FROM vpusers3 WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM vpusers3 WHERE email=?");
		  echo $mysqli->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
		  //Salvestame kasuataja nime sessiooni muutujatesse
		  $_SESSION["userId"] = $idFromDb;
		  $_SESSION["userFirstName"] = $firstnameFromDb;
		  $_SESSION["userLastName"] = $lastnameFromDb;
		  
		  
		  
		  $stmt->close();
		  $mysqli->close();
	
		  header("Location: home.php");
		  exit();
		  
		} else {
		  $notice = "Vale salasõna!";
		}
	  } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
	  }
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
  }//sisselogimine lõppeb
  
function updateuserprofile($userId ,$mydescription ,$mybgcolor, $mytxtcolor){

	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn-> prepare ("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES (?,?,?,?)");
	echo $conn->error;
	
	//valmistame parool salvestamiseks ette
	$stmt->bind_param("isss",$userId ,$mydescription ,$mybgcolor, $mytxtcolor);
	
	if($stmt->execute()){
		$notice = "Salvestamine õnnestus!";
	} else {
		$notice = "Kastutaja loomisel tekkis tõrge: " .$stmt->error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}
function readuserprofiledata($userId){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT description, bgcolor, txtcolor FROM vpuserprofiles WHERE userId=?");
	echo $mysqli->error;
	$stmt->bind_param("i", $userId);
	
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		$stmt->bind_result($mydescription ,$mybgcolor, $mytxtcolor);
		  $stmt->close();
		  $mysqli->close();
	

		}	
	  } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
	  }
	
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
?>