<?php
if (isset($_GET['user_id'])) {
	$the_user_id_to_edit = $_GET['user_id'];

	// getting the data of the post by the id
	$query = "SELECT * FROM `users` WHERE user_id =$the_user_id_to_edit";
	$select_user_by_id = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_user_by_id)) {
		$user_id = $row['user_id'];
		$username = $row['username'];
		// $user_password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		$user_image = $row['user_image'];
		$user_role = $row['user_role'];
	}
}

if (isset($_POST['edit_user'])) {

	$user_username = $_POST['user_username'];
	// $user_password = $_POST['user_password'];
	// // شفر الباس 
	// $user_password = password_hash($user_password, PASSWORD_DEFAULT);

	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_email = $_POST['user_email'];

	$user_image = $_FILES['image']['name'];
	$user_image_temp = $_FILES['image']['tmp_name'];

	$user_role = $_POST['user_role'];
	# function to move the image to the images folder

	move_uploaded_file($user_image_temp, "../images/$user_image");
	if (empty($user_image)) {
		$query_image = "select * from `users` where user_id = $the_user_id_to_edit";
		$select_image_by_id = mysqli_query($connection, $query_image);

		while ($row = mysqli_fetch_array($select_image_by_id)) {
			$user_image = $row['user_image'];

		}
	}
	# sending the data  to DP
	$query_update_user = "UPDATE `users` SET 
    username ='{$user_username}', 
    -- user_password= '{$user_password}', 
    user_firstname= '{$user_firstname}', 
    user_lastname= '{$user_lastname}', 
    user_email= '{$user_email}', 

    user_image = '{$user_image}', 
	user_role= '{$user_role}'
	 WHERE user_id = {$the_user_id_to_edit}";



	$update_user_query = mysqli_query($connection, $query_update_user);
	confirmQuery($update_user_query);

	header("location: users.php"); // ده هيبعتنا للصفحة الرئيسيه


}
?>
<!-- # the GUI Edit posts -->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<select name="user_role" id="user_id" class="form-group">
			<option value="<?php echo $user_role; ?>">
				<?php echo $user_role; ?>
			</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
	</div>
	<div class="form-group">
		<label for="user_username">Username</label>
		<input type="text" value="<?php echo $username; ?>" class=" form-control" name="user_username">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<h5><a href="users.php?source=edit_password&user_id=<?php echo $the_user_id_to_edit; ?>"
				class="btn btn-primary">Edit Password</a></h5>
		<!-- <input type="password" value="<?php // echo $user_password; ?>" class=" form-control" name="user_password"> -->
	</div>


	<!-- الصوره هنشوف هيخزنها فين -->
	<div class="form-group">
		<label for="user_image">User Image</label>
		<img width="100" src="../images/<?php echo $user_image; ?>" type="file" name="image">
		<input type="file" name="image">
	</div>
	<!-- 
	<div class="form-group">
		<label for="user_role">Role</label>
		<input type="text" value="<?php // echo $user_role; ?>" class="form-control" name="user_role">
	</div> -->


	<!-- <div class="form-group">
		<label for="post_content"> Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10" placeholder="Enter Content">

		</textarea>
	</div> -->

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
	</div>





</form>