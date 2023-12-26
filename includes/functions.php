<?php
include("../includes/dp.php");
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



?>