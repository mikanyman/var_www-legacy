<?php
include("init.php");
include("../includes/db_open.php");
?>

<?php if ($_REQUEST["poista_kuva"]) {
	$lause = "DELETE FROM kuvat2 WHERE kuva_id = ".$_REQUEST["kuva_id"].";";
	mysql_query($lause);
	
	//Poistetaan palvelimelta
	unlink("../images/".$_REQUEST["kuva_id"].".".$_REQUEST["tiedostopaate"]."");
	unlink("../images/".$_REQUEST["kuva_id"]."_thumb.".$_REQUEST["tiedostopaate"]."");
	
	print "Kuva poistettu palvelimelta.";	
	
?>
	<br/>
	<a href="index.php?edit&id=<?php print $_REQUEST["id"]?>">Takaisin muokkaukseen</a>
	
<?php } else { 
		$lause = mysql_query("SELECT * FROM kuvat2 WHERE kuva_id = ".$_REQUEST["kuva_id"].";");
		$tiedot = mysql_fetch_array($lause); ?>

	<table>
	<tr>
			<form method="post" action="index.php">
			<input type="hidden" name="kuva_id" value="<?php print $_REQUEST["kuva_id"]?>" />
			<input type="hidden" name="tiedostopaate" value="<?php print $tiedot["tiedostopaate"]?>" />
			<input type="hidden" name="id" value="<?php print $tiedot["maalaus_id"]?>" />
		<td class="title"> Haluatko varmasti poistaa kuvan </td>
		<td class="text">
				<a href="../images/<?php print $tiedot["kuva_id"]?>.<?php print $tiedot["tiedostopaate"]?>" rel="lightbox[kuvat]">
				<img class="thumb" src="../images/<?php print $tiedot["kuva_id"]?>_thumb.<?php print $tiedot["tiedostopaate"]?>" /></a>
		</td>
	</tr>
	<tr>
		<td class="text">&nbsp; </td>
		<td class="text"><input type="submit" class="button" name="poista_kuva" value="Poista kuva" /></td>
			</form>
	</tr>
	</table>
<?php } //if ?>
	

<?php
include("../includes/db_close.php");

?>