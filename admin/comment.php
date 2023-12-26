<?php include "./includes/header.php"; ?>
<?php
// function confirmQuery($qu)
// {
// 	if (!$qu) {
// 		global $connection;
// 		die("QUERY FAILED ." . mysqli_error($connection));
// 	}
// }
?>

<body>

	<!-- Navigation -->
	<?php include "includes/navigation.php"; ?>




	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-8">


				<!-- php code to get data and display posts -->

				<?php

				// link the database
				



				// get items from categories query.
				// $query = "SELECT * FROM `comments` WHERE comment_id = $selected_comment_id ";
				// $select_all_posts_query = mysqli_query($connection, $query);
				// $row = mysqli_fetch_array($select_all_posts_query);
				// $comment_id = $row['comment_post_id'];
				// $query = "SELECT* FROM `comments` WHERE comment_post_id= $comment_id";
				// $query_send = mysqli_query($connection, $query);
				
				// // View all comments
				// while ($row2 = mysqli_fetch_assoc($query_send)) {
				// 	$post_title = $row['post_title'];
				// 	$post_author = $row['post_author'];
				// 	$post_date = $row['post_date'];
				// 	$post_tags = $row['post_tags'];
				// 	$post_image = $row['post_image'];
				// 	$post_content = $row['post_content'];
				
				?>












				<!-- Comments Form -->
				<div class="well">
					<h4>Leave a Comment:</h4>
					<form role="form" action="" method="post">

						<div class="form-group">
							<label for="author">Author</label>
							<input type="text" name="comment_author" class="form-control">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="comment_email" class="form-control">
						</div>

						<div class="form-group">
							<label for="comment_content">Your comment</label>
							<textarea name="comment_content" class="form-control" rows="3"></textarea>
						</div>
						<button type="submit" name="create_comment" class="btn btn-primary">Create Comment</button>
					</form>
				</div>

				<hr>

				<!-- Posted Comments -->
				<?php // this script is to bring comments related to this post  -from tha DB- and  display the approved onces 
				if (isset($_GET['comment_id'])) {
					$selected_comment_id = $_GET['comment_id'];
				}

				$query = "SELECT * FROM `comments` WHERE comment_id = {$selected_comment_id}  AND comment_status = 'approved' ORDER BY  comment_id DESC ";
				$select_comments = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($select_comments)) {
					$comment_author = $row['comment_author'];
					$comment_content = $row['comment_content'];
					$comment_date = $row['comment_date'];
					// ده عشان يخلي كل كومن بصوره مختلفه عن التاني
				
					$seed = rand();
					$image_url = "https://source.unsplash.com/random/64x64?sig=$seed";
					?>
					<!-- Comment -->
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src='<?php echo $image_url; ?>' alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">
								<?php echo $comment_author; ?>
								<small>
									<?php echo $comment_date; ?>
								</small>
							</h4>
							<?php echo $comment_content; ?>
						</div>
					</div>
				<?php }
				?>
			</div>


			<!-- Blog Sidebar Widgets Column -->
			<?php // include "../includes/blogsidebar.php"; ?>


			<!-- Footer -->
			<?php //include "../includes/footer.php"; ?>

		</div>
		<!-- /.container -->

		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

</body>

</html>