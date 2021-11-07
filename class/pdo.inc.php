<?php if (!defined("DEF_PDO")) {
define("DEF_PDO", true);

// Créer une connexion à la base de donnée
$user =  "guillaume.grisolet";
$pass =  "guigui";
try {
	$pdo = new PDO('pgsql:host=sqletud.u-pem.fr;dbname=guillaume.grisolet_db',$user,$pass);
} catch (PDOException $e) {
	echo "ERREUR : La connexion a échouée<br>\n";
	echo $e->getMessage()."<br>\n";
}

}
?>