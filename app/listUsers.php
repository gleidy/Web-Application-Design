<?php

	require_once 'DB/DBmanager.php';
	require_once 'DB/DAO/UsersDAO.php';

	$manager = new DBManager();
	$dao = new UsersDAO($manager);
	$manager->openConnection();
	
	/*
	$results = $dao->getUsers();
	for($count = 0; $count < sizeof($results); $count++){
		echo $results[$count]["name"] . ", " . $results[$count]["surname"]. ", " . $results[$count]["email"]. ", " . $results[$count]["password"].";"."<br>";
	}
	*/
	
	$results = $dao->getUsers();
	$htmlList = "";
	foreach($results as $key=>$value){
		$htmlList.= "<li>$value[name] $value[surname] $value[email]</li>";
		
	}
	
	$htmlList = "<ul>" . $htmlList . "</ul>";
	echo $htmlList;

	
	//var_dump($results);
	
	$manager->closeConnection();

?>