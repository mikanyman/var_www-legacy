<?php
include ("includes/page_header.php");
include ("includes/db_open.php");
$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely20 = mysql_query($sql_lause_sivu);
	$kysely21 = mysql_query($sql_lause_sivu);
?>
 <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><a class="aMenu" href="linkit.php"><?php while ($tulosjoukko20 = mysql_fetch_array($kysely20)) { if ($tulosjoukko20["id"] == 20) { print (($tulosjoukko20["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><b><?php while ($tulosjoukko21 = mysql_fetch_array($kysely21)) { if ($tulosjoukko21["id"] == 21) { print (($tulosjoukko21["sivu_nimi"])); } } ?></b></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
            <h3 class="h3Tyyli">Julkaisut</h3>
            <div class="divMainSisalto">
                <?php
        //haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=7 AND id=1";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                            print (($tulosjoukko["sisalto"]));

                } //lopettaa while
        }//if
    ?>
    <br/>

        <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM julkaisut ORDER BY id DESC";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    ?>

			<?php
                        if ($tulosjoukko["otsikko"] !=null) {
                        ?>
			<h3><?php print (($tulosjoukko["otsikko"])); ?></h3>
                            <?php
                            if ($tulosjoukko["sisalto"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["sisalto"])."<br/><br/>"); ?>
                            <?php
                                }//lopettaa if
                            ?>
                        <?php }//lopettaa if
                        ?>
                            <table><tr><td valign="top">
                            <?php
                            if ($tulosjoukko["kuva"] !=null) { ?>
                                    <?php print "<img src='julkaisut_mat/".(($tulosjoukko["kuva"]))."' alt='".(($tulosjoukko["kuva"]))."' />"; ?>
                            <?php
                            }//lopettaa if
                            ?>
                                   </td><td>
                           <?php
                            if ($tulosjoukko["luettelo"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["luettelo"])); ?>
                            <?php
                                }//lopettaa if
                            ?>
                            </td></tr></table>

<?php
} //lopettaa while
}//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>
</div>
<br/>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>