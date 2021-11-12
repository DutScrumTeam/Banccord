<?php
include("class/PdoAccess.php");
$type =$_POST['type'];
$password =$_POST['password'];
$passwordC=$_POST['passwordConfirm'];
$name =$_POST['name'];
if (isset($type,$password,$passwordC,$name)){
	if (!($password==$passwordC)){
		header("Location:new-account.php?error=password");
    }
	elseif($type=="Client"){
		header("Location:new-client.php");
	}
	else{
		$pdo = PdoAccess::getPdo();
		$prep = $pdo->prepare("set search_path = banque;");
		$prep->execute();
		$prep = $pdo->prepare("INSERT INTO compte (id, mdp, type) VALUES (:name,:password,:name)");
		$prep->bindParam(':name', $name);
		$prep->bindParam(':password', $password);
		$prep->bindParam(':name', $type);
		$prep->execute();
	}
}