<?php
function readAllFilms(){
		  
	 
	  
	  //loeme andmebaasist
	  //loome andembaasiühenduse (näiteks $conn")
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  //valmistame ette päringu
	  $stmt = $conn->prepare("SELECT pealkiri,aasta, kestus, zanr, tootja, lavastaja FROM film");
	  //seome saadava tulemuse muutjaga
	  $stmt->bind_result($filmTitle, $filmYear, $filmDuration, $filmGenrs, $filmCompany, $filmDirectors);
	  //käivitame SQL päringu
	  $stmt->execute();
	  $filmInfoHTML = "";
	  while($stmt->fetch()){
		  $filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		  $filmInfoHTML .= "<p>Zanr: " .$filmGenrs .", ";
		  $filmInfoHTML .= "Lavastaja: " .$filmDirectors .", ";
		  $filmInfoHTML .= "Kestus: " .$filmDuration .", ";
		  $filmInfoHTML .= "Tootnud: " .$filmCompany .", ";
		  $filmInfoHTML .="Tootmisaasta. " .$filmYear ." .</p>";
		 //echo $filmTitle; 
		 $filmHours = floor($filmDuration / 60);
		$filmMinutes = ($filmDuration % 60);
		
		if ($filmHours > 1 ) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tundi ja " . $filmMinutes . " minutit.</p>";
		}
		elseif($filmHours < 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmMinutes . " minutit.</p>";	
		}
		elseif($filmMinutes <= 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minut.</p>";
		}
		elseif ($filmHours == 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minutit.</p>";
		}	
		
		/**
		  *	Film kui võrdub 0, siis näitab minutit. 
		  * Film kui võrdub 1, siis on "tund". Muidu näitab "tundi"
		  * 
		  * Minutid kui võrdub 1, siis on "minut". Muidu näitab "minutit"
		  */
		
		
		
		// Filmhours = 0 ja filmMinutes või filmhour = 1 ja filmminust
		if (($filmHours == 0 OR $filmHours == 1)) {
			if ($filmMinutes == 1) {
				//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minut.</p>";
			} else {
				//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minutit.</p>";
			}
		}
		else {
			//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tundi ja " . $filmMinutes . " minutit.</p>";
		}
		
	}
		 
	  
	  $stmt->fetch();
	  //echo $filmTitle;
	  
	  
	  //sulgeme ühenduse
	  $stmt->close();
	  $conn->close();
	  //väljastan väärtuse
	  return $filmInfoHTML;
	  }
	  
	  function saveFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenrs, $filmCompany, $filmDirectors){
		   $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		   $stmt=$conn->prepare("INSERT INTO film(pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
		   echo $conn->error;
		   //s -string, i -integer, d-decimal
		   $stmt->bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenrs, $filmCompany, $filmDirectors);
		   $stmt->execute();
		   
		$stmt->close();
		$conn->close();
		  
	  }
	  

//lisame lehe päise
require("header.php");
?>