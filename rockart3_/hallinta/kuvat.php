<?php
session_start();
include("includes/session.php");
include ("includes/db_open.php");

if($_REQUEST["alku"]){
		$alku = $_REQUEST["alku"];
	}else{
		$alku = 0;
	}
		$ups = 10;
		$maara = mysql_result(mysql_query("SELECT COUNT(sivu_id) FROM kuvat"), 0);

$PHP_SELF=$_SERVER["PHP_SELF"];
$go = $_REQUEST["go"];
$do = $_REQUEST["do"];
$cancel = $_REQUEST["cancel"];

if ($cancel) {
	header("Location: $PHP_SELF");
}

if ($go) {

	$id=$_REQUEST["id"];
        $kuva=$_REQUEST["kuva"];
        $kuva_nimi=$_REQUEST["kuva_nimi"];
        $kuvanottajan_nimi=$_REQUEST["kuvanottajan_nimi"];
	$otsikko=$_REQUEST["otsikko"];
	$pdf_otsikko=$_REQUEST["pdf_otsikko"];
	$sivu_id=$_REQUEST["sivu_id"];
        $pdf=$_REQUEST["pdf"];
        $lisatieto=$_REQUEST["lisatieto"];

	//add alkaa
if ($do == "add") {

$kuva=$_REQUEST["kuva"];

    $myFile = "../kuvat_mat/$kuva";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kuvat_mat/$kuva";
    unlink($myFile);
    //poistetaan myös thumbs kuva
    $myFile2 = "../kuvat_thumbs/$kuva";
    $fh = fopen($myFile2, 'w') or die("can't open file");
    fclose($fh);
    $myFile2 = "../kuvat_thumbs/$kuva";
    unlink($myFile2);

$conf_maxfilesize = 500000; // kt
$tmb_max_w = 170; // Thumb-kuvan max-leveys
$tmb_max_h = 230; // Thumb-kuvan max korkeus
$img_max_w = 470; // Kuvan max leveys
$img_max_h = 530; // Kuvan max korkeus

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
        $destination_file = '../kuvat_thumbs/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$tmb_max_w,$tmb_max_h);
        // Tallennetaan muutettu kuva tiedostoon, tämä kuva esitetään pikkukuvaa painaessa
        $destination_file = '../kuvat_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
    } //if

    $kuva=$_FILES["kuva"]["name"];

    $updtstmt = "UPDATE kuvat SET"
                ." kuva = '".$kuva."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
} //if add loppuu

