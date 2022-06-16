<?php
require_once "config.php";

session_start();


$username = "";
$email = "";

$_SESSION['role'] = "";
$errors = array();
$_SESSION['success'] = "";


$db = mysqli_connect('localhost', 'root', '', 'manage');


if (isset($_POST['reg_user'])) {


	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
    $role = mysqli_real_escape_string($db,$_POST['role']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($role)) { array_push($errors, "Role is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
		
	}

	
	if (count($errors) == 0) {
		
		
		$password = md5($password_1);
		
		
        
		$query = "INSERT INTO users (username,email,role,password)VALUES('$username','$email','$role','$password')";
		
		mysqli_query($db, $query);

		
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $role;
		
		$_SESSION['success'] = "You have logged in";
		
		if($_SESSION['role'] == "admin"){
			header('location: index.php');
		}
		else if($_SESSION['role'] == "user"){
			header('location: index-user.php');
		}
		else{
			header('location: index-staff.php');
		}
		
		
	}
}

// User login
if (isset($_POST['login_user'])) {
	
	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);


	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	
	if (count($errors) == 0) {
		
		
		$password = md5($password);
		
		$query = "SELECT * FROM users WHERE username= '$username' AND password='$password'";
		$results = mysqli_query($db, $query);
		$temp1 = "";
		$temp2 = "";
	
		if (mysqli_num_rows($results) == 1) {
			
			while($row = mysqli_fetch_assoc($results))
			{
				
				$temp1 = $row['username'];
				$temp2 = $row['role'];
			}
			
			$_SESSION['username'] = $temp1;
			$_SESSION['role'] = $temp2;
			
			$_SESSION['success'] = "You have logged in!";
			
			if($_SESSION['role'] == 'user')
			{
				header('location: index-user.php');//user
			}
			else if($_SESSION['role'] == 'admin'){
				header('location: index.php');//admin 
			}
			else{
				header('location: index-staff.php');//staff
			}
			
			
		}
		else {
			
			
			array_push($errors, "Username or password incorrect");
		}
	}
}

?>
