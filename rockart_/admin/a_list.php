<?php
include("init.php");
include("../includes/db_open.php");?>

	<table class="list2">
		<tr>
			<td><b> Kohteen nimi: <b/></td>
			<td><b> Paikkakunta: <b/></td>
		</tr>
<?php $kysely = mysql_query("SELECT * FROM maalaukset;");
				
		while ($maalaukset = mysql_fetch_array($kysely)) { 	
				$id = $maalaukset["maalaus_id"];?>						
		<tr>
			<td><?php print $maalaukset["maalaus_nimi"]?></a></td>
			<td><?php print $maalaukset["paikkakunta"]?></td>
				<form method="post" action="index.php">
				<input type="hidden" name="id" value="<?php print $id ?>" /> 
			<td><input type="submit" class="button" name="edit" value="Muokkaa kohteen tietoja"/></td>
			<td><input type="submit" class="button" name="remove" value="Poista kohde"/><td>
			</form>
		<?php	} ?>
				
		</tr>
	</table>
	
<?php include("../includes/db_close.php"); ?>