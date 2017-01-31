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
                    <li class="liMenu2"><b><?php while ($tulosjoukko14 = mysql_fetch_array($kysely14)) { if ($tulosjoukko14["id"] == 14) { print (($tulosjoukko14["sivu_nimi"])); } } ?></b></li>
                </ul>
            </div><!-- loepttaa divMenu -->

            <div class="divTop_sisalto">
                <!-- T&auml;h&auml;n v&auml;liin yl&auml;kuva tekstiin -->
                <!-- Kuva l&ouml;ytyy style.css -->
            </div><!-- lopettaa divTop_sisalto -->

<div class="divSisalto">
    <!-- Sisältö tänne -->
    <h3 class="h3Tyyli">Suomen muinaistaideseura ry, Finlands fornkonsts&auml;llskap rf</h3>
    <div class="divMainSisalto">

    <?php
        //haetaan etusivulle haluttu teksti
	$sql_lause = "SELECT * FROM yleiset WHERE sivu_id=7 AND id=2";
	if (mysql_num_rows(mysql_query($sql_lause)) > 0) {
	$kysely = mysql_query($sql_lause);
		while ($tulosjoukko = mysql_fetch_array($kysely,MYSQL_ASSOC)) {

                            print (($tulosjoukko["sisalto"]));

                } //lopettaa while
        }//if
    ?>
    </div>
    <br/><br/>

            <form method="post" action="jasenhakulomake2.php">
                <table class="tableLomake">
                    <tr>
                        <td class="td1">Sukunimi:*</td>
                        <td class="td2"><input type="text" name="sukunimi" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Etunimi:*</td>
                        <td class="td2"><input type="text" name="etunimi" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Syntym&auml;aika:*</td>
                        <td><select name="pp">
                            <option value="">P&auml;iv&auml;</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select name="kk">
                            <option value="">Kuukausi</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <?php
                        //Luodaan automaattinen vuosilista
                        $currentYear = date("Y");
                        $years = range ($currentYear, 1900);
                        echo "<select name='vvvv'>";
                        echo "<option value='' selected>Vuosi</option>";
                        foreach ($years as $value) {
                            echo "<option value=\"$value\">$value</option>\n";
                        } //foreach
                        echo '</select>';
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td1">Osoite:*</td>
                        <td class="td2"><input type="text" name="osoite" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Postinumero:*</td>
                        <td class="td2"><input type="text" name="postinumero" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Postitoimipaikka:*</td>
                        <td class="td2"><input type="text" name="postitoimipaikka" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Puhelin:</td>
                        <td class="td2"><input type="text" name="puhelin" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">Matkapuhelin:</td>
                        <td class="td2"><input type="text" name="matkapuhelin" size="29" /></td>
                    </tr>
                    <tr>
                        <td class="td1">S&auml;hk&ouml;posti:</td>
                        <td class="td2"><input type="text" name="sahkoposti" size="29" /></td>
                    </tr>
                    </table>
                    <br/>
                    <table class="tableLomake">
                    <tr>
                        <td>Pakolliset kent&auml;t ovat merkitty * - merkill&auml;.<br/><br/></td>
                    </tr>
                    <tr><td>
                        Olemme kiinnostuneita tietm&auml;&auml;n muinaistaiteen kiinnostuksen kohteistasi
                        (kivi-, pronssi-, rautakausi, kalliotaide, luolataide, piirrokset, maalaukset,
                        koreografia, musiikki, esineet, korut, maantieteellinen alue, opetus, popularisointi,
                        tutkimuksellisuus, kaupallisuus ym.)
                    </td></tr>

                    <tr>
                        <td class="td1">Kiinnostus: </td>
                    </tr>
                    <tr>
                        <td><textarea rows="10" cols="98" name="kiinnostus"></textarea></td>
                    </tr>
                    <tr>
                        <td class="td2">Mahdolliset toivomukset seuran toiminnan kehitt&auml;misest&auml; ym.:</td>
                    </tr>
                    <tr>
                        <td><textarea rows="10" cols="98" name="toivomukset"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="laheta" value="L&auml;het&auml;">
                            <input type="reset" name="tyhjenna" value="Tyhjenn&auml;">
                        </td>
                    </tr>
                </table>
            </form>
<?php
include ("includes/db_close.php");
include ("includes/page_footer.php");
?>