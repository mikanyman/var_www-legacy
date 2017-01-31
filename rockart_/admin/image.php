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
				<input type="hidden" name="id" value="<?php print $_REQUEST["id"] ?>">
			Lis‰‰ kuva: </td>
			<td class="text"><input name="kuva" type="file" /></td>
		</tr>
		<tr>
			<td class="title"> Kuvaaja: </td>
			<td class="text"><input type="text" name="kuvaaja" /></td>
		</tr>
		<tr>
			<td class="title"> Kuvaus: </td>
			<td class="text"><textarea name="kuvaus_k" cols="40" rows="6"></textarea></td>
		</tr>
		<tr>
			<td class="text">&nbsp;</td>
			<td class="text"><input type="submit" class="button_add" name="lisaa_kuva" value="Lis‰‰ kuva" /></td>
		</tr>
	</form>
	</table>
	</div>
	<div class="thumbnails_bottom"></div>

<?php if (!empty($_REQUEST["kuvaaja"])) {

	$kuvaus_k = str_replace('"', "&quot;", $_REQUEST["kuvaus_k"]);
	
	
	include("../includes/db_open.php");
		
	// kuvan lis‰ys kansioon
	$kuvat_dir = '../images';
	$tiedostopaate = explode(".", $_FILES['kuva']['name']);
	$tiedostotyyppi = explode("/", $_FILES['kuva']['type']);

	$file_type = strtolower($tiedostopaate[1]);
	
	//tarkistetaan, onko lis‰tt‰v‰ tiedosto kuva
	$type = $tiedostotyyppi[0];
        
	if($type != "image") {
		print "Lis‰tt‰v‰ tiedosto ei ole kuva!";
	} else {
    
	//lis‰t‰‰n kuva kantaan
	$lause_kuvat ="INSERT INTO kuvat2 (tiedostopaate, kuvaaja, kuvaus, maalaus_id) VALUES ('".$tiedostopaate[1]."','".$_REQUEST["kuvaaja"]."','".$kuvaus_k."',".$_REQUEST["id"].");";
	mysql_query($lause_kuvat);
	$kuva_id = mysql_insert_id();
	include("../includes/db_close.php");
	//siirret‰‰n palvelimelle
	$nimi = $kuva_id.".".$tiedostopaate[1];
    move_uploaded_file ($_FILES['kuva']['tmp_name'], $kuvat_dir."/".$nimi);
	
	// Tehd‰‰n thumbnail
	// Set a maximum height and width
	$width = 150;
	$height = 150;
	$thumbsize = 150;
	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize("../images/".$nimi."");

	$ratio_orig = $width_orig/$height_orig;

	if ($width/$height > $ratio_orig) {
		$width = $height*$ratio_orig;
	} else {
		$height = $width/$ratio_orig;
	}

	// Resample
	$image_p = imagecreatetruecolor($thumbsize, $thumbsize);
	
	if($file_type == "jpeg" || $file_type == "jpg") {
		$image = imagecreatefromjpeg("../images/".$nimi."");
	} else if ($file_type == "gif") {
		$image = imagecreatefromgif("../images/".$nimi."");
	} else if ($file_type == "png") {
		$image = imagecreatefrompng("../images/".$nimi."");
	}
	imagecopyresampled($image_p, $image, -($width/2) + ($thumbsize/2), -($height/2) + ($thumbsize/2), 0, 0, $width, $height, $width_orig, $height_orig);

	// Output
	imagejpeg($image_p, "../images/".$kuva_id."_thumb.".$tiedostopaate[1], 100);
	imagedestroy($image_p); 
	
	print "Kuva lis‰tty onnistuneesti.";
	
	} //if
} //if 	
?>

