<?php
/*
Redirection vers la page de connexion,
ou vers la page du compte si déjà connecté.

##### A COMPLETER #####
*/
if (!isset($_COOKIE["account-name"])) {
	header("location:connect.php");
}
