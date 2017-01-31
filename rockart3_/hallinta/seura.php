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
	$vuosi=$_REQUEST["vuosi"];

	//add alkaa
        if ($do == "add") {
                $insstmt = "INSERT INTO toimintakertomukset (otsikko,sisalto,vuosi)"
                                   ."VALUES"." ('".$otsikko."', '".$sisalto."', '".$vuosi."')";

                $result = mysql_query($insstmt);

} //if add loppuu

	//upd alkaa
	if ($do == "upd") {
		$updtstmt = "UPDATE toimintakertomukset SET"
                                ." otsikko = '".$otsikko."',"
				." sisalto = '".$sisalto."',"
				." vuosi = '".$vuosi."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
	if ($do == "del") {
		$id=$_GET["id"];
		$delstmt = "DELETE FROM toimintakertomukset WHERE id = ".$id;

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
		$result = mysql_query("SELECT * FROM toimintakertomukset WHERE id = $id;");
		$toimintakertomukset = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") { //POISTETAAN

        $id=$_GET["id"];
		$delstmt = "DELETE FROM toimintakertomukset WHERE id = ".$id;
		$result = mysql_query($delstmt);
	?>
	<p class="pSisalto3">
        <?php
            print "Poistettu";
	?>
        <br/><a href="seura.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

		else { //MUOKATAAN TAI LISÄTÄÄN

		if ($do == "add") {?>
                <p class="pSisalto"><b>Lis&auml;&auml; uusi otsikko ja sis&auml;lt&ouml;</b></p>
		<?php } else { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>
		<?php }?>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Otsikko:</b> N&auml;kyy varsinaisilla sivuilla isommalla otsikolla<br/>";
                print "<input type='text' name='otsikko' value='".$toimintakertomukset["otsikko"]."' size='50'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sisalt&ouml;:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.";
                print "<textarea name='sisalto' cols='100' rows='13'>".$toimintakertomukset["sisalto"]."</textarea></td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Vuosi:</b> Annetaan muodossa xxxx<br/>";
                print "<input type='text' name='vuosi' value='".$toimintakertomukset["vuosi"]."' size='3'></td>";
            print "</tr>";
        print "</table>";

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='yhetystiedot' value='".$toimintakertomukset."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
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
	<a href="seura.php?do=add">Lis&auml;&auml; uusi sisalto</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) <b>et p&auml;&auml;se en&auml;&auml; perumaan</b> poistoa!<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM toimintakertomukset ORDER BY vuosi DESC;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="70%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left"><b>Otsikko</b></td>
		<td class="table01_header" align="center" width="16%">Poista sivu</td>
		</tr>

	<?php while ($toimintakertomukset = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$toimintakertomukset["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$toimintakertomukset["otsikko"]."</td>";
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$toimintakertomukset["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
                print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php }
	else {?>
	<p>Ei sivutietoja.</p>
	<?php }?>
<br/><br/>
<?php
}
?>

<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>