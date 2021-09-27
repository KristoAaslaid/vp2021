<?php
	$database = "if21_kristo_aas";

	function read_all_films(){
		//loome andmebaasiga ühenduse  mysqli  /  server, kasutaja, parool, andmebaas
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"],
		$GLOBALS["server_password"], $GLOBALS["database"]);
		$connection->set_charset("utf8");
		//valmistan ette SQL päringu: SELECT * FROM film
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
		return $film_html;
	}
	
	function store_film($title_input, $year_input, $duration_input,
	$genre_input, $studio_input, $director_input){
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"],
		$GLOBALS["server_password"], $GLOBALS["database"]);
		$connection->set_charset("utf8");
		$statement = $connection->prepare("");
		//SQL: INSERT INTO film (pealkiri, aasta, kestus, žanr, tootja, lavastaja) VALUES("Suvi", 1976, 83, "Tallinnfilm", "Arvo Kruusement")
		$statement = $connection->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
		echo $connection->error;
		//seome SQL käsuga päris andmed
		//i - integer, d - decimal, s - string
		$statement->bind_param("siisss", $title_input, $year_input, $duration_input,
		$genre_input, $studio_input, $director_input);
		//käsu täitmine
		$success = null;
		if($statement->execute()){
			$success = "Salvestamine õnnestus!";
		} else {
			$success = "Salvestamisel tekkis viga: " .$statement->error;
		}
		
		$statement->close();
		$connection->close();
		return $success;
	}
	
	function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}	