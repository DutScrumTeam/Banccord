<?php
/*
Redirection vers la page de connexion,
ou vers la page du compte si déjà connecté.

##### A COMPLETER #####
*/

if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
		$params["path"], $params["domain"],
		$params["secure"], $params["httponly"]
	);
}
session_destroy();
header('Location: connect.php');