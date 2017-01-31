<?php
include ("../includes/page_header_english.php");
include ("../includes/db_open.php");
?>

<div class="divMenu">
    <!-- Tähän väliin alalinkit -->

</div><!-- lopettaa divMenu -->

<div class="divTop_sisalto">
    <!-- Tähän väliin yläkuva tekstiin -->
    <!-- Kuva löytyy style.css -->
</div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
    <div class="divMainSisalto">
<?php
	//haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM commons WHERE page_id=1";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                        if ($tulosjoukko["header"] !=null) {
                        ?>
			<h3><?php print (($tulosjoukko["header"])); ?></h3>
                            <?php
                            if ($tulosjoukko["content"] !=null) {
                            ?>
                            <?php print (($tulosjoukko["content"])."<br/><br/>"); ?>
                            <?php
                                }//lopettaa if
                        }//lopettaa if

                        if ($tulosjoukko["pdf"] !=null) { ?>
                        <h4><a target="blank" href="commons_mat/<?php print (($tulosjoukko["pdf"])); ?>">
                            <?php
                            if ($tulosjoukko["pdf_header"] !=null) {
                                print (($tulosjoukko["pdf_header"]));
                            }//lopettaa if
                            ?>
                        </a></h4>
                        <?php
                        }//lopettaa if
                } //lopettaa while
        }//if
 else { ?>
   <p class="pSisalto3"><?php print "Empty page!"; ?> </p>
<?php } //else ?>
</div>
<?php
include ("../includes/db_close.php");
include ("../includes/page_footer.php");
?>