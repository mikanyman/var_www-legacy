<?php
include("init.php");
include("../includes/db_open.php");
?>
<?php

if($_REQUEST["lisaa_kohde"]) {
	$lause_maalaus="INSERT INTO maalaukset (maalaus_nimi,paikkakunta,kuvaus,peruskartta,karttanimi,N,E,x,y,p,i,paavesistoalue) VALUES
			('".$_REQUEST["maalaus_nimi"]."','".$_REQUEST["paikkakunta"]."','".$_REQUEST["kuvaus"]."','".$_REQUEST["peruskartta"]."',
			'".$_REQUEST["karttanimi"]."','".$_REQUEST["N"]."','".$_REQUEST["E"]."','".$_REQUEST["x"]."','".$_REQUEST["y"]."','".$_REQUEST["p"]."',
			'".$_REQUEST["i"]."','".$_REQUEST["paavesistoalue"]."');";
	mysql_query($lause_maalaus);
	
	print "Kohde lisätty."; ?> <br/><br>
	<a href="index.php">Etusivulle</a><br/>
	<a href="index.php?lisaa"> Lisää uusi kohde </a>
	<?php	
} else if ($_REQUEST["lisaa"]) {

	//kappalejako kuvaukseen
	$kuvaus = str_replace(chr(13),"<p/>",$_REQUEST["kuvaus"]); ?>
	
	<div class="link"><a href="index.php">Takaisin</a></div>
	
	<p class="list2 title">Lisää kohde seuraavin tiedoin:</p>
	<table class="list2">
	<tr>
			<form method="post" action="index.php">
		<td class="title"> Kohteen nimi: </td>
		<td class="text"><input type="text" name="maalaus_nimi" value="<?php print $_REQUEST["maalaus_nimi"]?>"></td>
	</tr>
	<tr>
		<td class="title"> Paikkakunta: </td>
		<td class="text"><input type="text" name="paikkakunta" value="<?php print $_REQUEST["paikkakunta"]?>" /></td>
	</tr>
	<tr>
		<td class="title"> Kuvaus: </td>
		<td class="text"><textarea name="kuvaus" cols="40" rows="8"><?php print $_REQUEST["kuvaus"]?></textarea></td>
	</tr>
	<tr>
		<td class="title"> Peruskartta: </td>
		<td class="text"><input type="text" name="peruskartta" value="<?php print $_REQUEST["peruskartta"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> N: </td>
		<td class="text"><input type="text" name="N" value="<?php print $_REQUEST["N"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> E: </td>
		<td class="text"><input type="text" name="E" value="<?php print $_REQUEST["E"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> Karttanimi: </td>
		<td class="text"><input type="text" name="karttanimi" value="<?php print $_REQUEST["karttanimi"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> x: </td>
		<td class="text"><input type="text" name="x" value="<?php print $_REQUEST["x"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> y: </td>
		<td class="text"><input type="text" name="y" value="<?php print $_REQUEST["y"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> p: </td>
		<td class="text"><input type="text" name="p" value="<?php print $_REQUEST["p"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> i: </td>
		<td class="text"><input type="text" name="i" value="<?php print $_REQUEST["i"]?>"/></td>
	</tr>
	<tr>
		<td class="title"> Päävesistöalue: </td>
		<td class="text"> <input type="text" name="paavesistoalue" value="<?php print $_REQUEST["paavesistoalue"]?>"/></td>
	</tr>
	<tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="lisaa_kohde" value="Lisää kohde" /></td>
	</tr>
			</form>
	</table>
	<?php
	}  else { ?>
	
	<div class="link"><a href="index.php">Takaisin</a></div>
		
<table class="list2">
	<tr>
			<form method="post" action="index.php">
		<td class="title"> Kohteen nimi: </td>
		<td class="text"><input type="text" name="maalaus_nimi"/></td>
	</tr>
	<tr>
		<td class="title"> Paikkakunta: </td>
		<td class="text"><input type="text" name="paikkakunta"/></td>
	</tr>
	<tr>
		<td class="title"> Kuvaus: </td>
		<td class="text"><textarea name="kuvaus" cols="40" rows="6"></textarea></td>
	</tr>
	<tr>
		<td class="title"> Peruskartta: </td>
		<td class="text"><input type="text" name="peruskartta"/></td>
	</tr>
	<tr>
		<td class="title"> Karttanimi: </td>
		<td class="text"><input type="text" name="karttanimi"/></td>
	</tr>
	<tr>
		<td class="title"> N: </td>
		<td class="text"><input type="text" name="N"/></td>
	</tr>
	<tr>
		<td class="title"> E: </td>
		<td class="text"><input type="text" name="E"/></td>
	</tr>
	<tr>
		<td class="title"> x: </td>
		<td class="text"><input type="text" name="x"/></td>
	</tr>
	<tr>
		<td class="title"> y: </td>
		<td class="text"><input type="text" name="y"/></td>
	</tr>
	<tr>
		<td class="title"> p: </td>
		<td class="text"><input type="text" name="p"/></td>
	</tr>
	<tr>
		<td class="title"> i: </td>
		<td class="text"><input type="text" name="i"/></td>
	</tr>
	<tr>
		<td class="title"> Päävesistöalue: </td>
		<td class="text"> <input type="text" name="paavesistoalue"/></td>
	</tr>
	<tr>
		<td class="text">&nbsp;</td>
		<td class="text"><input type="submit" class="button" name="lisaa" value="Lisää tiedot" /></td>
	</tr>
			</form>
	</table>

<?php } ?>

<?php
include("../includes/db_close.php");
?>