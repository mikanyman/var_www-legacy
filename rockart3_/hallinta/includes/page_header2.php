<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <META NAME="AUTHOR" CONTENT="Satu Kuosmanen">

<!-- TinyMCE / tässä haetaan kirjoitus mahdollisuus-->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		language : "fi", // change language here, vaihda kieli tähän
		mode : "textareas",
		width : "680",
		height : "360",
		theme : "advanced",
		plugins : "",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifyfull",
		theme_advanced_buttons2 : "bullist,numlist,|,link,unlink",
                theme_advanced_buttons3 : "undo,redo,",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
        
        <title>Suomen muinaistaideseura</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css" >
    </head>
    <body>

        <div class="divPage">
            <div class="divHeader">
                <h2>Hallinta yll&auml;pit&auml;j&auml;</h2>
                <!-- Tähän väliin logo sekä mahdolliset ylälinkit -->
                <!-- Logo löytyy style.css -->
                <a class="aTop" href="logout2.php">Kirjaudu ulos</a>
            </div><!-- lopettaa divHeader -->
<div class="divMainMenu">
            <br/>
            <!-- Tähän väliin päävalikko -->
                <ul class="ulMenu">
                    VALIKKO
                    <li class="liMenu"><a class="aUnder" href="etusivu2.php">Etusivu</a></li>
                    <hr/>
                    Suomeksi
                    <li class="liMenu"><a class="aUnder" href="yleiset.php">Yleiset</a></li>
                    <li class="liMenu"><a class="aUnder" href="seura.php">Toimintakertomukset</a></li>
                    <li class="liMenu"><a class="aUnder" href="myyntipiste.php">Myyntipiste</a></li>
                    <li class="liMenu"><a class="aUnder" href="kuvat.php">Kuvat</a></li>
                    <li class="liMenu"><a class="aUnder" href="linkit.php">Linkit</a></li>
                    <li class="liMenu"><a class="aUnder" href="julkaisut.php">Julkaisut</a></li>
                    <hr/>
                    Englanniksi
                    <li class="liMenu"><a class="aUnder" href="commons.php">Commons</a></li>
                    <hr/>
                    Muut:
                    <li class="liMenu"><a class="aUnder" href="menu.php">Menu nimet</a></li>
                    <li class="liMenu"><a class="aUnder" href="muut.php">Muita tietoja</a></li>
                    <br/>
                </ul>
</div><!-- lopettaa divMainMenu -->