<?php

include 'database.php';

$req = $bdd->prepare("SELECT number_adherent, password FROM adherents WHERE number_adherent = :number_adherent AND password = :password");

$number = htmlspecialchars($_POST['number']);
$password = htmlspecialchars($_POST['password']);
$submit = $_POST['submit'];

if ((isset($number)) && (isset($password)) && (isset($submit))) {
	$_SESSION['number'] = $number;
	$_SESSION['password'] = $password;
	$req->execute(array('number' => $number, 'password' => $password));

	$cours = $req->fetch();

	if (!$cours) {
		echo "Utilisateur inconnu !";
	} else {
		$_SESSION['number'] = $cours['number_adherent'];
		$_SESSION['password'] = $cours['password'];
		header("Location: http://localhost/reservation-tennis/index.php");
	}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
</head>
<body>
	<form action="" method="post">
		<label for="number"> Numéro d'adhérent : </label> <input type="number" name="number" id="number">
		<label for="password"> Mot de passe : </label> <input type="password" name="password" id="password">
		<button type="submit" name="submit"> Se connecter </button>
	</form>
</body>
</html>