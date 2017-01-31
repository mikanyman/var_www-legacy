<?php
include("init.php");
include("../includes/db_open.php");
include("../includes/page_header.php");
?>

<div class="navi">
	<?php include("../includes/navi_admin.php");?>
</div>

<?php if ($_REQUEST["poista_artikkeli"]) {
	$lause = "DELETE FROM pdf WHERE pdf_id = ".$_REQUEST["pdf_id"].";";
	mysql_query($lause);
	
	print "Artikkeli poistettu palvelimelta."; ?><br/>
<?php
	} else {
	  $kysely = mysql_query("SELECT maalaus_nimi FROM maalaukset WHERE maalaus_id=".$_REQUEST["id"].";"); 
	  $kohde = mysql_fetch_array($kysely);
?>

<a href="index.php?edit&id=<?php print $_REQUEST["id"]?>">Takaisin</a><p/>
<div>
	<table class="list2">
		<tr>
			<td class="title" colspan="2">Artikkelit kohteesta <?php print $kohde[0] ?></td>
		</tr>
			<form method="post" action="remove_pdf.php">
		<?php	
		   $kysely2 = mysql_query("SELECT * FROM pdf WHERE maalaus_id=".$_REQUEST["id"].";");
			while ($artikkelit = mysql_fetch_array($kysely2)) {
			 $time = filemtime("../pdf/".$artikkelit["nimi"].".pdf");
			 $mod = date("d F Y", $time);
			 
			?>	<tr>
				<input type="hidden" name="pdf_id" value="<?php print $artikkelit["pdf_id"]?>" />	
				<td class="text" id="nimi"><a href="../pdf/<?php print $artikkelit["nimi"]?>.pdf" target="_blank" title="Nimi: <?php print $artikkelit["nimi"]?>  &#xA; Tekijä: <?php print $artikkelit["kirjoittaja"]?>  &#xA; Muokattu: <?php print $mod?> ">
				<b><?php print $artikkelit["nimi"]?></b></a></td>
				<td class="text" id="kirjoittaja"><?php print $artikkelit["kirjoittaja"]?></td>
				<td><input type="submit" class="button" name="poista_artikkeli" value="Poista artikkeli" /></td>
				</tr>
			<?php } ?>
	</table>
</div>

<?php
	} //if
?>


<?php
include("../includes/db_close.php");
include("../includes/page_footer.php");
?>