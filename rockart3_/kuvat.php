<?php
include ("includes/page_header.php");
include ("includes/db_open.php");

$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely15 = mysql_query($sql_lause_sivu);
	$kysely16 = mysql_query($sql_lause_sivu);
	$kysely17 = mysql_query($sql_lause_sivu);
?>
            <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><b><?php while ($tulosjoukko15 = mysql_fetch_array($kysely15)) { if ($tulosjoukko15["id"] == 15) { print (($tulosjoukko15["sivu_nimi"])); } } ?></b></li>
                    <li class="liMenu2"><a class="aMenu" href="seuran_matkakertomukset.php"><?php while ($tulosjoukko16 = mysql_fetch_array($kysely16)) { if ($tulosjoukko16["id"] == 16) { print (($tulosjoukko16["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><a class="aMenu" href="jasenten_matkakertomukset.php"><?php while ($tulosjoukko17 = mysql_fetch_array($kysely17)) { if ($tulosjoukko17["id"] == 17) { print (($tulosjoukko17["sivu_nimi"])); } } ?></a></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
    <div class="divMainSisalto">
            <h3>Kuvat</h3>
<table class="tableKuvat1">
<?php
$apu = '0';
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM kuvat WHERE sivu_id=1";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                    if($tulosjoukko == "." || $tulosjoukko == "..") {
                        continue;
                    }
                    if ($apu == '0') {echo "<tr>";}
                    if ($apu == '4') {echo "<tr>";}
                    if ($apu == '8') {echo "<tr>";}
                    if ($apu == '12') {echo "<tr>";}
                    if ($apu == '16') {echo "<tr>";}
                    if ($apu == '20') {echo "<tr>";}
                    if ($apu == '24') {echo "<tr>";}
                                    ?>
                    <td class="td4">
                        <?php
                            print ("<b>".($tulosjoukko["kuva_nimi"])."</b><br/>");
                            print ("<a target='blank' href='kuvat_mat/".($tulosjoukko["kuva"])."'><img src='kuvat_thumbs/".($tulosjoukko["kuva"])."' alt='kuva_".$apu."' /></a><br/>");
                            print (($tulosjoukko["kuvanottajan_nimi"])."<br/>");
                            print (($tulosjoukko["lisatieto"])."<br/><br/>"); ?>
</td>
<?php
$apu = $apu + 1;
} //lopettaa while
?></tr></table><?php
}//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>
</div>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>