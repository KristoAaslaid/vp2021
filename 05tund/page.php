<?php
	require_once("fnc_user.php");
    $author_name = "Kristo Aaslaid"; // https://www.php.net/manual/en/features.commandline.options.php
	
	//vaatan, mida POST meetodil saadeti
	//var_dump($_POST);
	
	$today_html = null;
	$today_adjective_error = null;
	$todays_adjective = null;
	//kontrollin, kas klikiti submit
	if(isset($_POST["submit_todays_adjective"])){
		//echo "Klikiti nuppu";
		if(!empty($_POST["todays_adjective_input"])){
		$today_html = "<p>Tänane päev on ".$_POST["todays_adjective_input"].".</p>";
		$todays_adjective = $_POST["todays_adjective_input"];
		} else {
			$today_adjective_error = "Palun kirjutage tänase kohta omadussõna";
		}
	}
	
	//sisse logimise ...
	if(isset($_POST["login_submit"])){
		$notice = sign_in($_POST["email_input"], $_POST["password_input"]);
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
	<input type="email" name="email_input" placeholder="kasutajatunnus ehk e-post">
	<input type="password" name="password_input" placeholder="salasõna">
	<input type="submit" name="login_submit" value="Logi sisse">
	<hr>
</body>
</html>