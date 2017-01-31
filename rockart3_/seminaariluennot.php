<?php
include ("includes/page_header.php");
include ("includes/db_open.php");

$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely18 = mysql_query($sql_lause_sivu);
	$kysely19 = mysql_query($sql_lause_sivu);
?>

            <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><a class="aMenu" href="tutkimus.php"><?php while ($tulosjoukko18 = mysql_fetch_array($kysely18)) { if ($tulosjoukko18["id"] == 18) { print (($tulosjoukko18["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><b><?php while ($tulosjoukko19 = mysql_fetch_array($kysely19)) { if ($tulosjoukko19["id"] == 19) { print (($tulosjoukko19["sivu_nimi"])); } } ?></b></li>
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
	//haetaan semeinaari sivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=5";
        if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    
                        if ($tulosjoukko["otsikko"] !=null) {
                        ?>
			<h3><?php print (($tulosjoukko["otsikko"])); ?></h3>
                            <?php
                            if ($tulosjoukko["sisalto"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["sisalto"])."<br/><br/>"); ?>
                            <?php
                                }//lopettaa if
                        }//lopettaa if

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