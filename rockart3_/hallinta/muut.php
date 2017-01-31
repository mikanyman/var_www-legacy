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
	$pdf_otsikko=$_REQUEST["pdf_otsikko"];
	$sivu_id=$_REQUEST["sivu_id"];
	$pdf=$_REQUEST["pdf"];

	//upd alkaa
	if ($do == "upd") {

		$updtstmt = "UPDATE yleiset SET"
                ." otsikko = '".$otsikko."',"
				." sisalto = '".$sisalto."',"
				." pdf_otsikko = '".$pdf_otsikko."',"
				." sivu_id = '7',"
				." pdf = '".$pdf."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

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
		$result = mysql_query("SELECT * FROM yleiset WHERE id = $id;");
		$yleiset = mysql_fetch_array($result);

	} //if
	?>

<?php 

if ($do == "upd") { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr><td>";
                print "<b>".$yleiset["otsikko"]." alku teksti</b>";
            print "</td></tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sisalt&ouml;:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.";
                print "<textarea name='sisalto' cols='100' rows='13'>".$yleiset["sisalto"]."</textarea></td>";
            print "</tr>";
        print "</table>";
}

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='otsikko' value='".$yleiset["otsikko"]."'>";
        print "<input type='hidden' name='sivu_id' value='".$yleiset["sivu_id"]."'>";
        print "<input type='hidden' name='yhetystiedot' value='".$yleiset."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

print "</form>";
?>
		<br/>
                
	<?php } else {?>
    <p class="pSisalto">
	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml;<br/><br/>
    </p>
	<?php
	$result = mysql_query("SELECT * FROM yleiset WHERE sivu_id =7 ORDER BY sivu_id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="60%">

		<tr>
		<td class="table01_otsikko" align="center">&nbsp;</td>
		<td class="table01_otsikko" align="center">Muokkaa</td>
		<td class="table01_otsikko" align="left" width="45%"><b>Otsikko</b></td>
		</tr>

	<?php while ($yleiset = mysql_fetch_array($result)) {

            print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$yleiset["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$yleiset["otsikko"]."</td>";
            print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php } //if
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