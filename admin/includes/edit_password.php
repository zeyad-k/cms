<?php
if (isset($_GET['user_id'])) {
	$the_user_id_to_edit = $_GET['user_id'];

	// getting the data of the post by the id
	$query = "SELECT user_password FROM `users` WHERE user_id =$the_user_id_to_edit";
	$select_password_by_id = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_password_by_id)) {
		$dp_password = $row['user_password'];

		if (isset($_POST['edit_password'])) {
			$password = $_POST['old_password'];
			$password = mysqli_real_escape_string($connection, $password);


			if (password_verify($password, $dp_password)) {
				$new_password = $_POST['new_password'];
				$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
				$query_update_user = "UPDATE `users` SET user_password = '{$hashed_password}' WHERE user_id = {$the_user_id_to_edit}";
				$update_user_query = mysqli_query($connection, $query_update_user);
				confirmQuery($update_user_query);
				// header("location: users.php");
			} else {
				echo "<h3>Wrong Password!</h3>";
			}

		}

	}


}



?>
<!-- # the GUI Edit posts -->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="old_password">Old Password</label>
		<input type="password" class="form-control" name="old_password" placeholder="Enter Old Password">
	</div>

	<div class="form-group">
		<label for="new_password">New Password</label>
		<input type="password" class="form-control" name="new_password" placeholder="Enter new Password">
	</div>


	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_password" value="Update Password">
	</div>

</form>