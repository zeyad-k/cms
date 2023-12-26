<!-- the logic -->
<?php
if (isset($_POST['create_user'])) {

	$user_username = $_POST['user_username'];
	$user_password = $_POST['user_password'];
	// شفر الباس 
	$user_password = password_hash($user_password, PASSWORD_DEFAULT);

	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_email = $_POST['user_email'];

	$user_image = $_FILES['image']['name'];
	$user_image_temp = $_FILES['image']['tmp_name'];

	$user_role = $_POST['user_role'];
	// $post_content = $_POST['post_content'];
	// $post_date = date('d-m-y');


	# function to move the image to the images folder

	move_uploaded_file($user_image_temp, "../images/$user_image");
	# sending the data  to DP
	$query_create_user = "INSERT INTO `users`(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) 
		VALUES ('{$user_username}', '{$user_password}', '{$user_firstname}','{$user_lastname}','{$user_email}', '{$user_image}', '{$user_role}')";

	$create_user_query = mysqli_query($connection, $query_create_user);
	confirmQuery($create_user_query);
	echo "User added" . " <a href='users.php'> View  users</a>";
	//header("location: users.php"); // ارجع للصفحة الرئيسيه



}
;
?>
<!-- # the GUI -->
<form action="" method="post" enctype="multipart/form-data">

	<!-- <div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
	</div> -->

	<!-- <div class="form-group"> -->
	<!-- <select name="post_category" id="post_category"> -->
	<?php
	$query = "SELECT * FROM `categories` ";
	$select_categories = mysqli_query($connection, $query);
	confirmQuery($select_categories);
	while ($row = mysqli_fetch_assoc($select_categories)) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];

		// echo "<option value='{$cat_id}'>{$cat_title}</option> ";
	}
	?>


	</select>
	</div>



	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname" placeholder="Enter Firstname">
	</div>
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" class="form-control" name="user_lastname" placeholder="Enter Lastname">
	</div>

	<div class="form-group">
		<select name="user_role" id="user_id" class="form-group">
			<option value="subscriber">Select Option</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>

	<div class="form-group">
		<label for="user_username">Username</label>
		<input type="text" class="form-control" name="user_username" placeholder="Enter Username">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email" placeholder="Enter Email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password" placeholder="Enter Password">
	</div>
	<!-- الصوره هنشوف هيخزنها فين -->
	<div class="form-group">
		<label for="user_image">User Image</label>
		<input type="file" name="image">
	</div>

	<!-- <div class="form-group">
		<label for="user_role">Role</label>
		<input type="text" class="form-control" name="user_role" placeholder="Enter Role">
	</div> -->


	<!-- <div class="form-group">
		<label for="post_content"> Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10" placeholder="Enter Content">

		</textarea>
	</div> -->

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Insert User">
	</div>





</form>