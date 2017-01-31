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
                    <li class="liMenu2"><a class="aMenu" href="toimintakertomukset.php"><?php while ($tulosjoukko13 = mysql_fetch_array($kysely13)) { if ($tulosjoukko13["id"] == 13) { print (($tulosjoukko13["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu2"><a class="aMenu" href="jasenhakulomake.php"><?php while ($tulosjoukko14 = mysql_fetch_array($kysely14)) { if ($tulosjoukko14["id"] == 14) { print (($tulosjoukko14["sivu_nimi"])); } } ?></a></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- T&auml;h&auml;n v&auml;liin yl&auml;kuva tekstiin -->
                <!-- Kuva l&ouml;ytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto2">
    <p class="pSisalto">
    <?php
$posti = array
  (
  etunimi=>$_POST['etunimi'],
  sukunimi=>$_POST['sukunimi'],
  pp=>$_POST['pp'],
  kk=>$_POST['kk'],
  vvvv=>$_POST['vvvv'],
  osoite=>$_POST['osoite'],
  postinumero=>$_POST['postinumero'],
  postitoimipaikka=>$_POST['postitoimipaikka']
  );

foreach ($posti as $arvo)
{
  if (empty($arvo))
  {
  die("<p class='pSisalto3'> Et antanut kaikkia tarvittavia tietoja! Tarkasta t&auml;hdell&auml; (*) merkityt kent&auml;t.<br/> <a class='aUnderP' href='jasenhakulomake.php'>Takaisin lomakkeeseen!</a> </p>
    </div><!-- lopettaa divSisalto -->
    <div class='divFooter'>
            <br/> <br/> <br/>
            <b>Suomen muinaistaideseura</b>
    </div>
</div>
    ");
  }//if
}//foreach

//$to = "aurahelena.karjalainen@edu.hel.fi"; //Tähän kohtaan osoite minne lähetetään, lopullinen
$to = "satuhenna@gmail.com, satu1987@luukku.com"; //Testausta varten
$ilmoitus_pvm = date("j.n.Y H:i", time());
$subject = "Suomen muinaistaideseura ry, Jäsen hakemus\n";
$message = "\nHakemus jätetty: ".$ilmoitus_pvm."
\nTIEDOT:
Etunimi: ".$_POST['etunimi']."
Sukunimi: ".$_POST['sukunimi']."
Syntym&auml;aika: ".$_POST['pp']."/".$_POST['kk']."/".$_POST['vvvv']."
Osoite: ".$_POST['osoite']."
Postinumero: ".$_POST['postinumero']."
Postitoimipaikka: ".$_POST['postitoimipaikka']."
Puhelinnumero: ".$_POST['puhelin']."
Matkapuhelin: ".$_POST['matkapuhelin']."
Sähköposti: ".$_POST['sahkoposti']."
Kiinnostus: ".$_POST['kiinnostus']."
Toivomukset: ".$_POST['toivomukset']."";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/plain;charset=iso-8859-1" . "\r\n";

//mail ($to, $subject, $message, $headers);
?>
<p class="pSisalto3"> <?php echo "Kiitos! Hakemuksesi on l&auml;hetetty eteenp&auml;in.<br/>";
                                       echo "<br/>Annetut tiedot olivat: ";
                                       echo "<br/>Nimi: ".$_REQUEST["etunimi"]." ".$_REQUEST["sukunimi"];
                                       echo "<br/>Syntym&auml;aika: ".$_REQUEST["pp"]."/".$_REQUEST["kk"]."/".$_REQUEST["vvvv"];
                                       echo "<br/>Osoite: ".$_REQUEST["osoite"];
                                       echo $_REQUEST["postinumero"]." ".$_REQUEST["postitoimipaikka"];
                                       if ($_REQUEST["puhelin"] !=null) {
                                        echo "<br/>Puhelin: ".(($_REQUEST["puhelin"]));
                                       }//lopettaa if
                                       if ($_REQUEST["matkapuhelin"] !=null) {
                                        echo "<br/>Matkapuhelin: ".(($_REQUEST["matkapuhelin"]));
                                       }//lopettaa if
                                       if ($_REQUEST["sahkoposti"] !=null) {
                                        echo "<br/>S&auml;hk&ouml;posti: ".(($_REQUEST["sahkoposti"]));
                                       }//lopettaa if
                                       if ($_REQUEST["kiinnostus"] !=null) {
                                        echo "<br/>Kiinnostus: ".(($_REQUEST["kiinnostus"]));
                                       }//lopettaa if
                                       if ($_REQUEST["toivomukset"] !=null) {
                                        echo "<br/>Mahdolliset toivomukset seuran toiminnan kehitt&auml;misest&auml; ym.: ".(($_REQUEST["toivomukset"]));
                                       }//lopettaa if
                        ?>
</p>

<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>