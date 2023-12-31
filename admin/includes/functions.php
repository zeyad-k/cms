<?php
include("../includes/dp.php");
function redirect($location)
{
	return header("Location: " . $location);
}
function escape($string)
{
	global $connection;
	return mysqli_real_escape_string($connection, trim(strip_tags($string)));
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
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (usernameExist($username)) {
		$message = 'user already exists';
	}
	if (userEmailExist($email)) {
		$message = 'Email already exists';
	}

	if (!empty($username) && !empty($email) && !empty($password)) {

		$username = mysqli_real_escape_string($connection, $username);
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);


		$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


		$query = "INSERT INTO users (username, user_email, user_password, user_role)
        VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
		$register_user_query = mysqli_query($connection, $query);

		confirmQuery($register_user_query);
	} else {
		$message = "Fields cannot be empty";
	}


}


?>