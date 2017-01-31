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
$tmb_max_w = 250; // Thumb-kuvan max-leveys
$tmb_max_h = 350; // Thumb-kuvan max korkeus
$img_max_w = 215; // Kuvan max leveys
$img_max_h = 304; // Kuvan max korkeus

// Tarvittavat funktiot
include("includes/func_gallery.php");

// Tiedostokoko kt tavuiksi
$conf_maxfilesize = $conf_maxfilesize*1024;

if (isset($_POST["submit"])) {
    
    list($type,$ext,$width,$height) = image_information($_FILES['kuva']['tmp_name']);

    // Tarkastetaan tiedoston koko
    $file_check = TRUE;
    if($_FILES["kuva"]["size"] > $conf_maxfilesize)
    {
        $file_check = FALSE;
        $error = $error."Tiedosto on liian suuri!<br>";
        }
    elseif($_FILES["kuva"]["size"] == 0)
    {
        $file_check = FALSE;
        $error = $error."Tiedoston koko on 0!<br>";
    }
        // Tallennetaan muutettu kuva tiedostoon, tämä kuva esitetään pikkukuvaa painaessa
        $destination_file = '../julkaisut_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);

    $kuva=$_FILES["kuva"]["name"];

$aika = date("H:i:s d.m.Y");
$tulos=mysql_query("INSERT INTO julkaisut (otsikko,sisalto,luettelo,kuva) VALUES ('$_POST[otsikko]','$_POST[sisalto]','$_POST[luettelo]','$kuva');");

  }//if submit
?>
<div class="divSisalto">
<p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja sis&auml;lt&ouml;</b></p>
<form action="julkaisut2.php" method="post" enctype="multipart/form-data">
    <p class="pSisalto">

        <table width="705" border="0">
                                    <tr>
					    <td><strong>Otsikko:</strong>
                                                N&auml;kyy varsinaisilla sivuilla isommalla otsikolla
					    <br/>
				        <input name="otsikko" size="50" maxlength="150" /></td>
				    </tr>

					<tr>
					    <td height="22" valign="top"><strong>Sis&auml;lt&ouml;:</strong>
                                            <br/>
                                           Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti.
                                           Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                                           Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                                           Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.
                                           <br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.

					    <textarea name="sisalto" cols="88" rows="20"></textarea></td>
					</tr>
                                        <tr>
					    <td height="22" valign="top"><strong>Sis&auml;llysluettelo:</strong>
                                            <br/>
                                           Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti.
                                           Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                                           Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                                           Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.
                                           <br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.

					    <textarea name="luettelo" cols="88" rows="20"></textarea></td>
					</tr>
                                        <tr>
					    <td><strong> Kuva tiedosto: </strong>
					    <br/>
                                            Tuetut kuva muodot on: png, gif ja jpg<br/><br/>
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
    <a href="julkaisut.php">Julkaisut hakemistoon</a><br/>
</p>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>