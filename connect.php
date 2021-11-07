<!DOCTYPE html>
<html lang="en">
<head>
	<title>Document</title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-6">

			<h1 class="centered">Créer un compte</h1>
			<form>
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
					<label for="raison-sociale">Nom de société (raison sociale)</label>
					<input type="text" class="form-control" name="raison-sociale" id="raison-sociale" placeholder="Raison sociale" required>
				</div>
				
				<div class="form-group">
					<label for="siren">Numéro de Siren</label>
					<input type="number" class="form-control" name="siren" id="siren" placeholder="012 345 678 09876" required>
				</div>
				
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
				</div>
				
				<div class="form-group">
					<label for="mdp-confirm">Confirmer le mot de pass</label>
					<input type="password" class="form-control" name="mdp-confirm" id="mdp-confirm" placeholder="Retapez votre mot de passe ici" required>
				</div>
				
				<button type="submit" class="btn btn-primary">Créer l'espace</button>
			</form>

		</div>
	</div>
</div>

</body>
</html>