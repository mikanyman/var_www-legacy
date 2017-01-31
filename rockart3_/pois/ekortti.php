<?php
include ("includes/page_header.php");
include ("includes/db_open.php");
?>
            <div class="divMenu">
                <!-- Tähän väliin alalinkit -->

            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">

    <!-- Sisältö tänne -->
<div class="divMainSisalto">
    <p class="pSisalto">
        <form method="post" action="ekortti2.php">
            <table class="tableLomake1">
                <tr>
                        <td>Valitse kortti:*</td>
                </tr>
     <?php
     $apu = '0';

	$sql_lause = "SELECT * FROM kuvat WHERE sivu_id=4 ORDER BY id";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                    if($tulosjoukko == "." || $tulosjoukko == "..") {
                        continue;
                    }
                    if ($apu == '0') {echo "<tr>";}
                    if ($apu == '2') {echo "<tr>";}
                    if ($apu == '4') {echo "<tr>";}
                                    ?>
                        <td class="td3">
                        <?php
                            print (($tulosjoukko["kuva_nimi"])."<br/>");
                            print ("<img src='kortti_mat/".($tulosjoukko["tiedosto"])."' alt='pkortti_".$apu."' /><br/>");
                            print (($tulosjoukko["kuvanottajan_nimi"])."<br/><br/>"); ?>

                        Kortti <?php print $apu + 1; ?>: <input type="radio" name="kortti" value="<?php print $apu + 1; ?>">
</td>
<?php
$apu = $apu + 1;
} //lopettaa while
?></tr><?php
}//if
?>
                    <tr>
                        <td class="td3">&nbsp;</td>
                        <td class="td3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="td3">Vastaanottajan osoite:*</td>
                        <td class="td3"><input type="text" name="vastaanottaja" size="44"></td>
                    </tr>
                    <tr>
                        <td class="td3">Nimesi:*</td>
                        <td><input type="text" name="nimi" size="44"></td>
                    </tr>
                    <tr>
                        <td class="td3">S&auml;hk&ouml;postiosoitteesi:*</td>
                        <td class="td3"><input type="text" name="sahkopostiosoite" size="44"></td>
                    </tr>
                    <tr>
                        <td class="td3">Viesti:*</td>
                        <td class="td3"></td>
                    </tr>
            </table>
            <table class="tableLomake1">
                    <tr>
                        <td class="td3"><textarea rows="5" cols="92" name="viesti"></textarea></td>
                    </tr>
                    <tr>
                        <td>Pakolliset kent&auml;t ovat merkitty * - merkill&auml;.<br/><br/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="laheta" value="L&auml;het&auml;">
                            <input type="reset" name="tyhjenna" value="Tyhjenn&auml;">
                        </td>
                    </tr>
            </table>
        </form>
    </p>
</div>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>