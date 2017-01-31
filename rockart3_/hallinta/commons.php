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
	$header=$_REQUEST["header"];
	$content=$_REQUEST["content"];
	$pdf_header=$_REQUEST["pdf_header"];
	$page_id=$_REQUEST["page_id"];
	$pdf=$_REQUEST["pdf"];

	//add alkaa
	if ($do == "add") {


$insstmt = "INSERT INTO commons (header,content,pdf_header,page_id,pdf)"
		   ."VALUES"." ('".$header."', '".$content."', '".$pdf_header."', '".$page_id."', '".$pdf."')";

$result = mysql_query($insstmt);

} //if add loppuu

if ($do == "addp") {

$pdf=$_REQUEST["pdf"];

    $myFile = "../english/commons_mat/$pdf";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../english/commons_mat/$pdf";
    unlink($myFile);

    if($_FILES["pdf"]["name"]){
    if ($_FILES["pdf"]["error"] > 0) {
    }//if
  else {
    if (file_exists("../english/commons_mat/" . $_FILES["pdf"]["name"])) {
      }//if
    else {
      move_uploaded_file($_FILES["pdf"]["tmp_name"],
      "../english/commons_mat/".$_FILES["pdf"]["name"]);
      }//else
    }//else
} //if
$pdf=$_FILES["pdf"]["name"];
    $updtstmt = "UPDATE commons SET"
                ." pdf = '".$pdf."'"
		." WHERE id = ".$id;

    $result = mysql_query($updtstmt);
}

	//upd alkaa
	if ($do == "upd") {

		$updtstmt = "UPDATE commons SET"
                ." header = '".$header."',"
				." content = '".$content."',"
				." pdf_header = '".$pdf_header."',"
				." page_id = '".$page_id."',"
				." pdf = '".$pdf."'"
				." WHERE id = ".$id;

		$result = mysql_query($updtstmt);

} //if upd loppuu

//del alkaa
if ($do == "del") {
    $pdf=$_REQUEST["pdf"];
if ($pdf !=null){
    $myFile = "../english/commons_mat/$pdf";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fclose($fh);
    $myFile = "../english/commons_mat/$pdf";
    unlink($myFile);
}
    $id=$_REQUEST["id"];
    $delstmt = "DELETE FROM commons WHERE id = ".$id;
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
		$result = mysql_query("SELECT * FROM commons WHERE id = $id;");
		$commons = mysql_fetch_array($result);

	} //if
	?>

