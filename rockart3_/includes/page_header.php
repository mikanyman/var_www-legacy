<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <META NAME="AUTHOR" CONTENT="CampusIT Satu Kuosmanen">
		<META NAME="ROBOTS" CONTENT="NONE">
        <title>Suomen muinaistaideseura</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css" >
    </head>
    <body>
<?php
include ("includes/db_open.php");
//haetaan sivulle halutut tekstit ja järjestetään ne id:n mukaan
	$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely1 = mysql_query($sql_lause_sivu);
	$kysely2 = mysql_query($sql_lause_sivu);
	$kysely3 = mysql_query($sql_lause_sivu);
	$kysely4 = mysql_query($sql_lause_sivu);
	$kysely5 = mysql_query($sql_lause_sivu);
	$kysely6 = mysql_query($sql_lause_sivu);
	$kysely7 = mysql_query($sql_lause_sivu);
	$kysely8 = mysql_query($sql_lause_sivu);
	$kysely9 = mysql_query($sql_lause_sivu);
	$kysely10 = mysql_query($sql_lause_sivu);
?>
        <div class="divPage">
            <div class="divHeader">
                <!-- Tähän väliin logo sekä mahdolliset ylälinkit -->
                <!-- Logo löytyy style.css -->
                <a class="aTop" href="yhteystiedot.php"><?php while ($tulosjoukko9 = mysql_fetch_array($kysely9)) { if ($tulosjoukko9["id"] == 9) { print (($tulosjoukko9["sivu_nimi"])); } } ?></a> &nbsp;&nbsp;&nbsp;
                <a class="aTop" href="english/frontpage.php"><?php while ($tulosjoukko10 = mysql_fetch_array($kysely10)) { if ($tulosjoukko10["id"] == 10) { print (($tulosjoukko10["sivu_nimi"])); } } ?></a> &nbsp;&nbsp;&nbsp;
            </div><!-- lopettaa divHeader -->
            <div class="divCenter">
                <!-- Tähän väliin Rockart banner kuva -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divCenter -->

            <div class="divMainMenu">
            <!-- Tähän väliin päävalikko -->
            <ul class="ulMenu">
                    <li class="liMenu"><a class="aMenu" href="index.php"><?php while ($tulosjoukko1 = mysql_fetch_array($kysely1)) { if ($tulosjoukko1["id"] == 1) { print (($tulosjoukko1["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="seura.php"><?php while ($tulosjoukko2 = mysql_fetch_array($kysely2)) { if ($tulosjoukko2["id"] == 2) { print (($tulosjoukko2["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="ajankohtaista.php"><?php while ($tulosjoukko3 = mysql_fetch_array($kysely3)) { if ($tulosjoukko3["id"] == 3) { print (($tulosjoukko3["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="kuvat.php"><?php while ($tulosjoukko4 = mysql_fetch_array($kysely4)) { if ($tulosjoukko4["id"] == 4) { print (($tulosjoukko4["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="tutkimus.php"><?php while ($tulosjoukko5 = mysql_fetch_array($kysely5)) { if ($tulosjoukko5["id"] == 5) { print (($tulosjoukko5["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="myyntipiste.php"><?php while ($tulosjoukko6 = mysql_fetch_array($kysely6)) { if ($tulosjoukko6["id"] == 6) { print (($tulosjoukko6["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="linkit.php"><?php while ($tulosjoukko7 = mysql_fetch_array($kysely7)) { if ($tulosjoukko7["id"] == 7) { print (($tulosjoukko7["sivu_nimi"])); } } ?></a></li>
                    <li class="liMenu"><a class="aMenu" href="../rockart/index.php" target="_blank"><?php while ($tulosjoukko8 = mysql_fetch_array($kysely8)) { if ($tulosjoukko8["id"] == 8) { print (($tulosjoukko8["sivu_nimi"])); } } ?></a></li>
                </ul>

            </div><!-- lopettaa divMainMenu -->