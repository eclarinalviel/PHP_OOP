<?php include 'db/dbcrud.php';

class Auth extends Connect {
	public function __construct() // constructor, PHP5 only
	{
		// if you need to do anything when the object is first created, place that code here
		
	}
	public function login( $username, $password ){
		$con = new Connect();
		if($username && $password) {
			$pass = md5($password);
			$result = $con->getdata("SELECT username, password FROM tbl_users WHERE username='$username' AND password='$pass'");
			if($result) {
				$_SESSION['user'] = $username;
				header('Location: main.php'); 
			} else {
				return "Account does not exists.";
			}
			
		} else {
			return "Please fill up the required fields.";
		}
	
		
	}

	public function register( $username, $password, $confirm_password ){
		$con = new Connect();
		if($username && $password && $confirm_password ) {
			if($password == $confirm_password) {
				$result = mysql_query("INSERT INTO tbl_users(username, password) VALUES ('$username', '$password')");
				if($result) {

					header("Location: login.php"); 
				} 
			} else {
				return "Passwords did not match.";
			}
			
		}
		
	}

	public function logout() {
		// remove all session variables
		session_unset(); 
		// destroy the session 
		session_destroy(); 
		header('Location: login.php'); exit;
	}
}