<?php
if(!isset($_SESSION)) {
    session_start();
}

if($_SESSION["paakirjautuminen"] != "ok"){   
    header("Location:kirjaudu.php");
} //if
?>
