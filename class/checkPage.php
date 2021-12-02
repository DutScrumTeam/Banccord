<?php

class checkPage
{
private static $list_client = array("client-info.php","client-unpaid.php");
private static $list_admin = array("admin.php");
private static $list_po = array("po-info.php","po-payment.php");
public static function checkUserType($page)
{
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(!isset($_SESSION['user_type']))
	{
		header("Location:connect.php");
		return;
	}
	switch ($_SESSION['user_type']){
		case 'client':
			if(!in_array($page,self::$list_client))
			{
				header("Location:client-info.php");

			}
			break;
		case 'admin':
			if(!in_array($page,self::$list_admin))
			{
				header("Location:admin.php");
			}
			break;
		case 'po':
			if(!in_array($page,self::$list_po))
			{
				header("Location:po-info.php");
			}
			break;
		default:
			header("Location:connect.php");
			break;
	}
}
}