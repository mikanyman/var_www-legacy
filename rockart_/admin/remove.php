<?php
include("init.php");
include("../includes/db_open.php");
?>

<?php if ($_REQUEST["poista"]) {
	
	$tiedot = mysql_query("SELECT * FROM kuvat2 WHERE maalaus_id = ".$_REQUEST["id"].";");
	while ($kuvat = mysql_fetch_array($tiedot)) {
		unlink("../images/".$kuvat["kuva_id"].".".$kuvat["tiedostopaate"]."");
		unlink("../images/".$kuvat["kuva_id"]."_thumb.".$kuvat["tiedostopaate"]."");
	} //while
	
	$lause = "DELETE FROM maalaukset WHERE maalaus_id = ".$_REQUEST["id"].";";
	mysql_query($lause);
	
	$lause2 = "DELETE FROM pdf WHERE maalaus_id = ".$_REQUEST["id"].";";
	mysql_query($lause2);
	
	print "Kohde ".$_REQUEST["maalaus_nimi"]." poistettu.";	
	
?>
	<br/>
	<a href="index.php">Takaisin listaukseen</a>
	
<?php } else { 
		$lause = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id = ".$_REQUEST["id"].";");
		$tiedot = mysql_fetch_array($lause); ?>
		
	<div class="link"><a href="index.php">Takaisin listaukseen</a><div>	

	<table class="list2">
	<tr>
			<form method="post" action="index.php">
			<input type="hidden" name="id" value="<?php print $_REQUEST["id"]?>" />
		<td class="title"> Haluatko varmasti poistaa kohteen </td>
		<td class="text"><input type="text" name="maalaus_nimi" value="<?php print $tiedot["maalaus_nimi"] ?>" /></td>
	</tr>
	<tr>
		<td class="text">&nbsp; </td>
		<td class="text"><input type="submit" name="poista" class="button" value="Poista kohde" /></td>
			</form>
	</tr>
	</table>

<?php } //if ?>
	

<?php
include("../includes/db_close.php");

?>