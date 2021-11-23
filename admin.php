<?php include("class/page-builder.inc.php");
include("class/PdoAccess.php");
?>

<?php
if (isset($_POST['Supprimer'])) {
    $id = $_POST['id'];
    PdoAccess::deleteAccount($id);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Admin</title>
	<?php include("class/head.inc.php"); ?>
  <link rel="stylesheet" href="css/connect.css">
	<script src="js/page-manager.js"></script>
	<script src="js/form-edit.js"></script>
	<script src="js/new-account.js"></script>
</head>

<body>
	<?php
		echoHeader(
			"Admin",
			"Créer un compte", "new-account.php"
		);
	?>

	<div class="container">

		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1 class="div-center-v">Liste des comptes</h1>
			</div>
		</div>
	
		<!-- Champ de recherche -->
		<form action="" method="get">
			<div class="row action-option">

				<!-- Type de recherche -->
				<div class="col-auto">
					<div class="form-group">
						<select class="form-control" name="search-mod" id="search-mod">
							<option 
									value="siren" selected 
									onclick="changeInput('search-value', 'Entrez le numéro de Siren', 'number');">
								Recherche par Siren
							</option>
							<option 
									value="name" 
									onclick="changeInput('search-value', 'Entrez la raison sociale', 'text');">
								Recherche par raison sociale
							</option>
						</select>
					</div>
				</div>

				<!-- Valeur de recherche -->
				<div class="col">
					<div class="form-group">
						<input type="number" class="form-control" id="search-value" name="search-value" placeholder="Entrez le numéro de Siren">
					</div>
				</div>

				<!-- Bouton de confirmation -->
				<div class="col-auto">
					<button class="btn btn-primary div-center-v">Rechercher</button>
				</div>
			</div>
		</form>

		<!-- Tableau des comptes -->
		<table class="table table-striped">
			<?php
				echoTableHead(
					"Siren",
					"Nom de compte",
					"Suppression");
			?>
			<tbody id="table-result">
            <?php
            PdoAccess::adminAccountTable();
            ?>
			</tbody>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>

		<hr>

		<!-- Formulaire de création de compte -->
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				
				<h1 class="centered">Créer un compte</h1>
				<form action="account.php" method="post">

					<!-- Type du nouveau compte -->
					<div class="form-group">
						<label for="type">Type du compte</label>
						<select class="form-control" id="type" name="type" onchange="changeType()">
							<option value="client">Client</option>
							<option value="po">Product owner</option>
							<option value="admin">Admin</option>
						</select>
					</div>
					
					<!-- Pseudo -->
					<div class="form-group">
						<label for="name">Nom d'utilisateur</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nom du nouvel utilisateur" required>
					</div>
					
					<!-- Mdp -->
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe de l'utilisateur" required>
					</div>
					
					<!-- Confirmation du mdp -->
					<div class="form-group">
						<label for="passwordConfirm">Confirmer le mot de passe</label>
						<input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="Retapez le mot de passe" required>
					</div>

					<!-- Nom de société (client uniquement) -->
					<div class="form-group client-only">
						<label for="businessName">Nom de société (raison sociale)</label>
						<input type="text" class="form-control" name="business-name" id="businessName" placeholder="Raison sociale" required>
					</div>
					
					<!-- Numéro de Siren (client uniquement) -->
					<div class="form-group client-only">
						<label for="siren">Numéro de Siren</label>
						<input type="number" class="form-control" name="siren" id="siren" placeholder="012 345 678 09876" required>
					</div>

					<button type="submit" class="btn btn-success">Nouveau compte</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>