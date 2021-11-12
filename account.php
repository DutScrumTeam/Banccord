<?php
include("class/PdoAccess.php");
$type =$_POST['type'];
$password =$_POST['password'];
$passwordC=$_POST['password-confirm'];
$name =$_POST['name'];
if (isset($type,$password,$passwordC,$name)){
	if (!($password==$passwordC)){
		header("Location:new-account.php?error=password");
    }
    if($type=="Client"){
		header("Location:new-client.php");
    }
	else{
		$pdo = PdoAccess::getPdo();
	}
}