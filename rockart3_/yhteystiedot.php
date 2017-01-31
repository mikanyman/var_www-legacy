<?php
include ("includes/page_header.php");
include ("includes/db_open.php");
?>
<div class="divMenu">

</div><!-- lopettaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <div class="divMainSisalto">
<?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=6";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                        if ($tulosjoukko["otsikko"] !=null) {
                        ?>
			<h3><?php print (($tulosjoukko["otsikko"])); ?></h3>
                            <?php
                            if ($tulosjoukko["sisalto"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["sisalto"])); ?>
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