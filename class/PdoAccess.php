<?php

class PdoAccess
{
	private static $user = "guillaume.grisolet";
	private static $pass = "guigui";
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
		$sql="delete from banque.client where id_compte = :name";
		$sql2="delete from banque.compte where id = :name";
		$sql3="DELETE FROM banque.di WHERE id_client = :name ";
		$sql4="DELETE FROM banque.remise WHERE id_client = :name";
		$siren = self::getSiren($name);
		$stmt = $pdo->prepare($sql4);
		$stmt->bindParam(':name', $siren);
		$stmt->execute();
		$stmt = $pdo->prepare($sql3);
		$stmt->bindParam(':name', $siren);
		$stmt->execute();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->execute();
		$stmt = $pdo->prepare($sql2);
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
			echo "<form action='admin.php/?id=".$row['id']."' method='post'>";
			echo "<td>" . $row['num_siren'] . "</td>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td><input type='submit' class='btn btn-danger' value='Supprimer' name='delete'></td>";
			echo "</form>";
			echo "</tr>";
		}
	}
    public static function clientSpecificRemiseTable($id, $remise){
        $pdo = self::getPdo();
        $sqlSiren = "SELECT num_siren FROM banque.client WHERE id_compte = :id";
        $stmtSiren = $pdo->prepare($sqlSiren);
        $stmtSiren->bindParam(':id',$id);
        $stmtSiren->execute();
        $siren = $stmtSiren->fetch();
        $sql = "SELECT num_remise,traitement_date,type_card,num_carte,num_autorisation from banque.remise where id_client = :siren";
		$sql .=is_null($remise)?'':' AND num_remise = :remise';
        $stmt = $pdo->prepare($sql);
	    $stmt->bindParam(':siren', $siren['num_siren']);
		if (!is_null($remise)) $stmt->bindParam(':remise', $remise);
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Affichage des données récoltées par ligne
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['num_remise'] . "</td>";
            echo "<td>" . $row['traitement_date'] . "</td>";
            echo "<td>" . $row['type_card'] . "</td>";
            echo "<td>" . $row['num_carte'] . "</td>";
            echo "<td>" . $row['num_autorisation'] . "</td>";
	        $total = self::getTotalAmountTresorerie($row['num_remise']);
            $amount = $total.'€';
            $color = $total < 0 ? "red" : "green";
            echo "<td style='color: $color;'>$amount</td>" ;
			echo '<td><button class="btn btn-primary" onclick="switchDisplayMoreContent(this.parentNode.parentNode.id)">+</button></td>';
			self::transactionTable($row['num_remise']);
            echo "</tr>";
        }
    }
	public static function getTotalRemise($num_remise){
		$pdo = self::getPdo();
		$sql = "SELECT SUM(montant) as total FROM banque.transaction WHERE num_remise = :num_remise";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':num_remise', $num_remise);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['total'];
	}
	public static function transactionTable($num_remise){
		$pdo = self::getPdo();
		$sqlChaine = "SELECT * FROM banque.transaction WHERE num_remise = :num_remise";
		$stmtChaine = $pdo->prepare($sqlChaine);
		$stmtChaine->bindParam(':num_remise',$num_remise);
		$stmtChaine->execute();

        $result = $stmtChaine->fetchAll();
		echo "<tr class='table-row-more'>";
		echo "<td colspan='6'>";
		echo "<table class='table'>";
		echo "<thead>";
		echo "<th>Code chaine</th>";
		echo "<th>Date de traitement</th>";
		echo "<th>numéro du porteur</th>";
		echo "<th>Type de carte</th>";
		echo "<th>Montant</th>";
		echo "</thead>";
		echo "<tbody>";
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>" . $row['code_chaine'] . "</td>";
			echo "<td>" . $row['date_vente'] . "</td>";
			echo "<td>" . $row['num_porteur'] . "</td>";
			echo "<td>" . $row['reseau'] . "</td>";
			echo "<td>" . $row['montant'] .self::getCurrencySymbolFromCode($row['devise']) . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</td>";
		echo "</tr>";
	}

	public static function clientUnpaidTable($pseudo)
	{
		$pdo = self::getPdo();
		$siren = self::getSiren($pseudo);
		$sql = "SELECT num_dossier,date_debut,date_fin,montant,libelle,devise from banque.di where id_client=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id',$siren);
        self::clientResultUnpaidTable($stmt);
    }

    public static function clientSpecificUnpaidTable($pseudo, $date_start, $date_end)
    {
        $pdo = self::getPdo();
        $siren = self::getSiren($pseudo);
        $sql = "SELECT num_dossier,date_debut,date_fin,libelle from banque.di where id_client=:id AND date_debut >= :start AND date_fin <= :end";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$siren);
        $stmt->bindParam(':start', $date_start);
        $stmt->bindParam(':end', $date_end);
        self::clientResultUnpaidTable($stmt);
    }

	public static function poClientTable(){
		$pdo = self::getPdo();
		$sql = "SELECT num_siren,raison_sociale from banque.client";
		$sqlCountRem = "SELECT COUNT(*) as compte FROM banque.remise INNER JOIN banque.client ON remise.id_client = client.num_siren where id_client=:id";
		$stmt=$pdo->prepare($sql);
        self::poResultClientTable($stmt, $pdo, $sqlCountRem);
    }

    public static function poSpecificClientTableBySociale($raison_sociale){
        $pdo = self::getPdo();
        $sql = "SELECT num_siren,raison_sociale from banque.client WHERE raison_sociale = :sociale";
        $sqlCountRem = "SELECT COUNT(*) as compte FROM banque.remise INNER JOIN banque.client ON remise.id_client = client.num_siren where id_client=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":sociale", $raison_sociale);
        self::poResultClientTable($stmt, $pdo, $sqlCountRem);
    }

    public static function poSpecificClientTableBySiren($num_siren){
        $pdo = self::getPdo();
        $sql = "SELECT num_siren,raison_sociale from banque.client WHERE num_siren = :siren";
        $sqlCountRem = "SELECT COUNT(*) as compte FROM banque.remise INNER JOIN banque.client ON remise.id_client = client.num_siren where id_client=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":siren", $num_siren);
        self::poResultClientTable($stmt, $pdo, $sqlCountRem);
    }

	public static function poRemiseTable(){
		$pdo = self::getPdo();
		$sql = "SELECT num_remise,traitement_date,id_client,type_card,num_carte,num_autorisation from banque.remise";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>" . $row['traitement_date'] . "</td>";
			echo "<td>" . $row['id_client'] . "</td>";
			echo "<td>" . $row['type_card'] . "</td>";
			echo "<td>**** **** **** " . $row['num_carte'] . "</td>";
			echo "<td>" . $row['num_autorisation'] . "</td>";
			$total = self::getTotalRemise($row['num_remise']);
			$color = $total < 0 ? "red" : "green";
			echo "<td style='color: $color;>";
			echo $total;
			echo ($total>0 ? '€' : "");
			echo"</td>";
			echo "</tr>";
		}
	}

	public static function getTotalAmountTresorerie($pseudo)
	{
		$pdo = self::getPdo();
		$total = 0;
		$siren = self::getSiren($pseudo);
		$sqlPlus = "SELECT num_remise from banque.remise WHERE id_client=:id";
		$stmt = $pdo->prepare($sqlPlus);
		$stmt->bindParam(':id',$siren);
		$stmt->execute();
		$res =  $stmt->fetchAll();
		foreach ($res as $row) {
			$total += self::getTotalRemise($row['num_remise']);
		}
		return $total;
	}
	public static function getTotalImpayes($pseudo)
	{
		$pdo = self::getPdo();
		$total = 0;
		$siren = self::getSiren($pseudo);
		$sqlPlus = "SELECT montant from banque.di WHERE id_client=:id";
		$stmt = $pdo->prepare($sqlPlus);
		$stmt->bindParam(':id',$siren);
		$stmt->execute();
		$res =  $stmt->fetchAll();
		foreach ($res as $row) {
			$total += $row['montant'];
		}
		return $total;
	}

	public static function getSiren($pseudo)
	{
		$pdo = self::getPdo();
		$sqlSiren = "SELECT num_siren FROM banque.compte JOIN  banque.client ON compte.id = client.id_compte WHERE id = :id";
		$stmtSiren = $pdo->prepare($sqlSiren);
		$stmtSiren->bindParam(':id',$pseudo);
		$stmtSiren->execute();
		$siren = $stmtSiren->fetch();
		return $siren['num_siren'];
	}

    /**
     * @param $stmt
     */
    public static function clientResultUnpaidTable($stmt)
    {
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Affichage des données récoltées par ligne
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['num_dossier'] . "</td>";
            echo "<td>" . $row['date_debut'] . "</td>";
            echo "<td>" . $row['date_fin'] . "</td>";
            echo "<td>" . $row['libelle'] . "</td>";

            // Affichage de la colonne "montant"
            $color = "";
            $amount = -$row['montant'] . self::getCurrencySymbolFromCode($row['devise']);
            if ($row['montant'] < 100) $color = "green";
            elseif ($row['montant'] < 200) $color = "orange";
            else $color = "red";
            echo "<td style='color: $color;'>$amount</td>";

            echo "</tr>";
        }
    }

    /**
     * @param $stmt
     * @param PDO $pdo
     * @param string $sqlCountRem
     */
    public static function poResultClientTable($stmt, PDO $pdo, string $sqlCountRem)
    {
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $stmt = $pdo->prepare($sqlCountRem);
            $stmt->bindParam(':id', $row['num_siren']);
            $stmt->execute();
            $res = $stmt->fetchAll();
            $compte = $res[0]['compte'];
            $sumInp = self::getTotalImpayes($row['num_siren']);
            $somme = self::getTotalAmountTresorerie($row['num_siren']);
            echo "<tr>";
            echo "<td>" . $row['num_siren'] . "</td>";
            echo "<td>" . $row['raison_sociale'] . "</td>";
            echo "<td>" . $compte . "</td>";
            echo "<td>";
            if ($sumInp == 0) {
                echo '__________';
            } else echo '-' . $sumInp;
            echo "</td>";
            echo "<td>" . $somme . "</td>";
            echo "</tr>";
        }
    }
}