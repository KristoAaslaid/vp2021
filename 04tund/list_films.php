<?php
	require_once("../../../config.php"); 
	//echo $server_host; (kontroll kas said faili juurde)
    $author_name = "Kristo Aaslaid"; // https://www.php.net/manual/en/features.commandline.options.php
	$database = "if21_kristo_aas";
	//loome andmebaasiga ühenduse  mysqli  /  server, kasutaja, parool, andmebaas
	$connection = new mysqli($server_host, $server_user_name, $server_password, $database);
	//valmistan ette SQL päringu: SELECT * FROM film
	$connection->set_charset("utf8");
	$statement = $connection->prepare("SELECT * FROM film");
	echo $connection->error;
	//seon tulemused muutujatega
	$statement->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db,
	$studio_from_db, $director_from_db);
	//täidan käsu
	$film_html = null;
	$statement->execute();
	//võtan kirjeid kuni jätkub
	while($statement->fetch()){
		//<h3>Filmi nimi</h3>
		//<ul>
		//<li>Valmimisaasta: 1976</li>
		//<li>...
		//</ul>
		$film_html .= "\n <h3>" .$title_from_db ."</h3> \n";
		$film_html .= "<ul> \n";
		$film_html .= "<li>Valmimisaasta: " .$year_from_db ."</li> \n";
		$film_html .= "<li>Kestus: " .$duration_from_db ."</li> \n";
		$film_html .= "<li>Žanr: " .$genre_from_db ."</li> \n";
		$film_html .= "<li>Tootja: " .$studio_from_db ."</li> \n";
		$film_html .= "<li>Lavastaja: " .$director_from_db ."</li> \n";
		$film_html .= "</ul> \n";
	}
	//sulgen käsu
	$statement->close();
	//sulgeme andmebaasi ühenduse
	$connection->close();
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