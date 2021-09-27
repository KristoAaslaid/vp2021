<?php
	require_once("../../../config.php");
	require_once("fnc_film.php");
	//echo $server_host; (kontroll kas said faili juurde)
    $author_name = "Kristo Aaslaid"; // https://www.php.net/manual/en/features.commandline.options.php
	$film_store_notice = null;
	$film_pealkiri_notice = null;
	$film_pealkiri = null;
	$film_genre_notice = null;
	$film_genre = null;
	$film_studio_notice = null;
	$film_studio = null;
	$film_director_notice = null;
	$film_director = null;
	//kas klikiti submit nuppu
	if(isset($_POST["film_submit"])){
		if(!empty($_POST["title_input"]) and !empty($_POST["genre_input"]) 
		and !empty($_POST["studio_input"]) and !empty($_POST["director_input"])){
				$film_store_notice = store_film(validate($_POST["title_input"]), validate($_POST["year_input"]), 
				validate($_POST["duration_input"]), validate($_POST["genre_input"]),
				validate($_POST["studio_input"]), validate($_POST["director_input"]));
		}	else {
				$film_store_notice = "Osa andmeid on puudu!";
				if(empty($_POST["title_input"])){
					$film_pealkiri_notice = "Sa ei sisestanud pealkirja, pardner!";
				}	else {
						$film_pealkiri = $_POST["title_input"];
					}
				if(empty($_POST["genre_input"])){
					$film_genre_notice = "Sa ei sisestanud žanrit, pardner!";
				}	else {
						$film_genre = $_POST["genre_input"];
					}
				if(empty($_POST["studio_input"])){
					$film_studio_notice = "Sa ei sisestanud tootjat, pardner!";
				}	else {
						$film_studio = $_POST["studio_input"];
					}
				if(empty($_POST["director_input"])){
					$film_director_notice = "Sa ei sisestanud lavastajat, pardner!";
				}	else {
						$film_director = $_POST["director_input"];
					}
		}
	}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
	<title><?php echo $author_name; ?>, Filmi lisamine</title>
</head>
<body>
    <h1><?php echo $author_name; ?>, Filmi lisamine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikoolis Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<!--ekraanivorm-->
	<h2>Eesti filmid</h2>
	<form method="POST">
		<label for="title_input">Filmi pealkiri: </label>
		<input type="text" name="title_input" id="title_input" placeholder="pealkiri" value = <?php echo $film_pealkiri; ?>>
		<span>&nbsp;<?php echo $film_pealkiri_notice; ?></span>
		<br>
		<label for="year_input">Valmisaasta: </label>
		<input type="number" name="year_input" id="year_input" value="<?php echo date("Y"); ?>" min="1912">
		<br>
		<label for="duration_input">Kestus minutites: </label>
		<input type="number" name="duration_input" id="duration_input" value="60" min="1">
		<br>
		<label for="genre_input">Filmi žanr: </label>
		<input type="text" name="genre_input" id="genre_input" placeholder="žanr" value = <?php echo $film_genre; ?>>
		<span>&nbsp;<?php echo $film_genre_notice; ?></span>
		<br>
		<label for="studio_input">Filmi tootja: </label>
		<input type="text" name="studio_input" id="studio_input" placeholder="tootja" value = <?php echo $film_studio; ?>>
		<span>&nbsp;<?php echo $film_studio_notice; ?></span>
		<br>
		<label for="director_input">Filmi lavastaja: </label>
		<input type="text" name="director_input" id="director_input" placeholder="lavastaja" value = <?php echo $film_director; ?>>
		<span>&nbsp;<?php echo $film_director_notice; ?></span>
		<br>
		<input type="submit" name="film_submit" value="Salvesta">
	</form>
	<p><?php echo $film_store_notice; ?></p>
</body>
</html>