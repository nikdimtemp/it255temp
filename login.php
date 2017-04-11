<?php
	include("functions.php");

	session_start();
	
	if(isset($_POST['submit'])){
		$username = $conn->real_escape_string($_POST['username']);
		$password = $_POST['password'];
	
		if(!empty($username) && !empty($password)){
			if(checkUser($username,$password)){
				$_SESSION['username'] = $username;
			}else{
				echo "Pogresan username ili password";
			}
		}else{
			echo "Niste uneli sve podatke";
		}
	}

	if(isset($_SESSION['username'])){
		echo "Logovan si kao: ".$_SESSION['username'];
	}else{
?>

<form action="login.php" method="POST">
	Username: <input type="text" name="username"/><br/>
	Password: <input type="password" name="password"/><br/>
	<input type="submit" name="submit" value="Loguj se"/>
</form>
<?php
}
?>