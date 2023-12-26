<!-- the logic -->
<?php
if (isset($_POST['create_post'])) {

	$post_title = $_POST['post_title'];
	$post_author = $_POST['post_author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');


	# function to move the image to the images folder

	move_uploaded_file($post_image_temp, "../images/$post_image");
	# sending the data  to DP
	$query_create_post = "INSERT INTO `posts`(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
		VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

	$create_post_query = mysqli_query($connection, $query_create_post);
	confirmQuery($create_post_query);
	$the_post_id_to_edit = mysqli_insert_id($connection);
	echo "<p class='bg-success'>Post Created. " . "<a href = '../post.php?p_id=$the_post_id_to_edit'>View Post</a> or <a href='./posts.php'>Edit More Posts</a></p>";

	// header("location: posts.php"); // ارجع للصفحة الرئيسيه



}
;
?>
<!-- # the GUI -->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label for="title">Category</label>
		<select name="post_category" id="post_category">
			<?php
			$query = "SELECT * FROM `categories` ";
			$select_categories = mysqli_query($connection, $query);
			confirmQuery($select_categories);
			while ($row = mysqli_fetch_assoc($select_categories)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];

				echo "<option value='{$cat_id}'>{$cat_title}</option> ";
			}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_author">Post Author</label>
		<select name="post_author">
			<?php
			$select_auth = "SELECT * FROM `users` ";
			$send_auth = mysqli_query($connection, $select_auth);
			confirmQuery($send_auth);
			while ($row = mysqli_fetch_assoc($send_auth)) {
				$user_id = $row['user_id'];
				$username = $row['username'];

				echo "<option value='{$username}'>{$username}</option> ";
			}
			?>
		</select>
	</div>


	<!-- <div class="form-group">
		<label for="post_author">Post Author</label>
		<input type="text" class="form-control" name="post_author" placeholder="Enter Author">
	</div> -->

	<div class="form-group">

		<select name="post_status" id="" class="form-control">
			<option value="published">Post Status</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
		</select>

	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags" placeholder="Enter Tags">
	</div>

	<div class="form-group">
		<label for="summernote"> Post Content</label>
		<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"
			placeholder="Enter Content"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>





</form>