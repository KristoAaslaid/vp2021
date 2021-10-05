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
	
	function sign_in($email, $password){
        $notice = null;
        $conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $conn->set_charset("utf8");
        $stmt = $conn->prepare("SELECT id, firstname, lastname, password FROM vpr_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->bind_result($id_from_db, $firstname_from_db, $lastname_from_db, $password_from_db);
        echo $conn->error;
        $stmt->execute();
        if($stmt->fetch()){
            //kasutaja on olemas, kontrollime parooli
            if(password_verify($password, $password_from_db)){
                //ongi õige
                $stmt->close();
                $conn->close();
                header("Location: home.php");
                exit();
            } else {
                $notice = "Kasutajanimi või salasõna oli vale!";
            }
        } else {
            $notice = "Kasutajanimi või salasõna oli vale!";
        }
        
        $stmt->close();
        $conn->close();
        return $notice; 
    }
?>
