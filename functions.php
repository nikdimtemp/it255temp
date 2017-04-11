<?php
	include("config.php");

	// funkcija koja dodaje korisnika sa 4 parametara u postojeću bazu
	function addUser($firstname, $lastname, $username, $password){
		global $conn;
		if(!checkIfUserExists($username)){
			$insert = "INSERT INTO user (firstname,lastname,username,password) VALUES (?,?,?,?)";
	
			$query = $conn->prepare($insert);
			$query->bind_param('ssss',$firstname,$lastname,$username,md5($password));
			$query->execute();
			$query->close();
		}
		else{
			echo "Korisnik već postoji";
		}
	}
	// funkcija koja proverava da li korisnik sa datim podacima već postoji u bazi
	function checkUser($username, $password){
		global $conn;
		$sql = "SELECT * FROM user WHERE username=? AND password=?";
		$query = $conn->prepare($sql);
		$query->bind_param('ss',$username,md5($password));
		$query->execute();
		$query->store_result();
		if ($query->num_rows > 0) {
			return 1;
		} else{
			return 0;
		}
		$query->close();
	}

	function checkIfUserExists($username){
		global $conn;
		$sql = "SELECT * FROM user WHERE username=?";
		$query = $conn->prepare($sql);
		$query->bind_param('s',$username);
		$query->execute();
		$query->store_result();
		if ($query->num_rows > 0) {
			return true;
		} else{
		return false;
		}
		$query->close();
	}

	function getFirstnameAndLastnameForUsername($username){
		global $conn;
		$sql = "SELECT firstname,lastname FROM user WHERE username=?";
		$query = $conn->prepare($sql);
		$query->bind_param('s',$username);
		$query->execute();
		$query->store_result();
		$query->bind_result($ime, $prezime);
		
		$returnvalue = "";
		while ($query->fetch()) {
			$returnvalue = $ime." ".$prezime;
		}
		$query->free_result();
		$query->close();
		return $returnvalue;
	}

	function getAllUsers(){
		global $conn;
		$userinfo = "SELECT * FROM user";
		if($stmt = $conn->prepare($userinfo)){
			$stmt->execute();
			if(!$stmt->execute()){
				echo $stmt->error.' in query: '.$userinfo;
			}
			else {
				$parameters = array();
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) {
					array_push($parameters,$row);
				}
				$stmt->close();
				return $parameters;
			}
			$stmt->close();
		}
	}

	//addUser("Ime test","Prezime test","test_user","test123");
	//echo checkUser("test_user","test123");
	//echo getFirstnameAndLastnameForUsername("test_user");
?>