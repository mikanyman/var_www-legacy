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
	$sivu_nimi=$_REQUEST["sivu_nimi"];

	//add alkaa
        if ($do == "add") {
                $insstmt = "INSERT INTO sivut (sivu_nimi)"
                                   ."VALUES"." ('".$sivu_nimi."')";

                $result = mysql_query($insstmt);

} //if add loppuu

	//upd alkaa
	if ($do == "upd") {
		$updtstmt = "UPDATE sivut SET"
                ." sivu_nimi = '".$sivu_nimi."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
	if ($do == "del") {
		$id=$_GET["id"];
		$delstmt = "DELETE FROM sivut WHERE id = ".$id;

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
		$result = mysql_query("SELECT * FROM sivut WHERE id = $id;");
		$sivut = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") { //POISTETAAN

        $id=$_GET["id"];
		$delstmt = "DELETE FROM sivut WHERE id = ".$id;
		$result = mysql_query($delstmt);
	?>
	<p class="pSisalto3">
        <?php
            print "Poistettu";
	?>
        <br/><a href="menu.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

		else { //MUOKATAAN TAI LISÄTÄÄN

		if ($do == "add") {?>
                <p class="pSisalto"><b>Lis&auml;&auml; uusi sivu_nimi ja sis&auml;lt&ouml;</b></p>
		<?php } else { ?>
                <p class="pSisalto"><b>Muokkaa</b></p>
		<?php }?>

<?php
print "<form method='POST' action='".$PHP_SELF."'>";
    print "<input type='hidden' name='id' value='".$id."'>";
        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sivun nimi:</b><br/>";
                print "<input type='text' name='sivu_nimi' value='".$sivut["sivu_nimi"]."' size='50'></td>";
            print "</tr>";
        print "</table>";

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='yhetystiedot' value='".$sivut."'>";
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
	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan sivun nime&auml;<br/>
        ID 1-8 on p&auml;&auml;tason linkkej&auml;.<br/>
        ID 9-11 on ylh&auml;&auml;ll&auml; olevat linkit.<br/>
        ID 12-22 on alatason linkkej&auml;.<br/>
	</p>
	<?php
	$result = mysql_query("SELECT * FROM sivut ORDER BY id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="70%">

		<tr>
		<td class="table01_header" align="center">ID:</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left"><b>Sivun nimi</b></td>
		</tr>

	<?php while ($sivut = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$sivut["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$sivut["sivu_nimi"]."</td>";
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