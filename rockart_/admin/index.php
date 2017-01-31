<?php
include("init.php");
include("../includes/page_header.php");
?>

<div class="navi">
	<?php include("../includes/navi_admin.php");?>
</div>
<?php if (isset($_REQUEST["val"])) {

		if ($_REQUEST["val"] == 1){
			include("add.php");
		} //if
		
	} else if (isset($_REQUEST["lisaa"]) || (isset($_REQUEST["lisaa_kohde"]))){
		include("add.php");	
	} else if (isset($_REQUEST["lisaa_kuva"]) || isset($_REQUEST["kuva"])){
		include("image.php");
	} else if (isset($_REQUEST["edit"]) || isset($_REQUEST["muokkaa"]) || isset($_REQUEST["koordinaatit_kartalta"])) {
		include("edit.php");
	} else if (isset($_REQUEST["remove"]) || isset($_REQUEST["poista"])) {
		include("remove.php");
	} else if (isset($_REQUEST["kuva_id"]) || isset($_REQUEST["poista_kuva"])){
		include("remove_image.php");
	} else if (isset($_REQUEST["pdf"]) || isset($_REQUEST["lisaa_pdf"])){
		include("add_pdf.php");
	} else {
	?> 
	<a href="index.php?val=1">Lis‰‰ uusi kohde</a><br/><br/>
	<?php
		include("a_list.php");
	 }?>
	
<?php
include("../includes/page_footer.php");
?>