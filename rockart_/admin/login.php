<?php
include("../includes/db_open.php");

if (isset ($_REQUEST["kirjaudu"])) {

	if ((strlen($_REQUEST["ktunnus"]) > 0) AND (strlen($_REQUEST["salasana"]) > 0)) {
	 	//$passwd=md5($passwd);
		$kysely = mysql_query("SELECT * FROM tunnukset WHERE ktunnus='".$_REQUEST["ktunnus"]."' AND salasana='".$_REQUEST["salasana"]."';");
		//$result = mysql_query($query) or die ("DATABASE ".mysql_error($db));
		//if (!$result) {die ("DATABASE ".mysql_error($db));}

		if (mysql_num_rows($kysely)) {		
			session_start();		
			$_SESSION["kayttajan_tiedot"] = mysql_fetch_array($kysely);		
			header("Location: index.php");
		}
		else {
			$virheteksti="Käyttäjätunnuksesi tai salasanasi ei kelpaa.";
		}
	} 	
	else {
			$virheteksti="Anna käyttäjätunnus ja salasana.";			
	}	//if
} //if


include("../includes/page_header.php");
?>
<div class="login">
	<table>
		<tr>
				 <form method="post" action="login.php">
			<td> Käyttäjätunnus: </td>
			<td><input type="text" size="30" name="ktunnus"/></td>
		</tr>
		<tr>
			<td> Salasana: </td>
			<td><input type="password" size="30" name="salasana"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" class="button" name="kirjaudu" value="Kirjaudu" /></td>
		</tr>
				</form>
	</table>

<?php if (isset($virheteksti)) {
	 print $virheteksti;
	} //if
?>
	
</div>	
<?php	
include("../includes/db_close.php");
include("../includes/page_footer.php");
?>