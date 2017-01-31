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
                    <li class="liMenu2"><b><?php while ($tulosjoukko12 = mysql_fetch_array($kysely12)) { if ($tulosjoukko12["id"] == 12) { print (($tulosjoukko12["sivu_nimi"])); } } ?></b></li>
                    <li class="liMenu2"><a class="aMenu" href="toimintakertomukset.php"><?php while ($tulosjoukko13 = mysql_fetch_array($kysely13)) { if ($tulosjoukko13["id"] == 13) { print (($tulosjoukko13["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><a class="aMenu" href="jasenhakulomake.php"><?php while ($tulosjoukko14 = mysql_fetch_array($kysely14)) { if ($tulosjoukko14["id"] == 14) { print (($tulosjoukko14["sivu_nimi"])); } } ?></a></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
    <div class="divMainSisalto">

<?php
	//haetaan seura/säännöt sivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=2";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    ?>

			<h3><?php print (($tulosjoukko["otsikko"])); ?></h3>
			<?php print (($tulosjoukko["sisalto"])."<br/><br/>"); ?>

                        <?php
                        if ($tulosjoukko["pdf"] !=null) { ?>
                        <a target="blank" class="apdf" href="yleiset_mat/<?php print (($tulosjoukko["pdf"])); ?>">
                            <?php
                            if ($tulosjoukko["pdf_otsikko"] !=null) { ?>
                                    <h4><?php print (($tulosjoukko["pdf_otsikko"])); ?></h4>
                            <?php
                            }//lopettaa if
                            ?>
                        </a>
                        <?php
                        }//lopettaa if
                } //lopettaa while
}//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>
</div>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>