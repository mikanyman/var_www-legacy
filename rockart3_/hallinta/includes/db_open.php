<?php
$tietokantapalvelin = "localhost";
$kayttajatunnus = "Rockart";
$salasana = "Rockart";
$tietokannan_nimi = "rockart";
$yhteys = mysql_connect($tietokantapalvelin, $kayttajatunnus, $salasana);
mysql_select_db($tietokannan_nimi, $yhteys);
?>
