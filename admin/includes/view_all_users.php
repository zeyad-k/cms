<table class="table table-bordered table-hover">
	<thead>
		<tr>
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

			// Fetch the post ID associated with the comment
			// $query = "SELECT user_id FROM `users` WHERE user_id = {$user_id}";
			// $result = mysqli_query($connection, $query);
			// $row = mysqli_fetch_assoc($result);
			// $post_id = $row['comment_post_id'];

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