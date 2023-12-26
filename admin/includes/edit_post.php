<?php
if (isset($_GET['p_id'])) {
	$the_post_id_to_edit = $_GET['p_id'];

	// getting the data of the post by the id
	$query = "SELECT * FROM `posts` WHERE post_id =$the_post_id_to_edit";
	$select_posts_by_id = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
		$post_id = $row['post_id'];
		$post_author = $row['post_author'];
		$post_title = $row['post_title'];
		$post_category_id = $row['post_category_id'];
		$post_status = $row['post_status'];
		$post_image = $row['post_image'];
		$post_tags = $row['post_tags'];
		$post_comment_count = $row['post_comment_count'];
		$post_date = $row['post_date'];
		$post_content = $row['post_content'];
	}
}

if (isset($_POST['update_post'])) {

	$post_title = $_POST['post_title'];
	$post_author = $_POST['post_author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	$post_comment_count = 4;

	# function to move the image to the images folder

	move_uploaded_file($post_image_temp, "../images/$post_image");
	if (empty($post_image)) {
		$query_image = "select * from `posts` where post_id = $the_post_id_to_edit";
		$select_image_by_id = mysqli_query($connection, $query_image);

		while ($row = mysqli_fetch_array($select_image_by_id)) {
			$post_image = $row['post_image'];

		}
	}
	# sending the data  to DP
	$query_update_post = "UPDATE `posts` SET 
    post_category_id = {$post_category_id}, 
    post_title = '{$post_title}', 
    post_author = '{$post_author}', 
    post_date = now(), 
    post_image = '{$post_image}', 
    post_content = '{$post_content}', 
    post_tags = '{$post_tags}', 
    post_comment_count = {$post_comment_count}, 
    post_status = '{$post_status}'
    WHERE post_id = {$the_post_id_to_edit}";



	$update_post_query = mysqli_query($connection, $query_update_post);
	confirmQuery($update_post_query);
	echo "<p class='bg-success'>Post Updated. " . "<a href = '../post.php?p_id=$the_post_id_to_edit'>View Post</a> or <a href='./posts.php'>Edit More Posts</a></p>";

	//header("location: posts.php"); // ده هيبعتنا للصفحة الرئيسيه


}
?>
<!-- # the GUI Edit posts -->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label for="post_category">Post Category</label>

		<select name="post_category" id="post_category">
			<?php
			$query_cat = mysqli_query($connection, "SELECT cat_title FROM `categories`  WHERE cat_id =$post_category_id");
			confirmQuery($query_cat);
			$row_cat = mysqli_fetch_assoc($query_cat);
			$post_category = $row_cat['cat_title'];

			echo "<option value='{$post_category_id}'>{$post_category}</option> ";
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

	<!-- <div class="form-group">
		<label for="post_category">Post Category Id</label>
		<input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
	</div> -->

	<div class="form-group">
		<label for="post_author">Post Author</label>
		<select name="post_author">

			<?php
			echo "<option value='{$post_author}'>{$post_author}</option> ";

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
		<label for="post_status">Post Status</label>
		<input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status"
			placeholder="Enter Status">
	</div> -->

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select class="form-control" name="post_status">
			<option value="<?php echo $post_status; ?>">
				<?php echo $post_status; ?>
			</option>
			<?php
			if ($post_status == 'published') {
				echo "<option value='draft'>Draft</option>";
			} else if ($post_status == 'draft') {
				echo "<option value='published'>Publish</option>";
			}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<img width="100" src="../images/<?php echo $post_image; ?>" type="file" name="image">
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags"
			placeholder="Enter Tags">
	</div>

	<div class="form-group">
		<label for="summernote"> Post Content</label>
		<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"
			placeholder="Enter Content"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
	</div>

</form>