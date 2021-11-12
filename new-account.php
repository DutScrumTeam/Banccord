<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Nouveau compte</title>
	<?php include("class/head.inc.php"); ?>
    <link rel="stylesheet" href="css/connect.css">
</head>

<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				
				<h1 class="centered">Créer un compte</h1>
				<form action="account.php" method="post">

					<!-- Type du nouveau compte -->
					<div class="form-group">
						<label for="type">Type du compte</label>
						<select class="form-control" id="type" name="type">
							<option>Client</option>
							<option>Contrôleur de gestion</option>
							<option>Product owner</option>
							<option>Admin</option>
						</select>
					</div>
					
					<!-- Pseudo -->
					<div class="form-group">
						<label for="name">Nom d'utilisateur</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nom du nouvel utlisateur" required>
					</div>
					
					<!-- Mdp -->
					<div class="form-group">
						<label for="password">Mot de passe</label>
                        <div class="password-container">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe de l'utilisateur" required>
                            <script src="js/eye-password.js"></script>
                            <button class="btn-eye" type="button" onclick="switchPasswordView()"></button>
                        </div>
                    </div>
                    <?php if ($_GET["error"]=="password"){
                        echo "<div class=\"alert alert-primary\" role=\"alert\">
                        Passwords do not match</div>";
                    }?>
					
					<!-- Confirmation du mdp -->
					<div class="form-group">
						<label for="passwordConfirm">Confirmer le mot de passe</label>
                        <div class="password-container">
                            <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="Retapez le mot de passe" required>
                            <script src="js/eye-password.js"></script>
                            <button class="btn-eye" type="button" onclick='switchPasswordViewName("passwordConfirm")'></button>
                        </div>
                    </div>
					<button type="submit" class="btn btn-primary">Nouveau compte</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>