if ($do == "addp") {

$pdf=$_REQUEST["pdf"];

    $myFile = "../kuvat_mat/$pdf";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kuvat_mat/$pdf";
    unlink($myFile);
    
    if($_FILES["pdf"]["name"]){
    if ($_FILES["pdf"]["error"] > 0) {
    }//if
  else {
    if (file_exists("../kuvat_mat/" . $_FILES["pdf"]["name"])) { 
      }//if
    else {
      move_uploaded_file($_FILES["pdf"]["tmp_name"],
      "../kuvat_mat/".$_FILES["pdf"]["name"]);
      }//else
    }//else
} //if
$pdf=$_FILES["pdf"]["name"];
    $updtstmt = "UPDATE kuvat SET"
                ." pdf = '".$pdf."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
}

	//upd alkaa
	if ($do == "upd") {

		$updtstmt = "UPDATE kuvat SET"
                ." otsikko = '".$otsikko."',"
                ." kuva_nimi='".$kuva_nimi."',"
                ." kuvanottajan_nimi='".$kuvanottajan_nimi."',"
		." lisatieto = '".$lisatieto."',"
		." sivu_id = '".$sivu_id."',"
		." kuva = '".$kuva."',"
		." pdf = '".$pdf."',"
                ." pdf_otsikko = '".$pdf_otsikko."'"
		." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
	if ($do == "del") {

    $kuva=$_REQUEST["kuva"];
if ($kuva !=null){
    $myFile = "../kuvat_mat/$kuva";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kuvat_mat/$kuva";
    unlink($myFile);
    //poistetaan myös thumbs kuva
    $myFile2 = "../kuvat_thumbs/$kuva";
    $fh = fopen($myFile2, 'w') or die("can't open file");
    fclose($fh);
    $myFile2 = "../kuvat_thumbs/$kuva";
    unlink($myFile2);
}
$pdf=$_REQUEST["pdf"];
if ($pdf !=null){
    $myFile = "../kuvat_mat/$pdf";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kuvat_mat/$pdf";
    unlink($myFile);
}
    $id=$_REQUEST["id"];
	$delstmt = "DELETE FROM kuvat WHERE id = ".$id;
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
<?php if ($do) {?>

 	<?php
        $id=$_GET["id"];
	if ($id) {
		$result = mysql_query("SELECT * FROM kuvat WHERE id = $id;");
		$kuvat = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") { //POISTETAAN
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM kuvat WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa kaiken?

	<?php while ($kuvat = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='kuvat.php' >";
            print "<input type='hidden' name='kuva' value='".$kuvat["kuva"]."'>";
            print "<input type='hidden' name='pdf' value='".$kuvat["pdf"]."'>";
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
        <br/><p class="pSisalto"><a href="kuvat.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

	else { //MUOKATAAN TAI LISÄTÄÄN

if ($do == "add") {?>
<p class='pSisalto'><b>Vaihda kuva</b>(Aikaisempi kuva poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi kuva korvataan edellisell&auml;)</p>
<?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM kuvat WHERE id=$id;");

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

	$result = mysql_query("SELECT * FROM kuvat WHERE id=$id;");

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
                print "<td class='table01_row01'><b>Mik&auml; sivu:</b><br/>";
                print " <select name='sivu_id'>";
                    if ($kuvat["sivu_id"] == 1){ print " <option value='1'>Kuvat</option>"; }
                    if ($kuvat["sivu_id"] == 2){ print " <option value='2'>Seuran matkakertomukset</option>"; }
                    if ($kuvat["sivu_id"] == 3){ print " <option value='3'>J&auml;senten matkakertomukset</option>"; }

                    print " <option value='1'>Kuvat</option>";
                    print " <option value='2'>Seuran matkakertomukset</option>";
                    print " <option value='3'>J&auml;senten matkakertomukset</option>";
                print " </select>";
                print "</td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Kuvan nimi/otsikko</b><br/>";
                print "<input type='text' name='kuva_nimi' value='".$kuvat["kuva_nimi"]."' size='40'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Kuvanottajan nimi</b><br/>";
                print "<input type='text' name='kuvanottajan_nimi' value='".$kuvat["kuvanottajan_nimi"]."' size='40'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Lis&auml;tietoa</b><br/>";
                print "<input type='text' name='lisatieto' value='".$kuvat["lisatieto"]."' size='40'></td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen kuva:<br/>";
                print ("<img src='../kuvat_thumbs/".($kuvat["kuva"])."' alt='kuva' /><br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$kuvat["id"]."&do=add'>Vaihda kuva</a>";
                print "</td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko:</b> N&auml;kyy varsinaisilla sivuilla pdf linkin yl&auml;puolella.<br/>";
                print "<input type='text' name='otsikko' value='".$kuvat["otsikko"]."' size='50'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Pdf linkkiotsikko:</b><br/>";
                print "<input type='text' name='pdf_otsikko' value='".$kuvat["pdf_otsikko"]."' size='40'></td>";
            print "</tr>";
             print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen pdf:<br/>";
                print ($kuvat["pdf"]."<br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$kuvat["id"]."&do=addp'>Vaihda pdf</a>";
                print "</td>";
            print "</tr>";
        print "</table>";
} //if
if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='kuva' value='".$kuvat["kuva"]."'>";
        print "<input type='hidden' name='pdf' value='".$kuvat["pdf"]."'>";
        print "<input type='hidden' name='yhetystiedot' value='".$kuvat."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
        print "<input type='hidden' name='kuva' value='".$kuvat["kuva"]."'>";
        print "<input class='button' type='submit' name='go' value='Lis&auml;&auml; tiedot'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
}//if

if ($do == "addp") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='addp'>";
        print "<input type='hidden' name='pdf' value='".$kuvat["pdf"]."'>";
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
	<a href="kuvat2.php">Lis&auml;&auml; uusi</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) p&auml;&auml;set poistamaan valitun.<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM kuvat WHERE sivu_id=1 OR sivu_id=2 OR sivu_id=3 ORDER BY sivu_id,id LIMIT $alku,$ups;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="98%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left" width="25%"><b>Otsikko</b></td>
                <td class="table01_header" align="left" width="35%">Sivulla</td>
		<td class="table01_header" align="center" width="16%">Poista sivu</td>
		</tr>

	<?php while ($kuvat = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$kuvat["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		if ($kuvat["otsikko"] !=null) {
                print "<td class='table01_row".$rivityyli."' align='left'>".$kuvat["otsikko"]."</td>";
                }
                if ($kuvat["kuva_nimi"] !=null) {
                print "<td class='table01_row".$rivityyli."' align='left'>".$kuvat["kuva_nimi"]."</td>";
                }
                if ($kuvat["sivu_id"] == 1){ print "<td class='table01_row".$rivityyli."' align='left'>Kuvat</td>"; }
                if ($kuvat["sivu_id"] == 2){ print "<td class='table01_row".$rivityyli."' align='left'>Seuran matkakertomukset</td>"; }
                if ($kuvat["sivu_id"] == 3){ print "<td class='table01_row".$rivityyli."' align='left'>J&auml;senten matkakertomukset</td>"; }
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$kuvat["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
                print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php }
	else {?>
	<p class="pSisalto">Ei sivutietoja.</p>
	<?php }?>
        <?php if ($maara >= $ups){


	   if($alku - $ups >= 0){
	   	?><br/>
	   <span class="pSisalto"><a class="aSeuraavat" href="kuvat.php?alku=<?php print $alku-$ups;?>"> Edelliset </a></span>
	   &nbsp;
	   <?php
	   }
	   if($alku + $ups < $maara){
	   	?>
	   <span class="pSisalto"><a class="aSeuraavat" href="kuvat.php?alku=<?php print $alku+$ups;?>"> Seuraavat</a></span>
	   	<?php }
		}
	?>

<?php
} //else
?>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>