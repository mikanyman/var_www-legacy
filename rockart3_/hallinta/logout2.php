<?php
session_start();
if(isset($_SESSION["kirjautuminen"])) {
  unset($_SESSION["kirjautuminen"]);
}
session_destroy();
header("location:kirjaudu.php");
?>
