<?php
session_start();
if($_SESSION['paakirjautuminen']){
include("includes/session.php");
}//if
if($_SESSION['kirjautuminen']){
include("includes/session2.php");
}//if
include ("includes/db_open.php");

if($_REQUEST["alku"]){
		$alku = $_REQUEST["alku"];
	}else{
		$alku = 0;
	}
		$ups = 10;
		$maara = mysql_result(mysql_query("SELECT COUNT(id) FROM myyntipiste"), 0);

$PHP_SELF=$_SERVER["PHP_SELF"];
$go = $_REQUEST["go"];
$do = $_REQUEST["do"];
$cancel = $_REQUEST["cancel"];

if ($cancel) {
	header("Location: $PHP_SELF");
} //if cancel-loppuu

if ($go) {

	$id=$_REQUEST["id"];
	$otsikko=$_REQUEST["otsikko"];
	$sisalto=$_REQUEST["sisalto"];
	$otsikko_id=$_REQUEST["otsikko_id"];
	$kuva=$_REQUEST["kuva"];
	$pdf=$_REQUEST["pdf"];
	$pdf_otsikko=$_REQUEST["pdf_otsikko"];

	//add alkaa
	if ($do == "add") {

$kuva=$_REQUEST["kuva"];

    $myFile = "../myyntipiste_mat/$kuva";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../myyntipiste_mat/$kuva";
    unlink($myFile);

$conf_maxfilesize = 500000; // kt
$tmb_max_w = 250; // Thumb-kuvan max-leveys
$tmb_max_h = 350; // Thumb-kuvan max korkeus
$img_max_w = 214; // Kuvan max leveys
$img_max_h = 289; // Kuvan max korkeus

// Tarvittavat funktiot
include("includes/func_gallery.php");

// Tiedostokoko kt tavuiksi
$conf_maxfilesize = $conf_maxfilesize*1024;

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
        $destination_file = '../myyntipiste_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
    } //if

    $kuva=$_FILES["kuva"]["name"];

    $updtstmt = "UPDATE myyntipiste SET"
                ." kuva = '".$kuva."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
} //if add loppuu

if ($do == "addp") {

$pdf=$_REQUEST["pdf"];

    $myFile = "../myyntipiste_mat/$pdf";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../myyntipiste_mat/$pdf";
    unlink($myFile);

    if($_FILES["pdf"]["name"]){
    if ($_FILES["pdf"]["error"] > 0) {
    }//if
  else {
    if (file_exists("../myyntipiste_mat/" . $_FILES["pdf"]["name"])) {
      }//if
    else {
      move_uploaded_file($_FILES["pdf"]["tmp_name"],
      "../myyntipiste_mat/".$_FILES["pdf"]["name"]);
      }//else
    }//else
} //if
$pdf=$_FILES["pdf"]["name"];
    $updtstmt = "UPDATE myyntipiste SET"
                ." pdf = '".$pdf."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
}

	//upd alkaa
	if ($do == "upd") {

		$updtstmt = "UPDATE myyntipiste SET"
                ." otsikko = '".$otsikko."',"
		." sisalto = '".$sisalto."',"
		." otsikko_id = '".$otsikko_id."',"
		." kuva = '".$kuva."',"
		." pdf = '".$pdf."',"
                ." pdf_otsikko = '".$pdf_otsikko."'"
		." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
if ($do == "del") {
$pdf=$_REQUEST["pdf"];
if ($pdf !=null){
        $myFile = "../myyntipiste_mat/$pdf";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fclose($fh);
        $myFile = "../myyntipiste_mat/$pdf";
        unlink($myFile);
}
$kuva=$_REQUEST["kuva"];
if ($kuva !=null){
        $myFile = "../myyntipiste_mat/$kuva";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fclose($fh);
        $myFile = "../myyntipiste_mat/$kuva";
        unlink($myFile);
}
    $id=$_REQUEST["id"];
        $delstmt = "DELETE FROM myyntipiste WHERE id = ".$id;
        $result = mysql_query($delstmt);
} //if del loppuu

	header("Location: $PHP_SELF");

} //if go loppuu
?>
<?php
if($_SESSION['paakirjautuminen']){
include ("includes/page_header.php");
}//if
if($_SESSION['kirjautuminen']){
include ("includes/page_header2.php");
}//if

?>

<div class="divSisalto">

