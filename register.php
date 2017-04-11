<form action="register.php" method="POST">
	Ime: <input type="text" name="firstname"/><br/>
	Prezime: <input type="text" name="lastname"/><br/>
	Username: <input type="text" name="username"/><br/>
	Password: <input type="password" name="password"/><br/>
	<input type="submit" name="submit" value="Registruj se"/>
</form>

<?php

	include("functions.php");
	
	if(isset($_POST['submit'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(!empty($firstname) && !empty($lastname) && !empty($username)
&& !empty($password)){
			addUser($firstname,$lastname,$username,$password);
			echo "Uspešna registracija";
			header("Location: login.php");
		} else{
			echo "Niste popunili sva polja";
		}
	}
?>