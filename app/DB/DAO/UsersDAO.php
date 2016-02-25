<?php
/**
 * @author Luca
 * definition of the User DAO (database access object)
 */
class UsersDAO {
	private $dbManager;
	function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	function getUsers() {
		$sql = "SELECT * FROM users ORDER BY name;";
		
		$result = $this->dbManager->executeQuery ($sql);
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}
	function insertUser($parametersArray) {
		//create an INSERT INTO sql statement (reads the parametersArray - this contains the fields submitted in the HTML5 form)
		
		$first = $parametersArray["firstname"];
		$last = $parametersArray["lastname"];
		$email = $parametersArray["email"];
		$pass = $parametersArray["password"];
		
		$queryString ="INSERT INTO `users` (`name`, `surname`, `email`,`password`) VALUES ('".$first."','".$last."','".$email."','".$pass."')";
		
		
		$this->dbManager->openConnection();
		$this->dbManager->executeQuery($queryString);		
		$this->dbManager->closeConnection();
		
		//execute the query
		
	}
}
?>
