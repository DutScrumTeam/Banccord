<?php
include("class/PdoAccess.php");
if (isset($_POST['type'],$_POST['password'],$_POST['passwordConfirm'],$_POST['name'])){
	if (!($_POST['password']==$_POST['passwordConfirm'])){
		header("Location:new-account.php?error=password");
    }
	elseif($_POST['type']=="Client"){
		if (isset($_POST['businessName'],$_POST['siren'])){
			PdoAccess::insertClient($_POST['name'],$_POST['password'],$_POST['businessName'],$_POST['siren']);
            header("Location:index.php");
        }
		else {
			header("Location:new-client.php");
		}
	}
	else{
		PdoAccess::insertAccount($_POST['name'],$_POST['password'],$_POST['type']);
		header("Location:index.php");
	}
}
else{
	header("Location:new-account.php?error=incomplete");
}