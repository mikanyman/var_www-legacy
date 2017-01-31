<?php
include ("includes/page_header.php");
include ("includes/db_open.php");

$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely18 = mysql_query($sql_lause_sivu);
	$kysely19 = mysql_query($sql_lause_sivu);
?>

            <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><b><?php while ($tulosjoukko18 = mysql_fetch_array($kysely18)) { if ($tulosjoukko18["id"] == 18) { print (($tulosjoukko18["sivu_nimi"])); } } ?></b></li>
                    <li class="liMenu2"><a class="aMenu" href="seminaariluennot.php"><?php while ($tulosjoukko19 = mysql_fetch_array($kysely19)) { if ($tulosjoukko19["id"] == 19) { print (($tulosjoukko19["sivu_nimi"])); } } ?></a></li>
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
	//haetaan tutkimus sivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=4";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                        if ($tulosjoukko["otsikko"] !=null) {
                        ?>
			<b><?php print (($tulosjoukko["otsikko"])); ?></b><?php
                            if ($tulosjoukko["sisalto"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["sisalto"])."<br/><br/>"); ?>
                            <?php
                                }//lopettaa if
                        }//lopettaa if

                        if ($tulosjoukko["pdf"] !=null) { ?>
                        <h4><a target="blank" class="apdf" href="yleiset_mat/<?php print (($tulosjoukko["pdf"])); ?>">
                            <?php
                            if ($tulosjoukko["pdf_otsikko"] !=null) { ?>
                                    <?php print (($tulosjoukko["pdf_otsikko"])); ?>
                            <?php
                            }//lopettaa if
                            ?>
                        </a></h4>
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