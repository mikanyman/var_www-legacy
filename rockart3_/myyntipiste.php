<?php
include ("includes/page_header.php");
include ("includes/db_open.php");
?>
<div class="divMenu">
<!-- Tähän väliin alalinkit -->
</div><!-- lopettaa divMenu -->

            <div class="divTop_sisalto">
                <!-- Tähän väliin yläkuva tekstiin -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto"><div class="divMainSisalto">
    <!-- Sisältö tänne -->
    <?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM myyntipiste ORDER BY otsikko_id,id";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {
                        if ($tulosjoukko["otsikko"] !=null) { ?>
			<h3 class="h3"><?php print (($tulosjoukko["otsikko"])); ?></h3><?php
                        }//lopettaa if
                        if ($tulosjoukko["sisalto"] !=null) { ?>
                        <?php print (($tulosjoukko["sisalto"])."<br/><br/>"); ?><?php
                        }//lopettaa if
                        if ($tulosjoukko["kuva"] !=null) {
                            print "<img src='myyntipiste_mat/".(($tulosjoukko["kuva"]))."' alt='".(($tulosjoukko["kuva"]))."' />";?>&nbsp;<?php
                        }//if
                        if ($tulosjoukko["pdf"] !=null) { ?>
                        <h4><a target="blank" class="apdf" href="myyntipiste_mat/<?php print (($tulosjoukko["pdf"])); ?>">
                            <?php
                            if ($tulosjoukko["pdf_otsikko"] !=null) { ?>
                                    <?php print (($tulosjoukko["pdf_otsikko"])); ?>
                            <?php
                            }//lopettaa if
                            ?>
                        </a></h4>
                        <?php
                        }//lopettaa if
//print ($tulosjoukko["otsikko_id"]+1); //tällä näkee viimeisimmän vapaan otsikko_id:n
} //lopettaa while
        }//if
 else { ?>
   <p class="pSisalto3"><?php print "T&auml;ll&auml; sivulla ei viel&auml; sis&auml;lt&ouml;&auml;."; ?> </p>
<?php } //else ?>
</div><!-- lopettaa divMainSisalto -->
<br/>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>