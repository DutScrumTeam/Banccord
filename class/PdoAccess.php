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
public static function insertAccount($name, $password, $type){
	$pdo = self::getPdo();
	$pdo->exec("set search-path = banque;");
    $sql = "INSERT INTO client (name,password,type) VALUES (:name,:password,:type)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
}
public static function insertClient($name,$password,$siren,$businessName){
	self::insertAccount($name,$password,"Client");
	$pdo = self::getPdo();
	$pdo->exec("set search-path = banque;");
	$sql = "INSERT INTO client (num_siren,raison_sociale,id_compte) VALUES (:num_siren,:raison_social,:id_compte)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':num_siren', $siren);
	$stmt->bindParam(':raison_social', $businessName);
	$stmt->bindParam(':id_compte', $name);
	$stmt->execute();
}
}