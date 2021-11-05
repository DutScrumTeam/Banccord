<?php if (!defined("DEF_PDO")) {
define("DEF_PDO", true);

// Créer une connexion à la base de donnée
// INFORMATIONS NON TESTEES
$user =  "guillaume.grisolet";
$pass =  "guillaumé el famoso";
try {
	$pdo = new PDO('pgsql:host=sqletud.u-pem.fr;dbname=guillaume.grisolet_db',$user,$pass);
} catch (PDOException $e) {
	echo "ERREUR : La connexion a échouée.";
}

}?>