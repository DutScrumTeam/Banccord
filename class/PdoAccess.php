<?php

class PdoAccess
{
private static $user =  "guillaume.grisolet";
private static $pass =  "guigui";
private static $pdo;
public static function getPdo(): PDO
{
	if (self::$pdo === null) {
		try {
			self::$pdo = new PDO('pgsql:host=sqletud.u-p+em.fr;dbname=guillaume.grisolet_db',self::$user,self::$pass);
		} catch (PDOException $e) {
			echo "ERREUR : La connexion a échouée<br>\n";
			echo $e->getMessage()."<br>\n";
		}
	}
	return self::$pdo;
}
}