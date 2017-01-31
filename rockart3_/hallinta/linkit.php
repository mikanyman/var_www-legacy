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
	$linkkiotsikko=$_REQUEST["linkkiotsikko"];
	$linkki=$_REQUEST["linkki"];
	$otsikko_id=$_REQUEST["otsikko_id"];

	//add alkaa
        if ($do == "add") {
                $insstmt = "INSERT INTO linkit (linkkiotsikko,linkki,otsikko_id)"
                                   ."VALUES"." ('".$linkkiotsikko."', '".$linkki."', '".$otsikko_id."')";

                $result = mysql_query($insstmt);

} //if add loppuu

	//upd alkaa
	if ($do == "upd") {
		$updtstmt = "UPDATE linkit SET"
                                ." linkkiotsikko = '".$linkkiotsikko."',"
				." linkki = '".$linkki."',"
				." otsikko_id = '".$otsikko_id."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
	if ($do == "del") {
		$id=$_REQUEST["id"];
		$delstmt = "DELETE FROM linkit WHERE id = ".$id;

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
		$result = mysql_query("SELECT * FROM linkit WHERE id = $id;");
		$linkit = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") { //POISTETAAN
$id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM linkit WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa linkki osoitteen <?php print $linkit[linkkiotsikko];?>?

	<?php while ($linkit = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='linkit.php' >";
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
        <br/><p class="pSisalto"><a href="linkit.php">Takaisin</a></p>
	<br/><br/>
<?php } //if del

		else { //MUOKATAAN TAI LISÄTÄÄN

		if ($do == "add") {?>
                <p class="pSisalto"><b>Lis&auml;&auml; uusi linkkiotsikko ja sis&auml;lt&ouml;</b></p>
		<?php } else { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>
		<?php }?>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Linkkiotsikko:</b> N&auml;kyy varsinaisilla sivuilla lihavoituna otsikkona.<br/>";
                print "<input type='text' name='linkkiotsikko' value='".$linkit["linkkiotsikko"]."' size='90'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Linkki:</b> Annetaan muodossa http://www.linkkiosoite.fi<br/>";
                print "<input type='text' name='linkki' value='".$linkit["linkki"]."' size='50'></td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Mink&auml; otsikon alle tulostetaan:</b><br/>";
                print " <select name='otsikko_id'>";
                    if ($linkit["otsikko_id"] == 1){ print " <option value='1'>Viranomaistahot</option>"; }
                    if ($linkit["otsikko_id"] == 2){ print " <option value='2'>Verkkojulkaisut</option>"; }
                    if ($linkit["otsikko_id"] == 3){ print " <option value='3'>Yksityisi&auml; www-sivuja</option>"; }
                    if ($linkit["otsikko_id"] == 4){ print " <option value='4'>Eri maiden muinaistaidetta</option>"; }

                    print " <option value='1'>Viranomaistahot</option>";
                    print " <option value='2'>Verkkojulkaisut</option>";
                    print " <option value='3'>Yksityisi&auml; www-sivuja</option>";
                    print " <option value='4'>Eri maiden muinaistaidetta</option>";
                print " </select>";
            print "</tr>";
        print "</table>";

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='yhetystiedot' value='".$linkit."'>";
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
	<a href="linkit.php?do=add">Lis&auml;&auml; uusi linkki</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan linkki&auml; ja linkkiotsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) <b>et p&auml;&auml;se en&auml;&auml; perumaan</b> poistoa!<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM linkit ORDER BY otsikko_id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="98%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left"><b>Linkkiotsikko</b></td>
                <td class="table01_header" align="left">Tulostusalue</td>
		<td class="table01_header" align="center" width="16%">Poista sivu</td>
		</tr>

	<?php while ($linkit = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$linkit["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$linkit["linkkiotsikko"]."</td>";
                    if ($linkit["otsikko_id"] == 1){ print "<td class='table01_row".$rivityyli."' align='left'>Viranomaistahot</td>"; }
                    if ($linkit["otsikko_id"] == 2){ print "<td class='table01_row".$rivityyli."' align='left'>Verkkojulkaisut</td>"; }
                    if ($linkit["otsikko_id"] == 3){ print "<td class='table01_row".$rivityyli."' align='left'>Yksityisi&auml; www-sivuja</td>"; }
                    if ($linkit["otsikko_id"] == 4){ print "<td class='table01_row".$rivityyli."' align='left'>Eri maiden muinaistaidetta</td>"; }
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$linkit["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
                print "</tr>";

		if ($rivityyli == "01") {$rivityyli = "02";} else {$rivityyli = "01";}?>

	<?php }?>
	</table>

	<?php }
	else {?>
	<p class="pSisalto3">Ei sivutietoja.</p>
	<?php }?>
<br/><br/>
<?php
}
?>

<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>