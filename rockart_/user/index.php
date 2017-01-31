<?php if(isset($_REQUEST["listaus"]) || isset($_REQUEST["value"])) {
		include("list.php");
	}  else if(isset($_REQUEST["hae"])) {
		include("search.php");
	} else { ?>
	
<?php
	include("../includes/page_header.php");
?>	
	<div class="navi">
	<?php include("../includes/navi_user.php");?>
	</div>
	
	<div class="header">
	</div>

	<div class="map_index">
		<div id="map_canvas" class="map_canvas"></div>
	</div>
	
	<div class="index">
	<table>
		<tr>
				<form method="post" action="index.php">
			<td class="title"> Kohteen nimi: </td>
			<td><input type="text" size="30" name="maalaus_nimi"/></td>
		</tr>
		<tr>
			<td class="title"> Paikkakunta: </td>
			<td><input type="text" size="30" name="paikkakunta"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" class="button" name="hae" value="Hae" /></td>
		</tr>
				</form>
				<form method="post" action="index.php">
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="listaus" class="button" value="Listaus kaikista kohteista"/></td>
	</form>
	</table>
	
	</div>
	
	<?php }?>
	
<?php	
include("../includes/page_footer.php");
?>

