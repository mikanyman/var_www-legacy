<?php
// Tallennetaan tietokannasta XML
$dom = new DOMDocument("1.0");
$dom->encoding="ISO-8859-1";
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

include("../includes/db_open.php");

$query = ("SELECT * FROM maalaukset;");
$result = mysql_query($query);
if (!$result) {
  die("Haku epäonnistui: " . mysql_error());
}
include("../includes/etrs_tm35fin_to_euref_fin.php");
header("Content-type: text/xml");
while ($row = mysql_fetch_array($result)){

   $NE = explode("," , MuunnaKoordinaatit($row["E"], $row["N"]));
	
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", utf8_encode($row['maalaus_id']));
  $newnode->setAttribute("nimi", utf8_encode($row['maalaus_nimi']));
  $newnode->setAttribute("paikkakunta", utf8_encode($row['paikkakunta']));
  
  if ($row['lat'] == null && $row['lng'] == null) {
	  $newnode->setAttribute("lat", utf8_encode($NE[0]));
	  $newnode->setAttribute("lng", utf8_encode($NE[1]));
  } else {
	  $newnode->setAttribute("lat", utf8_encode($row['lat']));
	  $newnode->setAttribute("lng", utf8_encode($row['lng']));
  } //if
  
  $newnode->setAttribute("kuvaus", utf8_encode ($row['kuvaus']));
} //while

print $dom->saveXML();

include("../includes/db_close.php");
?>