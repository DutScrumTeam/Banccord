<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Se connecter</title>
	<?php include("class/head.inc.php"); ?>
</head>
<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">

				<h1 class="centered">Se connecter</h1>
				<form action="connect.php" method="post">

					<div class="form-group">
						<label for="pseudo">Nom d'utilisateur</label>
						<input type="password" class="form-control" name="pseudo" id="pseudo" placeholder="Votre nom d'utilisateur" required>
					</div>
					
					<div class="form-group">
						<label for="mdp">Mot de passe</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe" required>
					</div>
					
					<button type="submit" class="btn btn-primary">Nouveau compte</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>