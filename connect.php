<?php
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
	$pseudo = $_POST['pseudo'];
	$password = $_POST['password'];
	$password = md5($password);
	$type = PdoAccess::checkUser($pseudo, $password);
	if ($type != null) {
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['password'] = $password;
		switch ($type) {
			case 'client':
				header('Location: client-info.php');
				break;
			case 'po':
				header('Location: po-info.php');
				break;
			case 'admin':
				header('Location: admin.php');
				break;
		}
	} else {
		header('Location: connect.php?error=invalid');
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Se connecter</title>
	<?php include("class/head.inc.php"); ?>
	<link rel="stylesheet" href="css/connect.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">

				<h1 class="centered">Se connecter</h1>
				<form action="connect.php" method="post">

					<!-- Champ pseudo -->
					<div class="form-group">
						<label for="pseudo">Nom d'utilisateur</label>
						<input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre nom d'utilisateur" required>
					</div>
					
					<!-- Champ mdp -->
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<div class="password-container">
							<input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe" required>
							<script src="js/eye-password.js"></script>
							<button class="btn-eye" type="button" onclick="switchPasswordView()"></button>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary">Connexion</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>