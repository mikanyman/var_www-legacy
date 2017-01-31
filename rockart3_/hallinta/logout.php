<?php
session_start();
if(isset($_SESSION["paakirjautuminen"])) {
  unset($_SESSION["paakirjautuminen"]);
}
session_destroy();
header("location:kirjaudu.php");

?>
