<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Remises</title>
	<?php include("class/head.inc.php") ?>
</head>
<body>

<?php include("class/header.inc.php"); ?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des remises</h1>
				<p>Siren : 749 547 487 47239</p>
				<h2>Impayés total : 23479€</h2>
			</div>
			<!-- Le graphique -->
			<div class="col-auto" style="background-color:#2CB3E3;">
				Schema goes brrrrr here.
			</div>
		</div>

		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<div class="row action-option">
					<!-- Champ de recherche -->
					<div class="col col-offset-4">
						<form action="client-info.php">
							<input type="number" class="form-control" id="search-siren" name="search-siren" placeholder="Rechercher par un numéro de Siren">
						</form>
					</div>
					<!-- Bouton d'export du fichier -->
					<div class="col-auto">
						<button class="btn btn-primary">Exporter au format...</button>
					</div>
				</div>
			</div>
		</div>

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