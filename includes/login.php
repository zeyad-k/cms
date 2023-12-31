<?php session_start(); ?>
<?php include "dp.php"; ?>
<?php include "../admin/includes/functions.php" ?>

<?php
if (isset($_POST['login'])) {
	login_user($_POST['username'], $_POST['password']);
}

?>