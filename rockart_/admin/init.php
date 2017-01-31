<?php
session_start();

if ( empty ($_SESSION["kayttajan_tiedot"])) {
	
header("Location: login.php");
	
} //if

?>