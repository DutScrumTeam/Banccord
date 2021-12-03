<?php
// Contient des fonctions affichant des morceaux de page communs entre plusieurs pages.
if (!defined("DEF_PAGE_BUILDER")) {
define("DEF_PAGE_BUILDER", true);

/** Affiche le bouton d'exportation en fichier. */
function echoExportButton($file_title) {
	echo '
		<select id="export-btn" class="form-control btn btn-primary btn-export"
		 onchange="if (this.value===`1`){exportToCSV(lines, \''.$file_title.'\')}else if (this.value===`2`){exportToPDF(lines, \''.$file_title.'\')}">
			<option selected>Exporter au format...</option>
			<option value="1">CSV</option>
			<option value="2">PDF</option>
		</select>
	';
}

/**
 * Affiche les titres du tableau.
*/
function echoTableHead() {
	$args = func_get_args();
	
	echo '<thead><tr>';

	for ($i=0; $i < count($args); $i++) { 
		echo "
			<th scope='col'>
				{$args[$i]}
				<button type='button' class='order-btn' onclick='orderBy($i)' id='col$i'></button>
			</th>
		";
	}

	echo '</tr></thead>';
}

/** Affiche des boutons de choix de page. */
function echoPageChoice() {
	echo '
		<div class="row justify-content-center">
			<button type="button" class="btn btn-primary col-auto" onclick="previousPage()">Page précédente</button>
			<div class="col-auto" id="result-count">
				Résultat x-y<br>
				z résultat au total.
			</div>
			<button type="button" class="btn btn-primary col-auto" onclick="nextPage()">Page suivante</button>
		</div>
	';
}

/**
 * Affiche le header, avec comme paramètre les différents liens. 
 * 
 * exemple :
 * echoHeader(
 *  "Titre principal",
 *  "Accueil", "client-info.php",
 *  "Impayés", "client-unpaid.php"
 * );
 */
function echoHeader($title) {
	echo "<header>";
	$args = func_get_args();

	echo "<h1 class='header-title'>$title</h1>";

	for ($i=1; $i<count($args); $i += 2) {
		echo "<a class='header-elem' href='{$args[$i+1]}'>{$args[$i]}</a>";
	}

	echo "
		<a class='header-disconnect' href='index.php'><p>Se déconnecter</p></a>
		</header>
	";
}

}