<?php 

require_once 'DB/DBmanager.php';
require_once 'DB/DAO/UsersDAO.php';


if(!empty($_GET["firstname"]) && sizeof($_GET["firstname"] <= 25) && !empty($_GET["lastname"]) && !empty($_GET["email"]) && !empty($_GET["password"])){

	$manager = new DBManager();
	$dao = new UsersDAO($manager);
	
	$dao->insertUser($_GET);
	echo "User Added to DB";
	
	}
	else
		die("Missing User Info")
?>