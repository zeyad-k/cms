<?php include("includes/header.php"); ?>
<?php
if (isset($_SESSION['username'])) {

	echo $username = $_SESSION['username'];

	$query_get_user = "SELECT * FROM `users` WHERE username = '{$username}' ";
	$query_get_user_send = mysqli_query($connection, $query_get_user);
	while ($row = mysqli_fetch_array($query_get_user_send)) {
		$user_id = $row['user_id'];
		$username = $row['username'];
		// $dp_user_password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		$user_image = $row['user_image'];
		// $user_role = $row['user_role'];



	}
} ?>


<div id="wrapper">

	<!-- Navigation -->

	<?php include("includes/navigation.php") ?>

	<!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">


					<h1 class="page-header">
						Welcome to Admin
						<small>profile</small>
					</h1>


					<?php


					if (isset($_POST['edit_user'])) {

						$user_username = $_POST['user_username'];
						$user_password = $_POST['user_password'];
						$user_firstname = $_POST['user_firstname'];
						$user_lastname = $_POST['user_lastname'];
						$user_password = $_POST['user_password'];
						$user_email = $_POST['user_email'];

						$user_image = $_FILES['image']['name'];
						$user_image_temp = $_FILES['image']['tmp_name'];

						if (!empty($user_password)) {
							$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
							$query = "UPDATE `users` SET user_password = '{$user_password}' WHERE username = '{$user_username}'";
							$update_pass = mysqli_query($connection, $query);
						}
						// $user_role = $_POST['user_role'];
						# function to move the image to the images folder
					
						move_uploaded_file($user_image_temp, "../images/$user_image");
						if (empty($user_image)) {
							$query_image = "select * from `users` where username = '{$username}' ";
							$select_image_by_id = mysqli_query($connection, $query_image);

							while ($row = mysqli_fetch_array($select_image_by_id)) {
								$user_image = $row['user_image'];

							}
						}
						# sending the data  to DP
						$query_update_user = "UPDATE `users` SET 
						username ='{$user_username}', 
						user_firstname= '{$user_firstname}', 
						user_lastname= '{$user_lastname}', 
						user_email= '{$user_email}', 
						user_image = '{$user_image}' 
					WHERE username = '{$user_username}'";


						$update_user_query = mysqli_query($connection, $query_update_user);
						confirmQuery($update_user_query);

						header("location: users.php"); // ده هيبعتنا للصفحة الرئيسيه
					

					}
					?>
					<!-- # the GUI Edit posts -->
					<form action="" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="user_firstname">Firstname</label>
							<input type="text" value="<?php echo $user_firstname; ?>" class="form-control"
								name="user_firstname">
						</div>
						<div class="form-group">
							<label for="user_lastname">Lastname</label>
							<input type="text" value="<?php echo $user_lastname; ?>" class="form-control"
								name="user_lastname">
						</div>

						<!-- <div class="form-group">
							<select name="user_role" id="user_id" class="form-group">
								<option value="<?php // echo $user_role; ?>">
									<?php //echo $user_role; ?>
								</option>
								<option value="admin">Admin</option>
								<option value="subscriber">Subscriber</option>
							</select>
						</div> -->
						<div class="form-group">
							<label for="user_email">Email</label>
							<input type="email" value="<?php echo $user_email; ?>" class="form-control"
								name="user_email">
						</div>
						<div class="form-group">
							<label for="user_username">Username</label>
							<input type="text" value="<?php echo $username; ?>" class=" form-control"
								name="user_username">
						</div>

						<div class="form-group">
							<label for="user_password">Password</label>
							<input type="password" class=" form-control" name="user_password">
						</div>


						<!-- الصوره هنشوف هيخزنها فين -->
						<div class="form-group">
							<label for="user_image">User Image</label>
							<img width="100" src="../images/<?php echo $user_image; ?>" type="file" name="image">
							<input type="file" name="image">
						</div>





						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
						</div>





					</form>





				</div>
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- page footer -->
<?php include("includes/footer.php") ?>