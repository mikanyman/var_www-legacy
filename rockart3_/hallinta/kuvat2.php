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
$tmb_max_w = 170; // Thumb-kuvan max-leveys
$tmb_max_h = 230; // Thumb-kuvan max korkeus
$img_max_w = 470; // Kuvan max leveys
$img_max_h = 530; // Kuvan max korkeus

// Tarvittavat funktiot
include("includes/func_gallery.php");

// Tiedostokoko kt tavuiksi
$conf_maxfilesize = $conf_maxfilesize*1024;

if (isset($_POST["submit"])) {

if($_FILES["pdf"]["name"]){
    if ($_FILES["pdf"]["error"] > 0) {
    echo "Return Code: ".$_FILES["pdf"]["error"]."<br/>";
    }//if
  else {
    echo "<div class='divSisalto'>";
    echo "<p class='pSisalto'>";
    echo "Upload: ".$_FILES["pdf"]["name"]."<br />";
    echo "Type: ".$_FILES["pdf"]["type"]."<br />";
    echo "Size: ".($_FILES["pdf"]["size"] / 1024)." Kb<br/>";
    echo "Temp file: ".$_FILES["pdf"]["tmp_name"]."<br/>";
    echo "</p>";
    if (file_exists("../kuvat_mat/" . $_FILES["pdf"]["name"])) {
      echo "<p class='pSisalto'>";
      echo $_FILES["pdf"]["name"] . " samanniminen tiedosto on jo olemassa.";
      echo "</p>";
      }//if
    else {
      move_uploaded_file($_FILES["pdf"]["tmp_name"],
      "../kuvat_mat/".$_FILES["pdf"]["name"]);
      echo "<p class='pSisalto'>";
      echo "Tallennettu: "."../kuvat_mat/".$_FILES["pdf"]["name"];
      echo "</p>";
      }//else
    }//else
} //if
if($_FILES["kuva"]["name"]){
    list($type,$ext,$width,$height) = image_information($_FILES['kuva']['tmp_name']);
    // Tarkastetaan tiedoston koko
    $file_check = TRUE;
    if($_FILES["kuva"]["size"] > $conf_maxfilesize) {
        $file_check = FALSE;
        $error = $error."Tiedosto on liian suuri!<br>";
        }
    elseif($_FILES["kuva"]["size"] == 0) {
        $file_check = FALSE;
        $error = $error."Tiedoston koko on 0!<br>";
    }
        $destination_file = '../kuvat_thumbs/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$tmb_max_w,$tmb_max_h);
        // Tallennetaan muutettu kuva tiedostoon, tämä kuva esitetään pikkukuvaa painaessa
        $destination_file = '../kuvat_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
}
    $pdf=$_FILES["pdf"]["name"];
    $kuva=$_FILES["kuva"]["name"];

    //Poistetaan ylimääräiset kenoviivat
	$sisalto=stripslashes($sisalto);
	//Estetään HTML-tagien käyttö texareassa
	$sisalto=htmlspecialchars($sisalto);
	//Muutetaan Windows rivinvaihdot HTML-muotoon. Eli missä painaa enter = näkyy tulostuksessa
	$sisalto=str_replace("\n","<br/>",$sisalto);

      $aika = date("H:i:s d.m.Y");
	  $tulos=mysql_query("INSERT INTO kuvat (kuva,kuva_nimi,kuvanottajan_nimi,otsikko,pdf_otsikko,sivu_id,pdf,lisatieto) VALUES ('$kuva','$_POST[kuva_nimi]','$_POST[kuvanottajan_nimi]','$_POST[otsikko]','$_POST[pdf_otsikko]','$_POST[sivu_id]','$pdf','$_POST[lisatieto]');");

  }//if submit
?>
<div class="divSisalto">
<p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja tiedosto</b></p>
<form action="kuvat2.php" method="post" enctype="multipart/form-data">
    <p class="pSisalto">

        <table width="705" border="0">
            <tr><td>
                Valitse joko kuva tai pdf ja anna sille sen mukaiset otsikot ja muut tiedot.<br/>
                Kuva n&auml;kyy vain kuvat sivulla, pdf:t n&auml;kyy Seuran matkakertomukset ja J&auml;senten matkakertomukset sivuilla.
            </td></tr>
            <tr>
                <td height="22" valign="top"><strong>Valitse sivu</strong>
		<br/>
                <select name='sivu_id'>
                    <option value='0'>Valitse sivu!</option>
                    <option value='1'>Kuvat</option>
                    <option value='2'>Seuran matkakertomukset</option>
                    <option value='3'>J&auml;senten matkakertomukset</option>
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
                    <input name="kuvanottajan_nimi" size="20" maxlength="250" />
                </td>
            </tr>
            <tr>
                <td><strong>Lis&auml;tietoa:</strong>
                    N&auml;kyy varsinaisilla sivuilla kuvanottajan alapuolella.
                    <br/>
                    <input name="lisatieto" size="20" maxlength="250" />
                </td>
            </tr>
            <tr>
		<td><strong>Otsikko:</strong>
                    N&auml;kyy varsinaisilla sivuilla pdf linkin yl&auml;puolella.
                    <br/>
                    <input name="otsikko" size="50" maxlength="150" /></td>
            </tr>
            <tr>
                <td><strong>PDF linkkiotsikko:</strong><br/>
                    <input name="pdf_otsikko" size="20" maxlength="50" />
                </td>
            </tr>
            <tr>
		<td><strong> Tiedosto: (jos pdf) </strong>
                    <br/>
                    <input type="file" name="pdf" id="pdf" />
		</td>
            </tr>
            <tr>
		<td><strong> Tiedosto: (jos kuva) </strong>
                    <br/>
                    <input type="file" name="kuva" id="kuva" />
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
    <a href="kuvat.php">Kuvat hakemistoon</a><br/>
</p>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>