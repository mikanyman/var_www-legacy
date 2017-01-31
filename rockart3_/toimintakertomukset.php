<?php
include ("includes/page_header.php");
include ("includes/db_open.php");

$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely12 = mysql_query($sql_lause_sivu);
	$kysely13 = mysql_query($sql_lause_sivu);
	$kysely14 = mysql_query($sql_lause_sivu);
?>
            <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><a class="aMenu" href="seura.php"><?php while ($tulosjoukko12 = mysql_fetch_array($kysely12)) { if ($tulosjoukko12["id"] == 12) { print (($tulosjoukko12["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><b><?php while ($tulosjoukko13 = mysql_fetch_array($kysely13)) { if ($tulosjoukko13["id"] == 13) { print (($tulosjoukko13["sivu_nimi"])); } } ?></b></li>
                    <li class="liMenu2"><a class="aMenu" href="jasenhakulomake.php"><?php while ($tulosjoukko14 = mysql_fetch_array($kysely14)) { if ($tulosjoukko14["id"] == 14) { print (($tulosjoukko14["sivu_nimi"])); } } ?></a></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne --><p class="pVuosi">
<?php
	//haetaan tähän vuodet
	$sql_lause = "SELECT * FROM toimintakertomukset ORDER BY vuosi DESC";
	$kysely = mysql_query($sql_lause);

                while ($tulosjoukko = mysql_fetch_array($kysely)) { ?>
                    <a class="aUnderP" href="#<?php print (($tulosjoukko["vuosi"])); ?>"><?php print (($tulosjoukko["vuosi"])); ?></a> |
             <?php
                }//lopettaa while tulosjoukko
                ?></p>
<div class="divMainSisalto">
<?php
                $sql_lause2 = "SELECT * FROM toimintakertomukset ORDER BY vuosi DESC";
                if (mysql_num_rows(mysql_query($sql_lause2)) > 0) {
                $kysely2 = mysql_query($sql_lause2);
		while ($tulosjoukko2 = mysql_fetch_array($kysely2,MYSQL_ASSOC)) {
                                    ?>

			<h3><a name="<?php print (($tulosjoukko2["vuosi"])); ?>"><?php print (($tulosjoukko2["otsikko"])); ?></a></h3>
			<?php print (($tulosjoukko2["sisalto"])."<br/>"); ?>
                        <a class="aUnderP" href="#">Yl&ouml;s</a><br/>

<?php
                } //lopettaa while tulosjoukko2
}//if

else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>
</div>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>