<?php
session_start();

unset($_SESSION["kayttajan_tiedot"]);

header("Location: ../index.php");
?>