<?php if ($do == "del") {

        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM commons WHERE id=$id;");

	if (mysql_num_rows($result)) {?>

        <p class="pSisalto">Haluatko varmasti poistaa kaiken?

	<?php while ($commons = mysql_fetch_array($result)) {
            print "<form method='POST' class='poistaForm' action='commons.php' >";
            print "<input type='hidden' name='pdf' value='".$commons["pdf"]."'>";
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
        <br/><p class="pSisalto"><a href="commons.php">Takaisin</a></p>
	<br/><br/>
<?php } //if

		else { //MUOKATAAN TAI LISÄTÄÄN

if ($do == "addp") { ?>
<p class='pSisalto'><b>Vaihda pdf</b>(Aikaisempi pdf poistetaan automaattisesti palvelimelta kun painetaan Lis&auml;&auml; painiketta ja uusi pdf korvataan edellisell&auml;)</p>
    <?php
        $id=$_REQUEST["id"];

	$result = mysql_query("SELECT * FROM commons WHERE id=$id;");

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
                print "<td class='table01_row01'><b>header:</b> N&auml;kyy varsinaisilla sivuilla isommalla otsikolla<br/>";
                print "<input type='text' name='header' value='".$commons["header"]."' size='40'></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Sisalt&ouml;:</b><br/>";
                print "Kirjoita teksti sellaisenaan, muotoilu tapahtuu automaattisesti. Voit kursivoida, alleviivata tai lihavoittaa teksti&auml; kuitenkin.
                       Voit luoda listoja, lis&auml;t&auml; linkkej&auml; ja tasailla teksti&auml;.
                       Jos haluat pakotetun rivin vaihdon k&auml;yt&auml; enteri&auml;.";
                print "<br/>HUOM! Teksti ei n&auml;yt&auml; t&auml;ysin samalta t&auml;ss&auml; ja sivuilla.";
                print "<textarea name='content' cols='100' rows='13'>".$commons["content"]."</textarea></td>";
            print "</tr>";
            print "<tr>";
                print "<td class='table01_row01'><b>Mik&auml; sivu:</b><br/>";
                print " <select name='page_id'>";
                    if ($commons["page_id"] == 1){ print " <option value='1'>Frontpage</option>"; }
                    if ($commons["page_id"] == 2){ print " <option value='2'>Seura/S&auml;&auml;nn&ouml;t</option>"; }
                    if ($commons["page_id"] == 3){ print " <option value='3'>Ajankohtaista</option>"; }
                    if ($commons["page_id"] == 4){ print " <option value='4'>Tutkimus/Tutkimusraportit</option>"; }
                    if ($commons["page_id"] == 5){ print " <option value='5'>Seminaariluennot</option>"; }
                    if ($commons["page_id"] == 6){ print " <option value='6'>Yhteystiedot</option>"; }

                    print " <option value='1'>Frontpage</option>";
                    print " <option value='2'>Seura/S&auml;&auml;nn&ouml;t</option>";
                    print " <option value='3'>Ajankohtaista</option>";
                    print " <option value='4'>Tutkimus/Tutkimusraportit</option>";
                    print " <option value='5'>Seminaariluennot</option>";
                    print " <option value='6'>Yhteystiedot</option>";
                print " </select>";
                print "</td>";
            print "</tr>";
        print "</table>";

        print "<table class='table01' border='0' cellpadding='10' cellspacing='4' width='70%'>";
            print "<tr>";
                print "<td class='table01_row01'><b>Pdf header:</b><br/>";
                print "<input type='text' name='pdf_header' value='".$commons["pdf_header"]."' size='40'></td>";
            print "</tr>";
             print "<tr>";
                print "<td>";
                print "T&auml;m&auml;n hetkinen pdf:<br/>";
                print ($commons["pdf"]."<br/>");
                print "</td>";
                print "<td>";
                print "<a href='".$PHP_SELF."?id=".$commons["id"]."&do=addp'>Vaihda pdf</a>";
                print "</td>";
            print "</tr>";
        print "</table>";
}

if ($do == "upd") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='upd'>";
        print "<input type='hidden' name='pdf' value='".$commons["pdf"]."'>";
        print "<input type='hidden' name='yhetystiedot' value='".$commons."'>";
        print "<input class='button' type='submit' name='go' value='Tallenna muutokset'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
} //if

if ($do == "add") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='add'>";
        print "<input class='button' type='submit' name='go' value='Lisää tiedot'>";
        print "<input class='button' type='submit' name='cancel' value='Peruuta'>";
    print"</p>";
}//if

if ($do == "addp") {
    print "<p class='pSisalto'>";
        print "<input type='hidden' name='do' value='addp'>";
        print "<input type='hidden' name='pdf' value='".$commons["pdf"]."'>";
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
	<a href="commons2.php">Lis&auml;&auml; uusi sis&auml;lt&ouml;</a><br/><br/>

	Valitsemalla muokkaa toiminnon (<img src="images/icon_edit.GIF" border="0" alt="muokkaa_kuva">) p&auml;&auml;set muokkamaan teksti&auml; ja otsikkoa<br/>
	Valitsemalla poisto toiminnon (<img src="images/icon_delete.GIF" border="0" alt="poista_kuva">) p&auml;&auml;set poistamaan valitun.<br/><br/>
        </p>
	<?php
	$result = mysql_query("SELECT * FROM commons ORDER BY page_id;");
	$rivityyli = "01";
	$rivinro = 1;
	?>

	<?php if (mysql_num_rows($result)) {?>

	<table class="table01" border="0" cellpadding="4" cellspacing="0" width="80%">

		<tr>
		<td class="table01_header" align="center">&nbsp;</td>
		<td class="table01_header" align="center">Muokkaa</td>
		<td class="table01_header" align="left" width="45%"><b>Otsikko</b></td>
                <td class="table01_header" align="left" width="25%">Sivulla</td>
		<td class="table01_header" align="center" width="16%">Poista sivu</td>
		</tr>

	<?php while ($commons = mysql_fetch_array($result)) {

                print "<tr>";
		print "<td class='table01_row".$rivityyli."' align='center'>".$rivinro++."</td>";
		print "<td class='table01_row".$rivityyli."' align='center'><a class='aTable01_row' href='".$PHP_SELF."?id=".$commons["id"]."&do=upd'><img src='images/icon_edit.GIF' border='0' alt='Muokkaa sivu'></a></td>";
		print "<td class='table01_row".$rivityyli."' align='left'>".$commons["header"]."</td>";
                    if ($commons["page_id"] == 1){ print "<td class='table01_row".$rivityyli."' align='left'>Frontpage</td>"; }
                    if ($commons["page_id"] == 2){ print "<td class='table01_row".$rivityyli."' align='left'>Seura/S&auml;&auml;nn&ouml;t</td>"; }
                    if ($commons["page_id"] == 3){ print "<td class='table01_row".$rivityyli."' align='left'>Ajankohtaista</td>"; }
                    if ($commons["page_id"] == 4){ print "<td class='table01_row".$rivityyli."' align='left'>Tutkimus/Tutkimusraportit</td>"; }
                    if ($commons["page_id"] == 5){ print "<td class='table01_row".$rivityyli."' align='left'>Seminaariluennot</td>"; }
                    if ($commons["page_id"] == 6){ print "<td class='table01_row".$rivityyli."' align='left'>Yhteystiedot</td>"; }
                print "<td class='table01_row".$rivityyli."' align='center'><a href='".$PHP_SELF."?id=".$commons["id"]."&do=del'><img src='images/icon_delete.GIF' border='0' alt='Poista sivu'></a></td>";
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