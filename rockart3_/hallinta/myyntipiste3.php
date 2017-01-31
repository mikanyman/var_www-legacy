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
$img_max_w = 214; // Kuvan max leveys
$img_max_h = 289; // Kuvan max korkeus

// Tarvittavat funktiot
include("includes/func_gallery.php");

// Tiedostokoko kt tavuiksi
$conf_maxfilesize = $conf_maxfilesize*1024;

if (isset($_POST["submit"])) {

    if ($_FILES["pdf"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["pdf"]["error"] . "<br />";
    }//if
    else
    {
    echo "<div class='divSisalto'>";
    echo "<p class='pSisalto'>";
    echo "Upload: " . $_FILES["pdf"]["name"] . "<br />";
    echo "Type: " . $_FILES["pdf"]["type"] . "<br />";
    echo "Size: " . ($_FILES["pdf"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["pdf"]["tmp_name"] . "<br />";
    echo "</p>";
    if (file_exists("../myyntipiste_mat/" . $_FILES["pdf"]["name"]))
      {
      echo "<p class='pSisalto'>";
      echo $_FILES["pdf"]["name"] . " samanniminen tiedosto on jo olemassa. ";
      echo "</p>";
      }//if
    else
      {
      move_uploaded_file($_FILES["pdf"]["tmp_name"],
      "../myyntipiste_mat/" . $_FILES["pdf"]["name"]);
      echo "<p class='pSisalto'>";
      echo "Tallennettu: " . "../myyntipiste_mat/" . $_FILES["pdf"]["name"];
      echo "</p>";
      }//else
    }//else

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
        $destination_file = '../myyntipiste_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);

    $pdf=$_FILES["pdf"]["name"];
    $kuva=$_FILES["kuva"]["name"];

$aika = date("H:i:s d.m.Y");
$tulos=mysql_query("INSERT INTO myyntipiste (otsikko_id,kuva,pdf,pdf_otsikko) VALUES ('$_POST[otsikko_id]','$kuva','$pdf','$_POST[pdf_otsikko]');");

  }//if submit
?>
<div class="divSisalto">
<p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja sis&auml;lt&ouml;</b></p>
<form action="myyntipiste3.php" method="post" enctype="multipart/form-data">
    <p class="pSisalto">

        <table width="705" border="0">
                                      <tr>
					    <td height="22" valign="top"><strong>Otsikko id:</strong>
                                            <br/>
                                            Anna otsikko id mink&auml; alle haluat uuden kuvan/pdf:n.
                                            <br/>
                                            T&auml;ss&auml; listattuna mit&auml; jo on, ja mit&auml; sen otsikko id:n takana on.
                                        <br/><br/><?php
$sql_lause = "SELECT * FROM myyntipiste ORDER BY otsikko_id,id";
    if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
        $kysely = mysql_query($sql_lause);
            while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                if ($tulosjoukko["otsikko"] !=null) {
                print (($tulosjoukko["otsikko"])." | otsikko id <b>".$tulosjoukko["otsikko_id"]."</b><br/>");
                }//lopettaa if
} //lopettaa while
        }//if ?><br/>
                                        <input name="otsikko_id" size="5" />

                                           </td>
					</tr>
                                        <tr>
					    <td><strong> Kuva tiedosto: </strong>
					    <br/>
                                            Tuetut kuva muodot on: png, gif ja jpg<br/><br/>
                                                <input type="file" name="kuva" id="kuva" />
					    </td>
					</tr>
                                    <tr>
					    <td><strong> PDF Tiedosto: </strong>
					    <br/>
                                                <input type="file" name="pdf" id="pdf" />
                                                <br/>
                                                <strong> PDF otsikko: </strong><br/>
                                        <input name="pdf_otsikko" size="50" maxlength="150" />
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
    <a href="myyntipiste.php">Myyntipiste hakemistoon</a><br/>
</p>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>