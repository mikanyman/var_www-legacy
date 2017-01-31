<?php
include("includes/session.php");
include ("includes/db_open.php");
include ("includes/page_header.php");

?>
<div class="divSisalto">
    <p class="pSisalto">
        Ohjeet:<br/><br/>
        <b>Suomekieliset valikot</b><br/>
        Yleiset valikon alla sivuston Etusivu, Seura(s&auml;&auml;nn&ouml;t), Ajankohtaiset, Tutkimus(Tutkimusraportit), Seminaariluennot ja Yhteystiedot sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        Toimintakertomukset valikon alla sivuston Toimintakertomukset sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        Myyntipiste valikon alla sivuston Myyntipiste sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        Kuvat valikon alla sivuston kuvat, seuranmatkakertomukset ja j&auml;sentenmatkakertomukset sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        Linkit valikon alla sivuston Linkit sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        Julkaisut valikon alla sivuston Julkaisut sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        <b>Admin Lis&auml;toiminnot valikko</b><br/>
        K&auml;ytt&auml;j&auml;t valikon alla hallinnointi puolen k&auml;ytt&auml;jien lis&auml;ys, muokkaus ja poisto.<br/><br/>
        <b>Englanninkieliset valikot</b><br/>
        Commons valikon alla sivuston Commons sis&auml;ll&ouml;n lis&auml;ys, muokkaus ja poisto.<br/><br/>
        <b>Muut valikko</b><br/>
        Menu nimet valikon alla sivuston menuvalikkojen muokkaus.<br/><br/>
        Muita tietoja valikon alla sivuston J&auml;sen lomake ja Julkaisut-osioiden ylä tekstien muokkaus.<br/><br/>
    </p>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>
