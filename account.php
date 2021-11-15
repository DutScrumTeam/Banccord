<?php
include("class/PdoAccess.php");
$type =$_POST['type'];
$password =$_POST['password'];
$passwordC=$_POST['passwordConfirm'];
$name =$_POST['name'];
$siren =$_POST['siren'];
$businessName =$_POST['businessName'];
if (isset($type,$password,$passwordC,$name)){
	if (!($password==$passwordC)){
		header("Location:new-account.php?error=password");
    }
	elseif($type=="Client"){
		if (isset($businessName,$siren)){
			PdoAccess::insertClient($name,$password,$businessName,$siren);
            header("Location:index.php");
        }
        else{
            header("Location:new-account.php");
        }
	}
	else{
		PdoAccess::insertAccount($name,$password,$type);
	}
}