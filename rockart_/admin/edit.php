<?php 
include("init.php");
include("../includes/db_open.php");?>

<?php   if ($_REQUEST["muokkaa"]) {
			mysql_query("UPDATE maalaukset SET maalaus_nimi='".$_REQUEST["maalaus_nimi"]."', paikkakunta='".$_REQUEST["paikkakunta"]."',
						kuvaus='".$_REQUEST["kuvaus"]."', N='".$_REQUEST["N"]."', E='".$_REQUEST["E"]."', peruskartta='".$_REQUEST["peruskartta"]."',
						karttanimi='".$_REQUEST["karttanimi"]."', x='".$_REQUEST["x"]."', y='".$_REQUEST["y"]."', p='".$_REQUEST["p"]."', i='".$_REQUEST["i"]."',
						paavesistoalue='".$_REQUEST["paavesistoalue"]."' WHERE maalaus_id = ".$_REQUEST["id"].";");			 
		print "<b> Tiedot tallennettu! </b>";	
		
		$lause = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id = ".$_REQUEST["id"].";");
		$tiedot = mysql_fetch_array($lause); 
?>
		<div class="link"><a href="index.php">Takaisin listaukseen</a></div>
		
<?php	} else if ($_REQUEST["koordinaatit_kartalta"]) {
			mysql_query("UPDATE maalaukset SET lat='".$_REQUEST["lat"]."', lng='".$_REQUEST["lng"]."' WHERE maalaus_id = ".$_REQUEST["id"].";");			 
		print "<b> Sijainti tallennettu! </b>";
		
		$lause = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id = ".$_REQUEST["id"].";");
		$tiedot = mysql_fetch_array($lause); 
?>
		<div class="link"><a href="index.php">Takaisin listaukseen</a></div>
		
<?php	} else {
			$lause = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id = ".$_REQUEST["id"].";");
			$tiedot = mysql_fetch_array($lause); 
		} ?>

<div class="map_others">

		<ul id="tablist">
			<li><a href="#sc1" class="current" onClick="return expandcontent('sc1', this)">Google Maps</a></li>
			<li><a href="#sc2" onClick="return expandcontent('sc2', this)"></a></li>
			<li><a href="#sc3" onClick="return expandcontent('sc3', this)"></a></li>
		</ul>

		<div id="tabcontentcontainer">

		<div id="sc1" class="tabcontent">
				  <div id="mapCanvas" class="mapCanvas"></div>
				  <div id="infoPanel" class="infoPanel">
				   <!-- <b>Marker status:</b> -->
					<div id="markerStatus"><i>Klikkaa ja liikuta merkkiä</i></div>
					<b>Sijainti:</b>
					<div id="info"></div>
					<b>Lähin osoite:</b>
					<div id="address"></div>
				  </div>
		</div>

		<div id="sc2" class="tabcontent">
				<!-- <div id="myMap" class="mapCanvas"></div> -->
		</div>

		<div id="sc3" class="tabcontent">
				<!-- <div id="map" style="width:520px; height:420px;"></div> -->
		</div>

		</div>
				
 
</div>
	
		
	<div class="list">	
<table>
	<tr>
			<form method="post" action="index.php">
			<input type="hidden" name="id" value="<?php print $_REQUEST["id"]?>" />
			<?php
			$id = $maalaukset["maalaus_id"];
			include("../includes/etrs_tm35fin_to_euref_fin.php");
			$NE = explode("," , MuunnaKoordinaatit($tiedot["E"], $tiedot["N"]));
			?>
			<input type="hidden" id="N" value="<?php print $NE[0]?>"/>
			<input type="hidden" id="E" value="<?php print $NE[1]?>"/>
		<td class="title"> Kohteen nimi: </td>
		<td class="text"><input type="text" id="nimi" name="maalaus_nimi" value="<?php print $tiedot["maalaus_nimi"]?>" /></td>
	</tr>
	<tr>
		<td class="title"> Paikkakunta: </td>
		<td class="text"><input type="text" id="paikkakunta" name="paikkakunta" value="<?php print $tiedot["paikkakunta"]?>" /></td>
	</tr>
	<tr>
		<td class="title"> Kuvaus: </td>
		<td class="text"><textarea name="kuvaus" id="kuvaus" cols="40" rows="8"><?php print $tiedot["kuvaus"]?></textarea></td>
	</tr>
	<tr>
		<td class="title"> Peruskartta: </td>
		<td class="text"><input type="text" name="peruskartta" value="<?php print $tiedot["peruskartta"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> Karttanimi: </td>
		<td class="text"><input type="text" name="karttanimi" value="<?php print $tiedot["karttanimi"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> N: </td>
		<td class="text"><input type="text" name="N" value="<?php print $tiedot["N"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> E: </td>
		<td class="text"><input type="text" name="E" value="<?php print $tiedot["E"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> x: </td>
		<td class="text"><input type="text" name="x" value="<?php print $tiedot["x"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> y: </td>
		<td class="text"><input type="text" name="y" value="<?php print $tiedot["y"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> p: </td>
		<td class="text"><input type="text" name="p" value="<?php print $tiedot["p"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> i: </td>
		<td class="text"><input type="text" name="i" value="<?php print $tiedot["i"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> Päävesistöalue: </td>
		<td class="text"> <input type="text" name="paavesistoalue" value="<?php print $tiedot["paavesistoalue"]?>"/></td>
	</tr>
	<tr>
		<td class="text" colspan="2"><input type="hidden" id="lat" name="lat" value="<?php print $tiedot["lat"]?>"/></td>
	</tr>
	<tr>
		<td class="text" colspan="2"><input type="hidden" id="lng" name="lng" value="<?php print $tiedot["lng"]?>"/></td>
	</tr>
	<tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="muokkaa" value="Tallenna muutokset" /></td>
	</tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="kuva" value="Lisää kuva" /></td>
	</tr>
	</tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="pdf" value="Lisää artikkeli" /></td>
	</tr>
	</tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="koordinaatit_kartalta" value="Tallenna sijainti kartalta (EUREF-FIN)" /></td>
	</tr>
			</form>
	</table>
	
	</div>
	
	<table>
		<tr>
		<?php
			$kysely = mysql_query("SELECT * FROM pdf WHERE maalaus_id=".$_REQUEST["id"].";");
			$lkm = mysql_num_rows($kysely);
			
			if ($lkm >0) {
		?>
			<td class="link"><a href="../admin/remove_pdf.php?id=<?php print $_REQUEST["id"] ?>">Poista artikkeli</a></td>
		<?php	} else { ?>
			<td class="link">&nbsp;</td>
		<?php } //if ?>
			<td><a href="http://kansalaisen.karttapaikka.fi/koordinaatit/koordinaatit.html?y=<?php print $tiedot["N"]?>&x=<?php print $tiedot["E"]?>&srsName=EPSG%3A3067&show=N%C3%A4yt%C3%A4+kartalla&lang=fi&e=<?php print $koordinaatit["E"]?>&n=<?php print $koordinaatit["N"]?>&scale=16000&tool=siirra&styles=normal&lang=fi" target="_blank">Sijainti Kansalaisen Karttapaikalla</a></td>
		</tr>
	</table>
	
	<?php 
		$kysely = mysql_query("SELECT * FROM kuvat2 WHERE maalaus_id=".$_REQUEST["id"].";");
		$kuva_lkm = mysql_num_rows($kysely);
	if($kuva_lkm > 0) {
	?>
	
	<div class="thumbnails_top"></div>
    <div class ="thumbnails">
		<table>
			<tr>
			<?php
				
			// Laskuri kuvien rivitystä varten
			$counter = 0;

			while ($kuvat = mysql_fetch_array($kysely)) {?>		
				<td>
				<a href="../images/<?php print $kuvat["kuva_id"]?>.<?php print $kuvat["tiedostopaate"]?>" rel="lightbox[kuvat]" title="<?php print $kuvat["kuvaus"]?> <br/> Kuvaaja: <?php print $kuvat["kuvaaja"]?>">
				<img class="thumb" src="../images/<?php print $kuvat["kuva_id"]?>_thumb.<?php print $kuvat["tiedostopaate"]?>" /></a><br/>
				<a href="index.php?kuva_id=<?php print $kuvat["kuva_id"] ?>">Poista</a><br/>
				</td>
				
				<?php
				// joka viidennen kuvan jälkeen vaihdetaan riviä
				$counter++;
						if(($counter % 5) == 0) {
						?></tr>
						  <tr><?php
						} //if			
				
			 } //while
			 ?>
			</tr>
		</table>
	</div>
	<div class="thumbnails_bottom"></div>
	
	<?php } //if ?>

<?php include("../includes/db_close.php"); ?>

