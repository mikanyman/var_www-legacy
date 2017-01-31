<?php
include("init.php");
?>
	<div class="link">
	<a href="index.php?edit&id=<?php print $_REQUEST["id"]?>">Takaisin</a>
	</div>
	<div class="thumbnails_top"></div>
	<div class="thumbnails">
	<table class="text">
		<tr>
			<td class="title">
				<form enctype="multipart/form-data" method="post" action="index.php">
				<input type="hidden" name="id" value="<?php print $_REQUEST["id"]?>">
			Lis‰‰ artikkeli: </td>
			<td class="text"><input name="pdf" type="file"/></td>
		</tr>
		<tr>
			<td class="title"> Nimi: </td>
			<td class="text"><input type="text" name="nimi" /></td>
		</tr>
		<tr>
			<td class="title"> Tekij‰: </td>
			<td class="text"><input type="text" name="tekija" /></td>
		</tr>
		<tr>
			<td class="text">&nbsp;</td>
			<td class="text"><input type="submit" class="button_add" name="lisaa_pdf" value="Lis‰‰ artikkeli" /></td>
		</tr>
	</form>
	</table>
	</div>
	<div class="thumbnails_bottom"></div>

<?php if (!empty($_REQUEST["nimi"])) {

	$nimi = str_replace('"', "&quot;", $_REQUEST["nimi"]);
	
	include("../includes/db_open.php");
		
	// pdf:n lis‰ys kansioon
	$pdf_dir = '../pdf';
	$tiedostopaate = explode(".", $_FILES['pdf']['name']);
	$tiedostotyyppi = explode("/", $_FILES['pdf']['type']);

	$file_type = strtolower($tiedostopaate[1]);
	
	// tarkistetaan, onko lis‰tt‰v‰ tiedosto pdf
	$type = $tiedostotyyppi[1];
        
	if($type != "pdf") {
		print "Lis‰tt‰v‰ tiedosto ei ole pdf!";
	} else {
    
	// lis‰t‰‰n pdf kantaan
	$lause_pdf ="INSERT INTO pdf (nimi, kirjoittaja, maalaus_id) VALUES ('".$_REQUEST["nimi"]."','".$_REQUEST["tekija"]."',".$_REQUEST["id"].");";
	mysql_query($lause_pdf);
	include("../includes/db_close.php");
	//siirret‰‰n palvelimelle
	$nimi = $nimi.".pdf";
    move_uploaded_file ($_FILES['pdf']['tmp_name'], $pdf_dir."/".$nimi);
	
	print "Artikkeli lis‰tty onnistuneesti.";
	
	} //if
} //if 	
?>