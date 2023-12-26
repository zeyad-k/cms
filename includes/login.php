<?php include "dp.php"; ?>
<?php // include "./admin/includes/functions.php" ?>
<?php session_start(); ?>
<?php
if (isset($_POST['login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	//  للحماية من التهكير 
	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$get_users_query = "SELECT * FROM users WHERE username = '$username';";
	$get_user = mysqli_query($connection, $get_users_query);

	if (!$get_user) {
		die("User_query Failed" . mysqli_error($connection));
	}
	while ($row = mysqli_fetch_array($get_user)) {
		$dp_id = $row['user_id'];
		$dp_username = $row['username'];
		$dp_password = $row['user_password'];
		$dp_firstname = $row['user_firstname'];
		$dp_lastname = $row['user_lastname'];
		$dp_role = $row['user_role'];
	}
	if ($username === $dp_username && password_verify($password, $dp_password)) {


		$_SESSION['user_id'] = $dp_id;
		$_SESSION['username'] = $dp_username;
		$_SESSION['firstname'] = $dp_firstname;
		$_SESSION['lastname'] = $dp_lastname;
		$_SESSION['user_role'] = $dp_role;


		header("location: ../admin");

	} else {
		header("location: ../index.php");
	}
}


?>