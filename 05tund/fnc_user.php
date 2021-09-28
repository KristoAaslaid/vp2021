<?php
	$database = "if21_kristo_aas";
	
	function sign_up($firstname, $surname, $email, $gender, $birth_date, $password){	
		$notice = null;
		$connection = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"],
		$GLOBALS["server_password"], $GLOBALS["database"]);
		$connection->set_charset("utf8");
		$statement = $connection->prepare("INSERT INTO vpr_users (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?) ");
		echo $connection->error;
		//krüpteerime salasõna
		$option = ["cost"=>12];
		$pwd_hash = password_hash($password, PASSWORD_BCRYPT, $option);
		$statement->bind_param("sssiss", $firstname, $surname, $birth_date, $gender, $email, $pwd_hash); //järjekord !!!!
		if($statement->execute()){
			$notice = "Uus kasutaja edukalt loodud!";
		} else {
			$notice = "Uue kasutaja loomine ebaõnnestus, lol." .$statement->error;
		}
		$statement->close();
		$connection->close();
		return $notice;
	}
	
	
?>
