<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name = "author" content = "Satu Kuosmanen" />

<link rel="stylesheet" type="text/css" href="style/style.css" />

<title>ILMOITTAUTUMISLOMAKE</title>

<style type="text/css" media="screen">
    BODY TABLE {
        text-align: left;
}
</style>

</head>
<body>

<div align="center">
<br/>

<table width="400" align="center">
<tr>
<td align="left">
<pre>
<?php
$posti = array
  (
  etunimi=>$_POST['etunimi'],
  sukunimi=>$_POST['sukunimi'],
  puh=>$_POST['puh'],
  email=>$_POST['email'],
  postiosoite=>$_POST['postiosoite'],
  Postinumero=>$_POST['postinumero'],
  Postitoimipaikka=>$_POST['postitoimipaikka']
  );

foreach ($posti as $arvo)
{
  if (empty($arvo))
  {
  die("Kirjoita kaikki pakolliset tiedot!<br/>
       Pakolliset tiedot merkitty * merkill&auml;.<br/>
       <a href='lomake.php'>Takaisin</a>");
  }//if
}//foreach

//$to = "sirpa.nupponen@helsinki.fi, sari.makinen-hankamaki@ekoneum.com";
$to = "satuhenna@gmail.com, satu1987@luukku.com"; //Tähän kohtaan e-mail osoite minne lähetetään
$ilmoitus_pvm = date("j.n.Y H:i", time());
$subject = "Luomuseminaari ilmoittautuminen\n";
$message = "\nIlmoitus jätetty: ".$ilmoitus_pvm."
\nOSALLISTUJAN TIEDOT:
Etunimi: ".$_POST['etunimi']."
Sukunimi: ".$_POST['sukunimi']."
Tehtävä;/ammatti: ".$_POST['ammatti']."
Työpaikka: ".$_POST['tyopaikka1']."
Puhelinnumero: ".$_POST['puh']."
Sähköposti: ".$_POST['email']."
\nLASKUTUSOSOITE:
Työpaikka (jos eri kuin edellä;): ".$_POST['tyopaikka2']."
Postiosoite: ".$_POST['postiosoite']."
Postinumero: ".$_POST['postinumero']."
Postitoimipaikka: ".$_POST['postitoimipaikka']."
Erikoisruokavalio: ".$_POST['erikoisruokavalio']."
\nOSALLISTUMINEN JA HINTA:
Seminaari: ".$_POST['seminaari']."
Kotieläintuotanto: ".$_POST['kotielaintuotanto']."
Peltokasvintuotanto: ".$_POST['peltokasvintuotanto']."
Puutarhatuotanto: ".$_POST['puutarhatuotanto']."
Illanvietto: ".$_POST['illanvietto']."
Näyttely: ".$_POST['nayttely']."";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/plain;charset=iso-8859-1" . "\r\n";

mail ($to, $subject, $message, $headers);

// echo $message;
echo "\n\nKiitos! \n\n<a href='lomake.php'>Takaisin</a>";
?>

</pre>
</td>
</tr>
</table>
</div>

<br/><br/>
</body>
</html>