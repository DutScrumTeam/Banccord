<?php

class PdoAccess
{
private static $user =  "postgres";
private static $pass =  "root";
private static  $pdo;
public static function getPdo(): PDO
{
	if (self::$pdo === null) {
		try {
			echo "Connexion à la base de données en cours...\n";
			self::$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', self::$user, self::$pass);
		} catch (PDOException $e) {
			echo "ERREUR : La connexion a échouée<br>\n";
			echo $e->getMessage()."<br>\n";
		}
	}
	return self::$pdo;
}
}