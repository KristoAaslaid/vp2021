<?php
	require_once("../../../config.php");
	require_once("fnc_film.php");
	//echo $server_host; (kontroll kas said faili juurde)
    $author_name = "Kristo Aaslaid"; // https://www.php.net/manual/en/features.commandline.options.php
	$film_html = null;
	$film_html = read_all_films();
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
	<title><?php echo $author_name; ?>, I dunno</title>
</head>
<body>
    <h1><?php echo $author_name; ?>, I dunno</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikoolis Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<!--ekraanivorm-->
	<h2>Eesti filmid</h2>
	<?php echo $film_html; ?>
</body>
</html>