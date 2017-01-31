<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META NAME="AUTHOR" CONTENT="Satu Kuosmanen">
        <title>Suomen muinaistaideseura</title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css" >
    </head>
    <body>
<?php
include ("../includes/db_open.php");
//haetaan sivulle halutut tekstit ja järjestetään ne id:n mukaan
	$sql_lause_sivu = "SELECT * FROM sivut";
	$kysely9 = mysql_query($sql_lause_sivu);
	$kysely11 = mysql_query($sql_lause_sivu);
        $kysely22 = mysql_query($sql_lause_sivu);
?>
        <div class="divPage">
            <div class="divHeader">
                <!-- Tähän väliin logo sekä mahdolliset ylälinkit -->
                <!-- Logo löytyy style.css -->
                <a class="aTop" href="../yhteystiedot.php"><?php while ($tulosjoukko9 = mysql_fetch_array($kysely9)) { if ($tulosjoukko9["id"] == 9) { print (($tulosjoukko9["sivu_nimi"])); } } ?></a> &nbsp;&nbsp;&nbsp;
                <a class="aTop" href="../index.php"><?php while ($tulosjoukko11 = mysql_fetch_array($kysely11)) { if ($tulosjoukko11["id"] == 11) { print (($tulosjoukko11["sivu_nimi"])); } } ?></a> &nbsp;&nbsp;&nbsp;
            </div><!-- lopettaa divHeader -->
            <div class="divCenter">
                <!-- Tähän väliin Rockart banner kuva -->
                <!-- Kuva löytyy style.css -->
            </div><!-- lopettaa divCenter -->

            <div class="divMainMenu">
            <ul class="ulMenu">
                    <li class="liMenu"><a class="aMenu" href="frontpage.php"><?php while ($tulosjoukko22 = mysql_fetch_array($kysely22)) { if ($tulosjoukko22["id"] == 22) { print (($tulosjoukko22["sivu_nimi"])); } } ?></a></li>
                    <!--<li class="liMenu"><a href="seura.php">Seura</a></li>
                    <li class="liMenu"><a href="ajankohtaista.php">Ajankohtaista</a></li>
                    <li class="liMenu"><a href="kuvagalleria.php">Kuvagalleria</a></li>
                    <li class="liMenu"><a href="tutkimus.php">Tutkimus</a></li>
                    <li class="liMenu"><a href="myyntipiste.php">Myyntipiste</a></li>
                    <li class="liMenu"><a href="linkit.php">Linkit ja Julkaisut</a></li>
                    <li class="liMenu"><a href="#" target="blank">Kalliomaalaukset</a></li>-->
                </ul>
            </div><!-- lopettaa divMainMenu -->