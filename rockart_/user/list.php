<?php include("../includes/db_open.php");
	  include("../includes/page_header.php"); ?>
	  
 <div class="navi">
	<?php include("../includes/navi_user.php");?>
 </div>

<?php   if(($_REQUEST["value"])) { 
?>
	<div class="link">
	<a href="index.php?listaus=">Takaisin listaukseen</a>
	 </div>
			
	<div class="map_others">
			
		 <ul id="tablist">
			<li><a href="#sc1" class="current" onClick="return expandcontent('sc1', this)">Google Maps</a></li>
			<li><a href="#sc2" onClick="return expandcontent('sc2', this)">Bing Maps</a></li>
			<li><a href="#sc3" onClick="return expandcontent('sc3', this)">MapQuest</a></li>
		</ul>

		<div id="tabcontentcontainer">

		<div id="sc1" class="tabcontent">
				  <div id="mapCanvas" class="mapCanvas"></div>
				  <div id="infoPanel" class="infoPanel">
				   <!-- <b>Marker status:</b> -->
					<div id="markerStatus"></div>
					<b>Sijainti:</b>
					<div id="info"></div>
					<b>Lähin osoite:</b>
					<div id="address"></div>
				  </div>
		</div>
		<div id="sc2" class="tabcontent">
				<div id="myMap" class="mapCanvas"></div>
		</div>
		<div id="sc3" class="tabcontent">
				<div id="map" style="width:520px; height:420px;"></div>
		</div>
	
		</div>
		
	</div>
			
	<div class="list">
		<table>
			<tr>	
	<?php	$kysely = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id=".$_REQUEST["value"].";");
			while ($maalaukset = mysql_fetch_array($kysely)) { 
			
			$id = $maalaukset["maalaus_id"];
			include("../includes/etrs_tm35fin_to_euref_fin.php");
			$NE = explode("," , MuunnaKoordinaatit($maalaukset["E"], $maalaukset["N"]));	
			?>	
				<input type="hidden" id="N" value="<?php print $NE[0]?>" />
				<input type="hidden" id="E" value="<?php print $NE[1]?>" />
				<input type="hidden" id="lat" value="<?php print $maalaukset["lat"]?>"/>
				<input type="hidden" id="lng" value="<?php print $maalaukset["lng"]?>"/>
				
				<td class="title"> Kohteen nimi: </td>
				<td class="text" id="nimi"><?php print $maalaukset["maalaus_nimi"]?></td>
			</tr>
			<tr>
				<td class="title">Paikkakunta: </td>
				<td class="text" id="paikkakunta" name="paikkakunta"><?php print $maalaukset["paikkakunta"]?></td>
			</tr>
			<tr>
				<td class="title">Kuvaus: </td>
				<td class="text" id="kuvaus"><?php $kuvaus = str_replace(chr(13),"<p/>",$maalaukset["kuvaus"]);
						  print $kuvaus?></td>
			</tr>
			<tr>
				<td class="title">Peruskartta:</td>
				<td class="text"><?php print $maalaukset["peruskartta"]?></td>
			</tr>
			<tr>
				<td class="title">Karttanimi:</td>
				<td class="text"><?php print $maalaukset["karttanimi"]?></td>
			</tr>
			<tr>
				<td class="title">N:</td>
				<td class="text"><?php print $maalaukset["N"]?></td>
			</tr>
			<tr>
				<td class="title">E:</td>
				<td class="text"><?php print $maalaukset["E"]?></td>
			</tr>	
		<?php if($maalaukset["lat"] && $maalaukset["lng"]) {?>
			<tr>
				<td class="title">Lat:</td>
				<td class="text"><?php print $maalaukset["lat"]?></td>
			</tr>
			<tr>
				<td class="title">Lng:</td>
				<td class="text"><?php print $maalaukset["lng"]?></td>
			</tr>
		<?php } //if ?>
			<tr>
				<td class="title">x:</td>
				<td class="text"><?php print $maalaukset["x"]?></td>
			</tr>
			<tr>
				<td class="title">y:</td>
				<td class="text"><?php print $maalaukset["y"]?></td>
			</tr>
			<tr>
				<td class="title">p:</td>
				<td class="text"><?php print $maalaukset["p"]?></td>
			</tr>
			<tr>
				<td class="title">i:</td>
				<td class="text"><?php print $maalaukset["i"]?></td>
			</tr>
			<tr>
				<td class="title">Päävesistöalue:</td>
				<td class="text"><?php print $maalaukset["paavesistoalue"]?></td>		
	<?php } ?>
			</tr>
			</table>
			
		
	</div>
	<div>
	<?php	$kysely = mysql_query("SELECT * FROM pdf WHERE maalaus_id=".$_REQUEST["value"].";");
			$lkm = mysql_num_rows($kysely);
			$tiedot = mysql_fetch_array($kysely);

			$kysely2 = mysql_query("SELECT * FROM maalaukset WHERE maalaus_id=".$_REQUEST["value"].";");
			$koordinaatit = mysql_fetch_array($kysely2);

			
	?>	
			<table>
				<tr>
					<?php if ($lkm > 0) { ?>
					<td class="link"><a href="../user/pdf.php?id=<?php print $_REQUEST["value"]?>">Näytä artikkelit</a> (<?php print $lkm?> kpl) </td>
					<?php } else { ?>
					<td class="link">&nbsp;</td>
					<?php } ?>
					<td><a href="http://kansalaisen.karttapaikka.fi/koordinaatit/koordinaatit.html?y=<?php print $koordinaatit["N"]?>&x=<?php print $koordinaatit["E"]?>&srsName=EPSG%3A3067&show=N%C3%A4yt%C3%A4+kartalla&lang=fi&e=<?php print $koordinaatit["E"]?>&n=<?php print $koordinaatit["N"]?>&scale=16000&tool=siirra&styles=normal&lang=fi" target="_blank">Sijainti Kansalaisen Karttapaikalla</a></td>
				</tr>
			</table>
	</div>
	
	
<?php 
	$kysely = mysql_query("SELECT * FROM kuvat2 WHERE maalaus_id=".$id.";");
	$kuva_lkm = mysql_num_rows($kysely);
	if($kuva_lkm > 0) { ?>
	
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
				</td>
				
				<?php
				// joka viidennen kuvan jälkeen vaihdetaan riviä
				$counter++;
						if(($counter % 5) == 0) {
						?></tr>
						  <tr><?php
						} //if
			 } //while ?>
			</tr>
		</table>

	</div>
	<div class="thumbnails_bottom"></div>
	
<?php } //if
	
	 }  else { ?>
			
			<table class="list2">
				<tr>
					<td class="title"> Kohteen nimi: </td>
					<td class="title"> Paikkakunta: </td>
				</tr>
			<?php $kysely = mysql_query("SELECT * FROM maalaukset;");
				
				while ($maalaukset = mysql_fetch_array($kysely)) { 
				
						$id = $maalaukset["maalaus_id"];?>
						
						<tr>
							<td class="text"><a href="index.php?value=<?php print $id ?>"><?php print $maalaukset["maalaus_nimi"]?></a></td>
							<td class="text"><?php print $maalaukset["paikkakunta"]?></td>
									
				<?php	} ?>
						</tr>
			</table>
	<?php } //if ?>

<?php include("../includes/db_close.php"); ?>