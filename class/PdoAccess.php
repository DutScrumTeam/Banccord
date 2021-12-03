<?php

class PdoAccess
{
	private static $user = "clement.duval";
	private static $pass = "6A3iMDg5UZeR8jz";
	private static $database = "guillaume.grisolet_db";
	private static $host = "sqletud.u-pem.fr";
	private static $pdo;
	public static function getCurrencySymbolFromCode($string): string
	{
		switch ($string){
			case "EUR":
				return "€";
			case "CAD":
			case "USD":
				return "$";
			case "GBP":
				return "£";
			case "CNY":
			case "JPY":
				return "¥";
			case "CHF":
				return "CHF";
			case "AUD":
				return "A$";
			case "NZD":
				return "NZ$";
			case "SEK":
				return "kr";
			case "PHP":
				return "₱";
			case "RUB":
				return "₽";
			case "ILS":
				return "₪";
			case "AZN":
				return "₼";
		}
		return "";
	}
	public static function getPdo(): PDO
	{
		if (self::$pdo === null) {
			try {
				self::$pdo = new PDO('pgsql:host=' . PdoAccess::$host . ';dbname=' . PdoAccess::$database, self::$user, self::$pass);
			} catch (PDOException $e) {
				echo "ERREUR : La connexion a échouée<br>\n";
				echo $e->getMessage() . "<br>\n";
			}
		}
		return self::$pdo;
	}

	public static function insertAccount($name, $password, $type)
	{
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
		self::insertAccount($name,$password,"client");
		$sir = (int)$siren;
		$pdo = self::getPdo();
		$sql="insert into banque.client(num_siren, raison_sociale, id_compte) values (:siren,:raison_social,:id_compte)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':siren', $sir);
		$stmt->bindParam(':raison_social', $businessName);
		$stmt->bindParam(':id_compte', $name);
		$stmt->execute();
	}

	public static function deleteAccount($name)
	{
		$pdo = self::getPdo();
		$sql2 = "DELETE FROM banque.client WHERE id_compte = :name";
		$stmt2 = $pdo->prepare($sql2);
		$stmt2->bindParam(':name', $name);
		$stmt2->execute();
		$sql = "DELETE FROM banque.compte WHERE id = :name";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->execute();
	}

	public static function checkUser($pseudo, $password)
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

	public static function adminAccountTable()
	{
		$pdo = self::getPdo();
		$sql = "SELECT id,num_siren FROM banque.compte JOIN  banque.client ON compte.id = client.id_compte";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			echo "<tr>";
			echo "<form action='admin.php?id=" . $row['id'] . " method='get'>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['num_siren'] . "</td>";
			echo "<td><input type='submit' class='btn btn-danger' value='Supprimer' name='delete'></td>";
			echo "</form>";
			echo "</tr>";
		}
	}
	public static function clientRemiseTable($id){
		$pdo = self::getPdo();
		$sql = "SELECT num_remise,traitement_date,type_card,num_carte,num_autorisation,montant,devise from banque.remise where id_client = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>" . $row['num_remise'] . "</td>";
			echo "<td>" . $row['traitement_date'] . "</td>";
			echo "<td>" . $row['type_card'] . "</td>";
			echo "<td>" . $row['num_carte'] . "</td>";
			echo "<td>" . $row['num_autorisation'] . "</td>";
			echo "<td>" . $row['montant'].self::getCurrencySymbolFromCode($row['devise'])."</td>";
			echo "</tr>";
		}
	}

	public static function clientUnpaidTable($pseudo)
	{
		$pdo = self::getPdo();
		$sql = "SELECT num_dossier,date_debut,date_fin,montant,devise from banque.di where id_client=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>" . $row['num_dossier'] . "</td>";
			echo "<td>" . $row['date_debut'] . "</td>";
			echo "<td>" . $row['date_fin'] . "</td>";
			echo "<td>" . $row['montant'].self::getCurrencySymbolFromCode($row['devise'])."</td>";
			echo "</tr>";
		}
	}
	public static function poClientTable(){
		$pdo = self::getPdo();
		$sql = "SELECT num_siren,raison_sociale from banque.client";
		$sql2 = "SELECT count(*) as c from banque.remise where id_client=:id_client group by id_client";
		$sql3 = "SELECT sum(montant) as sum1 from banque.di where id_client=:id_client group by id_client ";
		$sql4 = "SELECT sum(montant) as sum1 from banque.remise where id_client=:id_client group by id_client ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ($result as $row){
			echo "<tr>";
			echo "<td>".$row['num_siren']."</td>";
			echo "<td>".$row['raison_sociale']."</td>";
			$stmt = $pdo->prepare($sql2);
			$stmt->bindParam(':id_client',$result['num_siren']);
			$stmt->execute();
			if ($stmt->rowCount()>0){
				$resu=$stmt->fetchAll()[0]['c'];
			}
			else $resu=0;
			echo "<td>".$resu."</td>";
			$stmt = $pdo->prepare($sql3);
			$stmt->bindParam(':id_client',$result['num_siren']);
			$stmt->execute();
			if ($stmt->rowCount()>0){
				$resu=$stmt->fetchAll()[0]['c'];
			}
			else $resu=0;
			echo "<td>".$resu."</td>";
			$stmt = $pdo->prepare($sql4);
			$stmt->bindParam(':id_client',$result['num_siren']);
			$stmt->execute();
			if ($stmt->rowCount()>0){
				$result=$stmt->fetchAll()[0]['c'];
			}
			else $resu=0;
			echo "<td>".$resu."</td>";
			echo "</tr>";
		}
	}

}