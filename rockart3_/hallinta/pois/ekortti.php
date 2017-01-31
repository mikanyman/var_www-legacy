<?php
session_start();
if($_SESSION['paakirjautuminen']){
include("includes/session.php");
}//if
if($_SESSION['kirjautuminen']){
include("includes/session2.php");
}//if
include ("includes/db_open.php");
$PHP_SELF=$_SERVER["PHP_SELF"];
$go = $_REQUEST["go"];
$do = $_REQUEST["do"];
$cancel = $_REQUEST["cancel"];

if ($cancel) {
	header("Location: $PHP_SELF");
} //if cancel-loppuu

if ($go) {

	$id=$_REQUEST["id"];
        $tiedosto=$_REQUEST["tiedosto"];
        $kuva_nimi=$_REQUEST["kuva_nimi"];
        $kuvanottajan_nimi=$_REQUEST["kuvanottajan_nimi"];
	$sivu_id=$_REQUEST["sivu_id"];

	//add alkaa
if ($do == "add") {

$tiedosto=$_REQUEST["tiedosto"];
if ($tiedosto !=null){
    $myFile = "../kortti_mat/$tiedosto";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kortti_mat/$tiedosto";
    unlink($myFile);
}

$conf_maxfilesize = 500000; // kt
$img_max_w = 300; // Kuvan max leveys
$img_max_h = 225; // Kuvan max korkeus

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
        $destination_file = '../kortti_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
    } //if

    $tiedosto=$_FILES["kuva"]["name"];

    $updtstmt = "UPDATE kuvat SET"
                                ." tiedosto = '".$tiedosto."'"
				." WHERE id = ".$id;

    $result = mysql_query($updtstmt);

} //if add loppuu

//upd alkaa
if ($do == "upd") {
    $updtstmt = "UPDATE kuvat SET"
                                ." kuva_nimi = '".$kuva_nimi."',"
                                ." kuvanottajan_nimi = '".$kuvanottajan_nimi."',"
				." sivu_id = '".$sivu_id."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);
} //if upd loppuu

//del alkaa
if ($do == "del") {
    $tiedosto=$_REQUEST["tiedosto"];
if ($tiedosto !=null){
    $myFile = "../kortti_mat/$tiedosto";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../kortti_mat/$tiedosto";
    unlink($myFile);
}
    $id=$_REQUEST["id"];

    $delstmt = "DELETE FROM kuvat WHERE id = ".$id;
    $result = mysql_query($delstmt);
} //if del loppuu

	//header("Location: $PHP_SELF");

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
		$result = mysql_query("SELECT * FROM kuvat WHERE id = $id;");
		$kuvat = mysql_fetch_array($result);

	} //if

if ($do == "del") { //POISTETAAN ?>

	<?php

        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM kuvat WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa kaiken?

	<?php while ($kuvat = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='ekortti.php' >";
            print "<input type='hidden' name='tiedosto' value='".$kuvat["tiedosto"]."'>";
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
        <br/><p class="pSisalto"><a href="ekortti.php">Takaisin</a></p>
	<br/><br/>
<?php } //if


		else { //MUOKATAAN TAI LISÄTÄÄN

		if ($do == "add") {?>
        <p class="pSisalto"><b>Vaihda kuva</b>(Aikaisempi kuva poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi kuva korvataan edellisell&auml;)</p><?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM kuvat WHERE id=$id;");

print "<form method='POST' action='".$PHP_SELF."' enctype='multipart/form-data'>";
print "<input type='hidden' name='id' value='".$id."'>";
print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
		print "<td class='table01_row01'><strong> Tiedosto: (kuva) </strong>";
                    print "<br/>Suositeltava kuva koko on 300px leve&auml; ja 225px korkea tai isompi, ohjelma muuttaa automaattisesti isommat kuvat pienemmiksi.";
                    print "<br/>";
                    print "<input type='file' name='kuva' id='file' />";
		print "</td>";
            print "</tr>";
print "</table>";
?>
		<?php } else { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>


<?php
print "<form method='POST' action='".$PHP_SELF."'>";
print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Mik&auml; sivu:</b><br/>";
                print " <select name='sivu_id'>";
                    print " <option value='4'>E-postikortti</option>";
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
                print "<td>";
                print "T&auml;m&auml;n hetkinen kuva:<br/>";
                print ("<img src='../kortti_mat/".($kuvat["tiedosto"])."' alt='pkortti' /><br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$kuvat["id"]."&do=add'>Vaihda kuva</a>";
                print "</td>";
            print "</tr>";
        print "</table>";
} //else
if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='yhetystiedot' value='".$kuvat."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
        print "<br/><p class='pSisalto'><a href='ekortti.php'>Takaisin</a></p>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
        print "<input type='hidden' name='tiedosto' value='".$kuvat["tiedosto"]."'>";
        print "<input class='button' type='submit' name='go' value='Lis&auml;&auml;'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
        print "<br/><p class='pSisalto'><a href='ekortti.php'>Takaisin</a></p>";
    print"</p>";
}//if

print "</form>";
?>
		<br/>
	<?php }?>

	<?php } else {?>
        <p class="pSisalto">
	<a href="ekortti2.php">Lis&auml;&auml; uusi</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) p&auml;&auml;set poistamaan valitun.<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM kuvat WHERE sivu_id=4 ORDER BY sivu_id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="80%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left"><b>Otsikko</b></td>
		<td class="table01_header" align="center">Poista sivu</td>
		</tr>

	<?php while ($kuvat = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$kuvat["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
                print "<td class='table01_row".$rivityyli."' align='left'>".$kuvat["kuva_nimi"]."</td>";
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$kuvat["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
		print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php }
	else {?>
	<p class="pSisalto">Ei sivutietoja.</p>
	<?php }?>
<br/><br/>
<?php
}
?>

<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>