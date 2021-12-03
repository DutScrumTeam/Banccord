<?php
include("class/PdoAccess.php");
if (isset($_POST['type'],$_POST['password'],$_POST['passwordConfirm'],$_POST['name'])){
	if (!($_POST['password']==$_POST['passwordConfirm'])){
		header("Location:admin.php?error=password");
    }
	elseif($_POST['type']=="client"){
		if (isset($_POST['businessName'],$_POST['siren'])){
			PdoAccess::insertClient($_POST['name'],$_POST['password'],$_POST['siren'],$_POST['businessName']);
			header("Location:admin.php?success=client");
        }
		else {
			header("Location:admin.php?error=empty");
		}
	}
	else{
		PdoAccess::insertAccount($_POST['name'],$_POST['password'],$_POST['type']);
		header("Location:admin.php?success=account");
	}
}
else{
	header("Location:admin.php?error=empty");
}