<!-- muokkaus osuus alkaa -->
<?php if ($do) {

 	$id=$_GET["id"];
	if ($id) {
		$result = mysql_query("SELECT * FROM myyntipiste WHERE id = $id;");
		$myyntipiste = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") {

        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM myyntipiste WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa kaiken?

	<?php while ($myyntipiste = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='myyntipiste.php' >";
            print "<input type='hidden' name='pdf' value='".$myyntipiste["pdf"]."'>";
            print "<input type='hidden' name='kuva' value='".$myyntipiste["kuva"]."'>";
            print "<input type='hidden' name='id' value='".$id."'>";
            print "<input type='hidden' name='do' value='del'>";
            print "<input class='button' type='submit' name='go' value='Poista'>";
            print "</form>";
	} //while
	} //if
	else { ?>
	<p class="pSisalto">Tiedot poistettu.</p>
	<?php
        }//else
        ?>
        <br/><p class="pSisalto"><a href="myyntipiste.php">Takaisin</a></p>
	<br/><br/>
	
<?php } //if

		else { //MUOKATAAN TAI LISÄTÄÄN

if ($do == "add") {?>
<p class='pSisalto'><b>Vaihda kuva</b>(Aikaisempi kuva poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi kuva korvataan edellisell&auml;)</p>
<?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM myyntipiste WHERE id=$id;");

print "<form method='POST' action='".$PHP_SELF."' enctype='multipart/form-data'>";
print "<input type='hidden' name='id' value='".$id."'>";
print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
		print "<td class='table01_row01'><strong> Tiedosto: (kuva) </strong>";
                    print "<input type='file' name='kuva' id='file' />";
		print "</td>";
            print "</tr>";
print "</table>";
?>
		<?php }

if ($do == "addp") {?>
<p class='pSisalto'><b>Vaihda pdf</b>(Aikaisempi pdf poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi pdf korvataan edellisell&auml;)</p>
    <?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM myyntipiste WHERE id=$id;");

print "<form method='POST' action='".$PHP_SELF."' enctype='multipart/form-data'>";
print "<input type='hidden' name='id' value='".$id."'>";
print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><strong> Tiedosto: (pdf) </strong>";
                    print "<input type='file' name='pdf' id='file' />";
		print "</td>";
            print "</tr>";
print "</table>";
?>
<?php }
if ($do == "upd") { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko:</b> N&auml;kyy varsinaisilla sivuilla isommalla otsikolla<br/>";
                print "<input type='text' name='otsikko' value='".$myyntipiste["otsikko"]."' size='40'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sisalt&ouml;:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.";
                print "<textarea name='sisalto' cols='100' rows='13'>".$myyntipiste["sisalto"]."</textarea></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko id:</b><br/>";
                print "<input type='text' name='otsikko_id' value='".$myyntipiste["otsikko_id"]."' size='5'></td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen kuva:<br/>";
                print ("<img src='../myyntipiste_mat/".($myyntipiste["kuva"])."' alt='kuva' /><br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$myyntipiste["id"]."&do=add'>Vaihda kuva</a>";
                print "</td>";
            print "</tr>";
             print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen pdf:<br/>";
                print ($myyntipiste["pdf"]."<br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$myyntipiste["id"]."&do=addp'>Vaihda pdf</a>";
                print "</td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko:</b>(pdf) N&auml;kyy varsinaisilla sivuilla isommalla otsikolla<br/>";
                print "<input type='text' name='pdf_otsikko' value='".$myyntipiste["pdf_otsikko"]."' size='40'></td>";
            print "</tr>";
        print "</table>";
        }
if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='pdf' value='".$myyntipiste["pdf"]."'>";
        print "<input type='hidden' name='kuva' value='".$myyntipiste["kuva"]."'>";
        print "<input type='hidden' name='yhetystiedot' value='".$myyntipiste."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
        print "<input type='hidden' name='kuva' value='".$myyntipiste["kuva"]."'>";
        print "<input class='button' type='submit' name='go' value='Lis&auml;&auml; tiedot'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
}//if

if ($do == "addp") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='addp'>";
        print "<input type='hidden' name='pdf' value='".$myyntipiste["pdf"]."'>";
        print "<input class='button' type='submit' name='go' value='Lis&auml;&auml; tiedot'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
}//if

print "</form>";
?>
		<br/>
	<?php }?>

	<?php } else {?>
        <p class="pSisalto">
	<a href="myyntipiste2.php">Lis&auml;&auml; uusi sisalto</a><br/>
        <a href="myyntipiste3.php">Lis&auml;&auml; kuva aikaisempaan</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) p&auml;&auml;set poistamaan valitun.<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM myyntipiste ORDER BY otsikko_id LIMIT $alku,$ups;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" cellpadding="4" cellspacing="0" width="90%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left" width="30%"><b>Otsikko</b></td>
                <td class="table01_header" align="center" width="11%">Otsikko ID</</td>
		<td class="table01_header" align="center" width="12%">Poista sivu</td>
		</tr>

	<?php while ($myyntipiste = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$myyntipiste["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		if ($myyntipiste["otsikko"] !=null) {
                print "<td class='table01_row".$rivityyli."' align='left'>".$myyntipiste["otsikko"]."</td>";
                }//if
                elseif ($myyntipiste["kuva"] !=null){
                print "<td class='table01_row".$rivityyli."' align='left'>".$myyntipiste["kuva"]."</td>";
                }//elseif
                else {
                print "<td class='table01_row".$rivityyli."' align='left'>".$myyntipiste["pdf"]."</td>";
                }
                print "<td class='table01_row".$rivityyli."' align='center'>".$myyntipiste["otsikko_id"]."</td>";
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$myyntipiste["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
                print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php }
	else {?>
	<p class="pSisalto3">Ei sivutietoja.</p>
	<?php }?>

        <?php if ($maara >= $ups){


	   if($alku - $ups >= 0){
	   	?>
	   <p class="pSisalto"><a class="aSeuraavat" href="myyntipiste.php?alku=<?php print $alku-$ups;?>"> Edelliset </a></p>
	   &nbsp;
	   <?php
	   }
	   if($alku + $ups < $maara){
	   	?>
	   	<p class="pSisalto"><a class="aSeuraavat" href="myyntipiste.php?alku=<?php print $alku+$ups;?>"> Seuraavat</a></p>   <br/><br/>
	   	<?php }
		}
	?>


<br/><br/>
<?php
}
?>

<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>