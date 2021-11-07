<!DOCTYPE html>
<html lang="en">
<head>
	<title>Banccord | Nouveau compte</title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">

				<h1 class="centered">Créer un compte</h1>
				<form action="new-client.php" method="post">
					<div class="form-group">
						<label for="exampleFormControlSelect1">Type du compte</label>
						<select class="form-control" id="exampleFormControlSelect1">
							<option>Client</option>
							<option>Contrôleur de gestion</option>
							<option>Product owner</option>
							<option>Admin</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="mdp">Mot de passe</label>
						<input type="password" class="form-control" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
					</div>
					
					<div class="form-group">
						<label for="mdp-confirm">Confirmer le mot de pass</label>
						<input type="password" class="form-control" name="mdp-confirm" id="mdp-confirm" placeholder="Retapez votre mot de passe ici" required>
					</div>
					
					<button type="submit" class="btn btn-primary">Créer le compte</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>