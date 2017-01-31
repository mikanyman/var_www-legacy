<?php
session_start();
include("includes/session.php");
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
	$kayttajanimi=$_REQUEST["kayttajanimi"];
	$salasana=$_REQUEST["salasana"];

	//add alkaa
        if ($do == "add") {
                $insstmt = "INSERT INTO kayttaja (kayttajanimi,salasana)"
                                   ."VALUES"." ('".$kayttajanimi."', '".$salasana."')";

                $result = mysql_query($insstmt);

} //if add loppuu

	//upd alkaa
	if ($do == "upd") {
		$updtstmt = "UPDATE kayttaja SET"
                ." kayttajanimi = '".$kayttajanimi."',"
				." salasana = '".$salasana."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
	if ($do == "del") {
		$id=$_GET["id"];
		$delstmt = "DELETE FROM kayttaja WHERE id = ".$id;

		$result = mysql_query($delstmt);
} //if del loppuu

	header("Location: $PHP_SELF");

} //if go loppuu

?>

<?php
include ("includes/page_header.php");
?>

<div class="divSisalto">

<!-- muokkaus osuus alkaa -->
<?php if ($do) {

 	$id=$_GET["id"];
	if ($id) {
		$result = mysql_query("SELECT * FROM kayttaja WHERE id = $id;");
		$kayttaja = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") { //POISTETAAN

        $id=$_GET["id"];
		$delstmt = "DELETE FROM kayttaja WHERE id = ".$id;
		$result = mysql_query($delstmt);
	?>
	<p class="pSisalto3">
        <?php
            print "Poistettu!";
	?>
        <br/><a href="kayttajat.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

		else { //MUOKATAAN TAI LISÄTÄÄN

		if ($do == "add") {?>
                <p class="pSisalto"><b>Lis&auml;&auml; uusi k&auml;ytt&auml;j&auml;nimi ja salasana</b></p>
		<?php } else { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>
		<?php }?>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>K&auml;ytt&auml;j&auml;nimi:</b><br/>";
                print "<input type='text' name='kayttajanimi' value='".$kayttaja["kayttajanimi"]."' size='20'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Salasana:</b><br/>";
                print "<input type='password' name='salasana' value='".$kayttaja["salasana"]."' size='20'></td>";
            print "</tr>";
        print "</table>";

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='yhetystiedot' value='".$kayttaja."'>";
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
	<a href="kayttajat.php?do=add">Lis&auml;&auml; uusi k&auml;ytt&auml;j&auml; salasana</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan salasanoja ja k&auml;ytt&auml;j&auml;nimi&auml;<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) <b>et p&auml;&auml;se en&auml;&auml; perumaan</b> poistoa!<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM kayttaja ORDER BY id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="70%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left"><b>K&auml;ytt&auml;j&auml;nimi</b></td>
		<td class="table01_header" align="center" width="16%">Poista k&auml;ytt&auml;j&auml;</td>
		</tr>

	<?php while ($kayttaja = mysql_fetch_array($result)) {

        print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$kayttaja["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$kayttaja["kayttajanimi"]."</td>";
        print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$kayttaja["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
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
<br/>
<?php
include ("includes/page_footer.php");
include ("includes/db_close.php");
?>