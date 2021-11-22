<?php

class PdoAccess
{
private static $user =  "clement.duval";
private static $pass =  "6A3iMDg5UZeR8jz";
private static $database = "guillaume.grisolet_db";
private static $host = "sqletud.u-pem.fr";
private static  $pdo;
public static function getPdo(): PDO
{
	if (self::$pdo === null) {
		try {
			echo "Connexion à la base de données en cours...\n";
			self::$pdo = new PDO('pgsql:host='.PdoAccess::$host.';dbname='.PdoAccess::$database, self::$user, self::$pass);
		} catch (PDOException $e) {
			echo "ERREUR : La connexion a échouée<br>\n";
			echo $e->getMessage()."<br>\n";
		}
	}
	return self::$pdo;
}
public static function insertAccount($name, $password, $type){
	$pdo = self::getPdo();
	$password = md5($password);
    $sql = "INSERT INTO banque.compte VALUES (:name,:password,:type)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
}
public static function insertClient($name,$password,$siren,$businessName){
	self::insertAccount($name,$password,"Client");
	$pdo = self::getPdo();
	$sql = "INSERT INTO banque.client VALUES (:num_siren,:raison_social,:id_compte)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':num_siren', $siren);
	$stmt->bindParam(':raison_social', $businessName);
	$stmt->bindParam(':id_compte', $name);
	$stmt->execute();
}

	public static function checkUser($pseudo,$password)
	{
		$pdo = self::getPdo();
        $sql = "SELECT * FROM banque.compte WHERE id = :pseudo";
        $stmt = $pdo->prepare($sql);
		$stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            if ($result['mdp'] == md5($password)) {
                return $result['type_compte'];
            }
        }
        return null;
	}
}