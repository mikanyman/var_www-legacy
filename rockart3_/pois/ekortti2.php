<?php
include ("includes/page_header.php");
include ("includes/db_open.php");
?>
<div class="divMenu">
            <!-- Tähän väliin menu -->
</div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- T&auml;h&auml;n v&auml;liin yl&auml;kuva tekstiin -->
                <!-- Kuva l&ouml;ytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto2">
    <p class="pSisalto">
    <?php
    if (isset($_REQUEST["laheta"])) {

	$virhe = false;

	//Tarkastetaan ovatko vaaditut kentät tyhjiä
	if ($_REQUEST["kortti"]=="" || $_REQUEST["vastaanottaja"]=="" || $_REQUEST["nimi"]=="" || $_REQUEST["sahkopostiosoite"]=="" || $_REQUEST["viesti"]=="") {
		$virhe = true;
	} //if

	//Jos ovat tyhjiä, näytetään virheilmoitus
	if($virhe == true) {
    ?>
    <p class="pSisalto3"> <?php echo "Et antanut kaikkia tarvittavia tietoja!<br/> <a class='aUnderP' href='ekortti.php'>Takaisin E-postikorttin l&auml;hett&auml;miseen!</a> ";?> </p>
    <?php
	//Muussa tapauksessa tallennetaan tiedot tietokantaan
	} //if
        else { ?>
    <p class="pSisalto3"> <?php echo "Kiitos!! Kortti nr.".$_REQUEST["kortti"]." on l&auml;hetetty osoitteeseen ".$_REQUEST["vastaanottaja"]."<br/>";
                                echo "Nimesi: ".$_REQUEST["nimi"]."<br/>";
                                echo "S&auml;hk&ouml;postiosoitteesi: ".$_REQUEST["sahkopostiosoite"]."<br/>";
                                echo "Viesti: ".$_REQUEST["viesti"]."<br/>";
                                echo "<br/><a class='aUnderP' href='ekortti.php'>Takaisin E-postikorttin l&auml;hett&auml;miseen!</a>";
        } //else
    }//if
    ?>
    </p>

<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>