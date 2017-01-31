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
	$otsikko=$_REQUEST["otsikko"];
	$sisalto=$_REQUEST["sisalto"];
	$luettelo=$_REQUEST["luettelo"];
	$kuva=$_REQUEST["kuva"];

if ($do == "add") {

$kuva=$_REQUEST["kuva"];

    $myFile = "../julkaisut_mat/$kuva";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../julkaisut_mat/$kuva";
    unlink($myFile);

$conf_maxfilesize = 500000; // kt
$tmb_max_w = 250; // Thumb-kuvan max-leveys
$tmb_max_h = 350; // Thumb-kuvan max korkeus
$img_max_w = 215; // Kuvan max leveys
$img_max_h = 304; // Kuvan max korkeus

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
        $destination_file = '../julkaisut_mat/'.$_FILES["kuva"]["name"];
        create_resized_image($_FILES['kuva']['tmp_name'],$destination_file,$img_max_w,$img_max_h);
    } //if

    $kuva=$_FILES["kuva"]["name"];

    $updtstmt = "UPDATE julkaisut SET"
                ." kuva = '".$kuva."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
} //if add loppuu

	//upd alkaa
	if ($do == "upd") {

		$updtstmt = "UPDATE julkaisut SET"
                                ." otsikko = '".$otsikko."',"
				." sisalto = '".$sisalto."',"
				." luettelo = '".$luettelo."',"
				." kuva = '".$kuva."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
if ($do == "del") {
    $kuva=$_REQUEST["kuva"];
if ($kuva !=null){
    $myFile = "../julkaisut_mat/$kuva";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../julkaisut_mat/$kuva";
    unlink($myFile);
}
    $id=$_REQUEST["id"];

	$delstmt = "DELETE FROM julkaisut WHERE id = ".$id;
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
		$result = mysql_query("SELECT * FROM julkaisut WHERE id = $id;");
		$julkaisut = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") {

        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM julkaisut WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa kaiken?

	<?php while ($julkaisut = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='julkaisut.php' >";
            print "<input type='hidden' name='kuva' value='".$julkaisut["kuva"]."'>";
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
        <br/><p class="pSisalto"><a href="julkaisut.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

if ($do == "add") { ?>
        
<p class='pSisalto'><b>Vaihda kuva</b>(Aikaisempi kuva poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi kuva korvataan edellisell&auml;)</p>
<?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM julkaisut WHERE id=$id;");

print "<form method='POST' action='".$PHP_SELF."' enctype='multipart/form-data'>";
print "<input type='hidden' name='id' value='".$id."'>";
print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
		print "<td class='table01_row01'><strong> Tiedosto: (kuva) </strong>";
                    print "<input type='file' name='kuva' id='file' />";
		print "</td>";
            print "</tr>";
print "</table>";

} //if add

if ($do == "upd") { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko:</b> N&auml;kyy varsinaisilla sivuilla isommalla otsikolla<br/>";
                print "<input type='text' name='otsikko' value='".$julkaisut["otsikko"]."' size='40'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sisalt&ouml;:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.";
                print "<textarea name='sisalto' cols='100' rows='13'>".$julkaisut["sisalto"]."</textarea></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sis&auml;llysluettelo:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<textarea name='luettelo' cols='100' rows='13'>".$julkaisut["luettelo"]."</textarea></td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen kuva:<br/>";
                print ("<img src='../julkaisut_mat/".($julkaisut["kuva"])."' alt='kuva' /><br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$julkaisut["id"]."&do=add'>Vaihda kuva</a>";
                print "</td>";
            print "</tr>";
        print "</table>";
} //if

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='kuva' value='".$julkaisut["kuva"]."'>";
        print "<input type='hidden' name='yhetystiedot' value='".$julkaisut."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
        print "<input type='hidden' name='kuva' value='".$julkaisut["kuva"]."'>";
        print "<input class='button' type='submit' name='go' value='Lis&auml;&auml; tiedot'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
}//if

print "</form>";
?>
		<br/>

	<?php } else {?>
        <p class="pSisalto">
	<a href="julkaisut2.php">Lis&auml;&auml; uusi sisalto</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) p&auml;&auml;set poistamaan valitun.<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM julkaisut ORDER BY kuva;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="90%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left" width="30%"><b>Otsikko</b></td>
		<td class="table01_header" align="center" width="16%">Poista sivu</td>
		</tr>

	<?php while ($julkaisut = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$julkaisut["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$julkaisut["otsikko"]."</td>";
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$julkaisut["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
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