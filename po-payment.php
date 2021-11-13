<?php include("class/header.php"); ?>
<script src="js/form-edit.js"></script>
<script src="js/page-manager.js"></script>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Remises</title>
	<?php include("class/head.inc.php") ?>
</head>
<body>
	<?php
		echoHeader(
			"Comptes", "po-info.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des remises</h1>
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

		<!-- Tableau des remises -->
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Date de payement</th>
					<th scope="col">Siren</th>
					<th scope="col">Type de carte</th>
					<th scope="col">Numéro de carte</th>
					<th scope="col">Code d'autorisation</th>
					<th scope="col">Montant</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">03/01/2021</th>
					<td>489 025 603 68250</td>
					<td>Visa</td>
					<td>************6942</td>
					<td>48</td>
					<td>1.00€</td>
				</tr>
				<tr>
					<th scope="row">02/01/2021</th>
					<td>489 025 603 68250</td>
					<td>Issou</td>
					<td>6942 6942 6942 6942</td>
					<td>29</td>
					<td>1.00€</td>
				</tr>
				<tr>
					<th scope="row">01/01/2021</th>
					<td>489 025 603 68250</td>
					<td>Issou</td>
					<td>6942 6942 6942 6942</td>
					<td>35</td>
					<td>1.00€</td>
				</tr>
			</tbody>
		</table>
        <!-- Choix de la page des résultats -->
        <div class="row justify-content-center">
            <button class="col-auto">Page précédente</button>
            <div class="col-auto">
                Résultat 1-3<br>
                97 résultat au total.
            </div>
            <button class="col-auto">Page suivante</button>
        </div>

	</div>	
</body>
</html>