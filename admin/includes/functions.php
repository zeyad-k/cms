<?php
include("../includes/dp.php");
function redirect($location)
{


	header("Location:" . $location);
	exit;

}
function ifItIsMethod($method = null)
{

	if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

		return true;

	}

	return false;

}

function isLoggedIn()
{

	if (isset($_SESSION['user_role'])) {

		return true;


	}


	return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null)
{

	if (isLoggedIn()) {

		redirect($redirectLocation);

	}

}


function escape($string)
{

	global $connection;

	return mysqli_real_escape_string($connection, trim($string));


}
function set_message($msg)
{

	if (!$msg) {

		$_SESSION['message'] = $msg;

	} else {

		$msg = "";


	}


}
function display_message()
{

	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}


}
function usersOnline()
{
	global $connection;
	$session = session_id();
	$time = time();
	$time_out_in_secondes = 30;
	$time_out = $time - $time_out_in_secondes;

	$query = "SELECT * FROM `online_users` WHERE session = '$session'";
	$send_query = mysqli_query($connection, $query);
	$count = mysqli_num_rows($send_query);
	if ($count == null) {
		mysqli_query($connection, "INSERT INTO `online_users`(session,time)
  VALUES('{$session}','{$time}')  ");
	} else {
		mysqli_query($connection, "UPDATE `online_users` SET time ='{$time}'
    WHERE session = '{$session}' ");
	}
	$users_online = mysqli_query($connection, "SELECT * FROM `online_users` WHERE time > '{$time_out}'");
	return $count_users = mysqli_num_rows($users_online);


}

function confirmQuery($qu)
{
	if (!$qu) {
		global $connection;
		die("QUERY FAILED ." . mysqli_error($connection));
	}
}

function isAdmin($username = '')
{
	global $connection;
	$query = "SELECT user_role FROM users WHERE username='{$username}'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);

	$row = mysqli_fetch_array($result);
	if ($row['user_role'] == 'admin') {
		return true;
	} else {
		return false;
	}
}

function usernameExist($username)
{
	global $connection;
	$query = "SELECT username FROM users WHERE username='{$username}'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);

	$row = mysqli_fetch_array($result);
	if ($row > 0) {
		return true;
	} else {
		return false;
	}
}
function userEmailExist($user_email)
{
	global $connection;
	$query = "SELECT user_email FROM users WHERE username='{$user_email}'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);

	$row = mysqli_fetch_array($result);
	if ($row > 0) {
		return true;
	} else {
		return false;
	}
}





function register_user($username, $email, $password)
{
	global $connection;

	$username = mysqli_real_escape_string($connection, $username);
	$email = mysqli_real_escape_string($connection, $email);
	$password = mysqli_real_escape_string($connection, $password);


	$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


	$query = "INSERT INTO users (username, user_email, user_password, user_role)
        VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
	$register_user_query = mysqli_query($connection, $query);

	confirmQuery($register_user_query);
}





function login_user($username, $password)
{
	global $connection;
	$username = trim($username);
	$password = trim($password);

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