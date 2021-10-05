<?php
	require_once("fnc_user.php");
    $author_name = "Kristo Aaslaid"; // https://www.php.net/manual/en/features.commandline.options.php
	//vaatan, mida POST meetodil saadeti
	//var_dump($_POST);
	
	$email_error = null;
    $password_error = null;
	
	//sisse logimise ...
	if(isset($_POST["login_submit"])){
		$notice = sign_in($_POST["email_input"], $_POST["password_input"]);
	}
	if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST["login_submit"])){
			//kontrollime sisestusi
			if(isset($_POST["email_input"]) and !empty($_POST["email_input"])){
				$email = validate(filter_var($_POST["email_input"], FILTER_VALIDATE_EMAIL));
				if(empty($email)){
					$email_error = "Palun sisesta oma e-post!";
				}
			} else {
				$email_error = "Palun sisesta oma e-post!";
			}
			if(isset($_POST["password_input"]) and !empty($_POST["password_input"])){
				//string length
				if(strlen($_POST["password_input"]) < 8){
					$password_error = "Salasõna on liiga lühike, lol.";
				}
			} else {
				$password_error = "Palun sisesta salasõna!";
			}
		}
	}
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
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikoolis Digitehnoloogiate instituudis
	</a>.</p>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="email" name="email_input" placeholder="kasutajatunnus ehk e-post"><span><?php echo $email_error; ?></span>
	<input type="password" name="password_input" placeholder="salasõna"><span><?php echo $password_error; ?></span>
	<input type="submit" name="login_submit" value="Logi sisse">
	<hr>
</body>
</html>