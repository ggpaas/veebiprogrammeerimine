<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
    <?php
	$userName = "Gevin Paas";
	$fullTimeNow = Date ("D.m.Y H:i:s");
	$dayNow = Date ("d");
	$weekDayNow = date("N");
	$weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthNow = Date ("m");
	$monthsET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$yearNow = Date ("Y");
     
    ?>
    Leht</title>
</head>
<body>
<p> Lehe avamise hetkel oli aeg:
<?php
  echo $weekDaysET[$weekDayNow-1];
  echo ", ";
  echo $dayNow;
  echo ". ";
  echo $monthsET[$monthNow-1];
  echo ". ";
  
?>