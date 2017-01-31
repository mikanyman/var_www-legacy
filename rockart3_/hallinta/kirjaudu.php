<?php
//Otetaan yhteys / Avataan kanta
include("includes/db_open.php");

$virhe="";

//tarkastetaan onko nappia painettu
if (isset($_POST["nappi1"])) {
    //tarkastetaan onko pääkäyttäjä sekä luodaan sessio
    if($_POST["kayttajanimi"] and $_POST["salasana"]) {
	if($_POST['kayttajanimi'] == 'admin') {
        	$tulos=mysql_query("SELECT * FROM paakayttaja WHERE kayttajanimi='$_POST[kayttajanimi]' and salasana='$_POST[salasana]'");
		if(mysql_num_rows($tulos)) {
                	if(!isset($_SESSION)) {
                    		session_start();
                	} // if
                	$_SESSION['paakirjautuminen'] = 'ok';
                	$_SESSION['kayttajanimi'] = $_POST['kayttajanimi'];
                	header("location:etusivu.php");
		} // if
        } //if
        else {
		$tulos=mysql_query("SELECT * FROM kayttaja WHERE kayttajanimi='$_POST[kayttajanimi]' and salasana='$_POST[salasana]'");
		if(mysql_num_rows($tulos)) {
                	if(!isset($_SESSION)) {
                        	session_start();
                        } // if
                        $_SESSION['kirjautuminen'] = 'ok2';
                        $_SESSION['kayttajanimi'] = $_POST['kayttajanimi'];
                        header("location:etusivu2.php");
		} // if
	} // else
    } else {
        $virhe="V&auml;r&auml; k&auml;ytt&auml;j&auml;nimi tai salasana.";
    } //else

    //tarkastetaan onko käyttäjä sekä luodaan sessio
/*    if($_POST["kayttajanimi"] and $_POST["salasana"]) {
        $tulos2=mysql_query("SELECT * FROM kayttaja WHERE kayttajanimi='$_POST[kayttajanimi]' and salasana='$_POST[salasana]'");
            //Tutkitaan, onko tulos tyhjä
            if(mysql_num_rows($tulos2)) {
                $_SESSION['kirjautuminen']="ok2";
                $_SESSION['kayttajanimi']=$_POST["kayttajanimi"];
                header("location:etusivu2.php");
            } //if
    }//if 
    else {
        $virhe="V&auml;r&auml; k&auml;ytt&auml;j&auml;nimi tai salasana.";
    } //else
*/
} //if nappi
if($yhteys) {
    mysql_close($yhteys);
}

print $virhe; //tulostetaan virhe-ilmoitus jos käyttäjänimi tai salasana on väärin
?>

Ole hyv&auml; ja kirjaudu j&auml;rjestelm&auml;&auml;n!

<form method="post" action="kirjaudu.php">
    K&auml;ytt&auml;j&auml;nimi:<br/><input name="kayttajanimi" /><br/><br/>
    Salasana:<br/><input type="password" name="salasana" />
    <br/><br/>
    <input type="submit" value="Kirjaudu" class="button" name="nappi1"/>
</form>
