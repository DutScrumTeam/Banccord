<?php
// Balise header commun entre certaines page.

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
	// echo '<pre>';
	// foreach (func_get_args() as $param) {
	// 	echo "$param\n";
	// }
	// echo '</pre>';

	echo "<header>";

	$args = func_get_args();
	for ($i=0; $i<count($args); $i += 2) {
		echo "<a class='header-elem' href='{$args[$i+1]}'>{$args[$i]}</a>";
	}

	echo "
		<div class='header-disconnect'><p>Se déconnecter</p></div>
		</header>";
}
;