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

if (isset($_POST["submit"])) {

    if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }//if
  else
    {
    echo "<div class='divSisalto'>";
    echo "<p class='pSisalto'>";
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    echo "</p>";
    if (file_exists("../english/commons_mat/" . $_FILES["file"]["name"]))
      {
      echo "<p class='pSisalto'>";
      echo $_FILES["file"]["name"] . " samanniminen tiedosto on jo olemassa. ";
      echo "</p>";
      }//if
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../english/commons_mat/" . $_FILES["file"]["name"]);
      echo "<p class='pSisalto'>";
      echo "Tallennettu: " . "../english/commons_mat/" . $_FILES["file"]["name"];
      echo "</p>";
      }//else
    }//else

    $tiedosto=$_FILES["file"]["name"];

    //Poistetaan ylimääräiset kenoviivat
	$content=stripslashes($content);
	//Estetään HTML-tagien käyttö texareassa
	$content=htmlspecialchars($content);
	//Muutetaan Windows rivinvaihdot HTML-muotoon. Eli missä painaa enter = näkyy tulostuksessa
	$content=str_replace("\n","<br/>",$content);

      $aika = date("H:i:s d.m.Y");
	  $tulos=mysql_query("INSERT INTO commons (header,content,pdf,pdf_header,page_id) VALUES ('$_POST[header]','$_POST[content]','$tiedosto','$_POST[pdf_header]','$_POST[page_id]');");

  }//if
?>
<div class="divSisalto">
<p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja sis&auml;lt&ouml;</b></p>
<form action="commons2.php" method="post" enctype="multipart/form-data">
    <p class="pSisalto">

        <table width="705" border="0">
                                    <tr>
					    <td><strong>Otsikko:</strong>
                                                N&auml;kyy varsinaisilla sivuilla isommalla otsikolla
					    <br/>
				        <input name="header" size="50" maxlength="150" /></td>
				    </tr>

					<tr>
					    <td height="22" valign="top"><strong>Sis&auml;lt&ouml;:</strong>
                                            <br/>
                                           Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti.
                                           Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                                           Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                                           Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.
                                           <br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.

					    <textarea name="content" cols="88" rows="20"></textarea></td>
					</tr>
					 <tr>
					    <td><strong>PDF Otsikko:</strong><br/>

                                            <input name="pdf_header" size="20" maxlength="50" />
                                            </td>
				    </tr>
                                    <tr>
					    <td><strong> Tiedosto: </strong>
					    <br/>
                                                <input type="file" name="file" id="file" />
					    </td>
					</tr>

					<tr>
					    <td height="22" valign="top"><strong>Valitse sivu</strong>
					    <br/>
                                                <select name='page_id'>
                                                    <option value='0'>Valitse sivu!</option>
                                                    <option value='1'>Frontpage</option>
                                                    <option value='2'>Seura/S&auml;&auml;nn&ouml;t</option>
                                                    <option value='3'>Ajankohtaista</option>
                                                    <option value='4'>Tutkimus/Tutkimusraportit</option>
                                                    <option value='5'>Seminaariluennot</option>
                                                    <option value='6'>Yhteystiedot</option>
                                                </select>
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
    <a href="commons.php">Yleiset hakemistoon</a><br/>
</p>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>