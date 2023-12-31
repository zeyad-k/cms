<?php
if (!isAdmin($_SESSION['username'])) {

	header("Location: index.php");

}
if (isset($_POST['checkBoxesArray_us'])) {
	foreach ($_POST['checkBoxesArray_us'] as $checkBoxValue) { // السطر ده بيجيب ال id بتاع البوست
		$bulk_options_us = $_POST['bulk_options_us'];


		switch ($bulk_options_us) {
			case 'admin':
				$admin_query = "UPDATE `users` SET user_role ='{$bulk_options_us}' WHERE user_id =$checkBoxValue";
				$admin = mysqli_query($connection, $admin_query);
				confirmQuery($admin);
				break;

			case 'subscriber':
				$subscriber_query = "UPDATE `users` SET user_role ='{$bulk_options_us}' WHERE user_id =$checkBoxValue";
				$subscriber = mysqli_query($connection, $subscriber_query);
				confirmQuery($subscriber);
				break;
			case 'delete':
				$delete_query = "DELETE FROM `users` WHERE user_id =$checkBoxValue";
				$delete = mysqli_query($connection, $delete_query);
				confirmQuery($delete);
				break;
			case 'clone':
				$clone_query = "SELECT * FROM `users` WHERE user_id =$checkBoxValue";
				$clone = mysqli_query($connection, $clone_query);
				while ($row = mysqli_fetch_array($clone)) {
					$user_id = $row['user_id'];
					$username = $row['username'];
					$user_password = $row['user_password'];
					$user_firstname = $row['user_firstname'];
					$user_lastname = $row['user_lastname'];
					$user_email = $row['user_email'];
					$user_image = $row['user_image'];
					$user_role = $row['user_role'];





					$query_create_user = "INSERT INTO `users`(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) 
					VALUES ('{$username}', '{$user_password}', '{$user_firstname}','{$user_lastname}','{$user_email}', '{$user_image}', '{$user_role}')";

					$create_user_query = mysqli_query($connection, $query_create_user);
					confirmQuery($create_user_query);
					echo "User added" . " <a href='users.php'> View  users</a>";
				}
				confirmQuery($clone);
				# code...
				break;

			default:
				# code...
				break;
		}
	}
}
?>

<form action="" method="post">
	<table class="table table-bordered table-hover">

		<div style="padding:0;" id="bulkOptionContainer" class="col-xs-4">
			<select name="bulk_options_us" id="" class="form-control">
				<option value="">Select Option</option>
				<option value="admin">Admin</option>
				<option value="subscriber">Subscriber</option>
				<option value="delete">Delete</option>
				<option value="clone">Clone</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input class="btn btn-success" type="submit" value="apply">
			<a class="btn btn-primary" href="users.php?source=add_user">Add New</a>
		</div>
</form>

<thead>
	<tr>
		<th><input id='selectAllBoxes_us' type='checkbox'></th>
		<th>Id</th>
		<th>Username</th>
		<!-- <th>Password</th> -->
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Image</th>
		<th>Role</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
</thead>
<tbody>
	<?php // this script is to bring data(about posts) from tha DB an put it into containers 
	
	$query = "SELECT * FROM `users`  ORDER BY user_id DESC";
	$select_users = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_users)) {
		$user_id = $row['user_id'];
		$username = $row['username'];
		$user_password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		$user_image = $row['user_image'];
		$user_role = $row['user_role'];



		echo "<tr>";
		?>
		<th><input class='checkBoxes_us' name='checkBoxesArray_us[]' value='<?php echo $user_id; ?>' type='checkbox'></th>
		<?php
		echo "<td>$user_id</td>";
		echo "<td>$username</td>";
		// echo "<td>$user_password</td>";
		echo "<td>$user_firstname</td>";
		echo "<td>$user_lastname</td>";
		echo "<td>$user_email</td>";
		echo "<td><img width='150' src='../images/$user_image' alt='user_image'></td>";
		echo "<td>$user_role</td>";





		echo "<td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>";
		echo "<td><a onclick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete=$user_id'>Delete</a></td>";
		echo "<td><a href='users.php?c_t_admin=$user_id'>Admin</a></td>";
		echo "<td><a href='users.php?c_t_sub=$user_id'>Subscriber</a></td>";

		echo "</tr>";

	}

	?>
</tbody>
</table>

<!-- # delete post code  -->
<?php

if (isset($_GET['delete'])) {
	if (isset($_SESSION['user_role'])) {
		if ($_SESSION['user_role'] == 'admin') {
			$delete_user_id = $_GET['delete'];



			$delete_user_query = "DELETE FROM `users` WHERE user_id={$delete_user_id}";
			$delete_user_query_send = mysqli_query($connection, $delete_user_query);

			if (!$delete_user_query_send) {
				die("QUERY FAILED ." . mysqli_error($connection));
			} else {
				// $d_query = "UPDATE `posts`
				// SET post_comment_count = post_comment_count - 1 
				// WHERE post_id = $post_id ";
				// $decrease_comments_counter = mysqli_query($connection, $d_query);

			}


			// confirmQuery($delete_comment_query_send);
			header("location: users.php"); // بص هنا 
		}
	}
}


?>

<!-- # Change to admin code  -->
<?php

if (isset($_GET['c_t_admin'])) {

	$c_t_admin_id = $_GET['c_t_admin'];

	$c_t_admin_query = "UPDATE `users`
	SET user_role = 'admin'
	WHERE user_id = {$c_t_admin_id}";
	$c_t_admin_query_send = mysqli_query($connection, $c_t_admin_query);

	confirmQuery($c_t_admin_query_send);
	header("location: users.php"); // بص هنا 
}
?>

<!-- # Change to subscriber code  -->
<?php

if (isset($_GET['c_t_sub'])) {

	$c_t_sub_id = $_GET['c_t_sub'];

	$c_t_sub_query = "UPDATE `users`
	SET user_role = 'subscriber'
	WHERE user_id = {$c_t_sub_id}";
	$c_t_sub_query_send = mysqli_query($connection, $c_t_sub_query);

	confirmQuery($c_t_sub_query_send);
	header("location: users.php"); // بص هنا 
}
?>

<!-- # Unapprove comment code  -->

<?php

if (isset($_GET['unapprove'])) {

	$unapproved_comment_id = $_GET['unapprove'];

	$unapproved_comment_query = "UPDATE `comments`
	SET comment_status = 'unapproved'
	WHERE comment_id = {$unapproved_comment_id}";
	$unapproved_comment_query_send = mysqli_query($connection, $unapproved_comment_query);

	confirmQuery($unapproved_comment_query_send);
	header("location: comments.php"); // بص هنا 
}
?>
<script>

	$(document).ready(function () {
		$("#selectAllBoxes_us").click(function (event) {
			if (this.checked) {
				$(".checkBoxes_us").each(function () {
					this.checked = true;
				});
			} else {
				$(".checkBoxes_us").each(function () {
					this.checked = false;
				});
			}
		});
	});

</script>