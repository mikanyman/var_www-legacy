<?php
include ("includes/page_header.php");
include ("includes/db_open.php");

$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely20 = mysql_query($sql_lause_sivu);
	$kysely21 = mysql_query($sql_lause_sivu);
?>
 <div class="divMenu">
                <ul class="ulMenu2">
                    <li class="liMenu2"><b><?php while ($tulosjoukko20 = mysql_fetch_array($kysely20)) { if ($tulosjoukko20["id"] == 20) { print (($tulosjoukko20["sivu_nimi"])); } } ?></b></li>
                    <li class="liMenu2"><a class="aMenu" href="julkaisut.php"><?php while ($tulosjoukko21 = mysql_fetch_array($kysely21)) { if ($tulosjoukko21["id"] == 21) { print (($tulosjoukko21["sivu_nimi"])); } } ?></a></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
    <div class="divMainSisalto">
<h3>Viranomaistahot</h3>
            <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM linkit WHERE otsikko_id=1 ORDER BY linkkiotsikko";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    
                        if ($tulosjoukko["linkkiotsikko"] !=null) {
                        ?>
			<b><?php print (($tulosjoukko["linkkiotsikko"])."<br/>"); ?></b>
                            <?php
                            if ($tulosjoukko["linkki"] !=null) {
                            
                            print ("<a target='blank' class='aUnderP' href='".($tulosjoukko["linkki"])."'>".($tulosjoukko["linkki"])."</a><br/><br/>"); ?>
                            <?php
                            }//lopettaa if
                        }//lopettaa if
                } //lopettaa while
        }//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>

<h3>Verkkojulkaisut</h3>
            <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM linkit WHERE otsikko_id=2 ORDER BY linkkiotsikko";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    
                        if ($tulosjoukko["linkkiotsikko"] !=null) {
                        ?>
			<b><?php print (($tulosjoukko["linkkiotsikko"])."<br/>"); ?></b>
                            <?php
                            if ($tulosjoukko["linkki"] !=null) {

                            print ("<a target='blank' class='aUnderP' href='".($tulosjoukko["linkki"])."'>".($tulosjoukko["linkki"])."</a><br/><br/>"); ?>
                            <?php
                            }//lopettaa if
                        }//lopettaa if
                } //lopettaa while
        }//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>

<h3>Yksityisi&auml; www-sivuja</h3>
            <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM linkit WHERE otsikko_id=3 ORDER BY linkkiotsikko";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    
                        if ($tulosjoukko["linkkiotsikko"] !=null) {
                        ?>
			<b><?php print (($tulosjoukko["linkkiotsikko"])."<br/>"); ?></b>
                            <?php
                            if ($tulosjoukko["linkki"] !=null) {

                            print ("<a target='blank' class='aUnderP' href='".($tulosjoukko["linkki"])."'>".($tulosjoukko["linkki"])."</a><br/><br/>"); ?>
                            <?php
                            }//lopettaa if
                        }//lopettaa if
                } //lopettaa while
        }//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>

<h3>Eri maiden muinaistaidetta</h3>
            <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM linkit WHERE otsikko_id=4 ORDER BY linkkiotsikko";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                                    
                        if ($tulosjoukko["linkkiotsikko"] !=null) {
                        ?>
			<b><?php print (($tulosjoukko["linkkiotsikko"])."<br/>"); ?></b>
                            <?php
                            if ($tulosjoukko["linkki"] !=null) {

                            print ("<a target='blank' class='aUnderP' href='".($tulosjoukko["linkki"])."'>".($tulosjoukko["linkki"])."</a><br/><br/>"); ?>
                            <?php
                            }//lopettaa if
                        }//lopettaa if
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