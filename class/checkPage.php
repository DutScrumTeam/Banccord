<?php

class checkPage
{
private static $list_client = array("client-info.php","client-unpaid.php");
private static $list_admin = array("admin.php");
private static $list_po = array("po-info.php","po-payment.php");
public static function checkUserType($page)
{
	session_start();
	if(!isset($_SESSION['user_type']))
	{
		header("Location:connect.php");
		exit();
	}
	switch ($_SESSION['user_type']){
		case 'client':
			if(in_array($page,self::$list_client))
			{
				header("Location:index.php");
				exit();
			}
			break;
		case 'admin':
			if(in_array($page,self::$list_admin))
			{
				header("Location:index.php");
				exit();
			}
			break;
		case 'po':
			if(in_array($page,self::$list_po))
			{
				header("Location:index.php");
				exit();
			}
			break;
		default:
			header("Location:connect.php");
			exit();
			break;
	}
}
}