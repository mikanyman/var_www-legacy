<?php
session_start();
if($_SESSION['paakirjautuminen']){
include("includes/session.php");
}//if
if($_SESSION['kirjautuminen']){
include("includes/session2.php");
}//if
include ("includes/db_open.php");

if($_SESSION['paakirjautuminen']){
include ("includes/page_header.php");
}//if
if($_SESSION['kirjautuminen']){
include ("includes/page_header2.php");
}//if

$conf_maxfilesize = 500000; // kt
$img_max_w = 300; // Kuvan max leveys
$img_max_h = 225; // Kuvan max korkeus

// Tarvittavat funktiot
include("includes/func_gallery.php");

// Tiedostokoko kt tavuiksi
$conf_maxfilesize = $conf_maxfilesize*1024;

if (isset($_POST["submit"])) {
    if($_FILES["kuva"]["name"]){
    
    list($type,$ext,$width,$height) = image_information($_FILES['kuva']['tmp_name']);

    // Tarkastetaan tiedoston koko
    $file_check = TRUE;
    if($_FILES["kuva"]["size"] > $conf_maxfilesize)
    {
        $file_check = FALSE;
        $error = $error."Tiedosto on liian suuri!<br>";
        } //if
    elseif($_FILES["kuva"]["size"] == 0)
    {
        $file_check = FALSE;
        $error = $error."Tiedoston koko on 0!<br>";
    } //elseif
        // Tallennetaan muutettu kuva tiedostoon, tämä kuva esitetään pikkukuvaa painaessa
        $destination_file = '../kortti_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
    } //if

    $tiedosto=$_FILES["kuva"]["name"];

    //Poistetaan ylimääräiset kenoviivat
	$sisalto=stripslashes($sisalto);
	//Estetään HTML-tagien käyttö texareassa
	$sisalto=htmlspecialchars($sisalto);
	//Muutetaan Windows rivinvaihdot HTML-muotoon. Eli missä painaa enter = näkyy tulostuksessa
	$sisalto=str_replace("\n","<br/>",$sisalto);

      $aika = date("H:i:s d.m.Y");
	  $tulos=mysql_query("INSERT INTO kuvat (tiedosto,kuva_nimi,kuvanottajan_nimi,sivu_id) VALUES ('$tiedosto','$_POST[kuva_nimi]','$_POST[kuvanottajan_nimi]','$_POST[sivu_id]');");
  }//if submit
?>
<div class="divSisalto">
<p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja tiedosto</b></p>
<form action="ekortti2.php" method="post" enctype="multipart/form-data">
    <p class="pSisalto">
<br/>
        <table width="705" border="0">
            <tr>
                <td height="22" valign="top"><strong>Valitse sivu</strong>
		<br/>
                <select name='sivu_id'>
                    <option value='4'>E-postikortti</option>
                </select>
                </td>
            </tr>
            <tr>
		<td><strong>Kuvan nimi/otsikko:</strong>
                    N&auml;kyy varsinaisilla sivuilla kuvan yl&auml;puolella.
                    <br/>
                    <input name="kuva_nimi" size="50" maxlength="150" /></td>
            </tr>
            <tr>
                <td><strong>Kuvanottajan nimi:</strong>
                    N&auml;kyy varsinaisilla sivuilla kuvan alapuolella.
                    <br/>
                    <input name="kuvanottajan nimi" size="20" maxlength="50" />
                </td>
            </tr>
            <tr>
		<td><strong> Tiedosto: (kuva) </strong>
                    <br/>Suositeltava kuva koko on 300px leve&auml; ja 225px korkea tai isompi, ohjelma muuttaa automaattisesti isommat kuvat pienemmiksi.
                    <br/>
                    <input type="file" name="kuva" id="file" />
		</td>
            </tr>
            <tr>
                <td>
                    <br/><input type="submit" name="submit" value="L&auml;het&auml;" />
                </td>
            </tr>
        </table>
</p>
</form>

<p class="pSisalto">
    <a href="ekortti.php">E-postikortti hakemistoon</a><br/>
</p>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>