<?php
include("../includes/db_open.php");
include("../includes/page_header.php");
?>

<div class="navi">
	<?php include("../includes/navi_user.php");?>
</div>

<?php $kysely = mysql_query("SELECT maalaus_nimi FROM maalaukset WHERE maalaus_id=".$_REQUEST["id"].";"); 
	  $kohde = mysql_fetch_array($kysely);
?>

<div class="link">
<a href="index.php?value=<?php print $_REQUEST["id"]?>">Takaisin</a>
</div>

<div>
	<table class="list2">
		<tr>
			<td class="title" colspan="2">Artikkelit kohteesta <?php print $kohde[0] ?></td>
		</tr>
		<?php	
		   $kysely2 = mysql_query("SELECT * FROM pdf WHERE maalaus_id=".$_REQUEST["id"].";");
			while ($artikkelit = mysql_fetch_array($kysely2)) {
			 $time = filemtime("../pdf/".$artikkelit["nimi"].".pdf");
			 $mod = date("d F Y", $time);
			?>	<tr>
				<td class="text" id="nimi"><a href="../pdf/<?php print $artikkelit["nimi"]?>.pdf" target="_blank" title="Nimi: <?php print $artikkelit["nimi"]?>  &#xA; Tekijä: <?php print $artikkelit["kirjoittaja"]?>  &#xA; Muokattu: <?php print $mod?> ">
				<b><?php print $artikkelit["nimi"]?></b></a></td>
				<td class="text" id="kirjoittaja"><?php print $artikkelit["kirjoittaja"]?></td>
				</tr>
		<?php }?>			
	</table>
</div>

<?php
include("../includes/db_close.php");
include("../includes/page_footer.php");
?>