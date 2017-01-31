<?php
include("../includes/db_open.php");
include("../includes/page_header.php"); ?>
	  
 <div class="navi">
	<?php include("../includes/navi_user.php");?>
</div>
<?php
if (isset ($_REQUEST["hae"])) { 

		 if (!empty($_REQUEST["maalaus_nimi"])){
		 
		$kysely = mysql_query("SELECT * FROM maalaukset WHERE maalaus_nimi LIKE'%".$_REQUEST["maalaus_nimi"]."%';"); 
		
		if(mysql_num_rows($kysely) > 0) {
	?>
		<table class="list2">
				<tr>
					<td class="text"> Kohteen nimi: </td>
					<td class="text"> Paikkakunta: </td>
				</tr>
			<?php 				
				while ($maalaukset = mysql_fetch_array($kysely)) { 
												
						$id = $maalaukset["maalaus_id"];?>
						
						<tr>
							<td class="text"><a href="index.php?value=<?php print $id?>"><?php print $maalaukset["maalaus_nimi"]?></a></td>
							<td class="text"><?php print $maalaukset["paikkakunta"]?></td>								
				<?php	} ?>
						</tr>
				</table>
				
		<?php } else { ?>
		<div class="login">
		<?php print "Hakua vastaavia kohteita ei löytynyt"; ?>
		<br/><a href="index.php">Takaisin</a>
		</div>
	<?php	} ?>
			<?php	
	} else if (!empty($_REQUEST["paikkakunta"])) {
			$kysely = mysql_query("SELECT * FROM maalaukset WHERE paikkakunta LIKE '%".$_REQUEST["paikkakunta"]."%';"); 
	
		if(mysql_num_rows($kysely) > 0) { ?>
		<table class="list2">
				<tr>
					<td class="text"> Kohteen nimi: </td>
					<td class="text"> Paikkakunta: </td>
				</tr>
			<?php 				
				while ($maalaukset = mysql_fetch_array($kysely)) { 
				
						$id = $maalaukset["maalaus_id"];?>
						
						<tr>
							<td class="text"><a href="index.php?value=<?php print $id?>"><?php print $maalaukset["maalaus_nimi"]?></a></td>
							<td class="text"><?php print $maalaukset["paikkakunta"]?></td>						
				<?php	} ?>
						</tr>
		</table>
		
		<?php } else { ?>
		<div class="login">
		<?php print "Hakua vastaavia kohteita ei löytynyt"; ?>
		<br/><a href="index.php">Takaisin</a>
		</div>
	<?php	} ?>
	<?php	
			} else { ?>
				<div class="login">
			<?php print "Suorita haku kohteen nimen tai paikkakunnan perusteella"; ?>
			<br/><a href="index.php">Takaisin</a>
			</div>
	<?php	} //if
			
			} //if	

	

include("../includes/db_close.php");
