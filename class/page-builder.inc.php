<?php
if (!defined("DEF_PAGE_BUILDER")) {
define("DEF_PAGE_BUILDER", true);

/** Affiche le bouton d'exportation en fichier. */
function echoExportButton() {
	echo '
		<select class="form-control btn btn-primary btn-export" name="search-mod" id="search-mod">
			<option selected>Exporter au format...</option>
			<option>CSV</option>
			<option>PDF</option>
			<option>XLS</option>
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
				<button type='button' class='order-btn' onclick='orderBy($i);' id='col$i'></button>
			</th>
		";
	}

	echo '</tr></thead>';
}

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
 *	"Accueil", "client.php",
 *	"Impayés", "client-unpaid.php"
 * );
 */
function echoHeader() {
	echo "<header>";

	$args = func_get_args();
	for ($i=0; $i<count($args); $i += 2) {
		echo "<a class='header-elem' href='{$args[$i+1]}'>{$args[$i]}</a>";
	}

	echo "
		<a class='header-disconnect' href='connect.php'><p>Se déconnecter</p></a>
		</header>
	";
}

}