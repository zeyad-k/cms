<?php include "includes/header.php"; ?>

<body>

	<!-- Navigation -->
	<?php include "includes/navigation.php"; ?>




	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-8">
				<h1 class="page-header">
					Home
					<small>Hi..</small>
				</h1>


				<!-- php code to get data and display posts -->

				<?php
				// link the database
				

				// get items from categories query.
				if (isset($_GET['category'])) {
					$posts_of_category = $_GET['category'];
					if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
						$query = "SELECT * FROM `posts` WHERE post_category_id= $posts_of_category   ";
					} else {
						$query = "SELECT * FROM `posts` WHERE post_category_id= $posts_of_category AND post_status='published' ";
					}

					$select_all_posts_query = mysqli_query($connection, $query);
					if (mysqli_num_rows($select_all_posts_query) < 1) {
						echo "<H2 class='text-center' >NO POSTS AVAILABLE</H2>";
					} else {
						// View all items
						while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
							$post_id = $row['post_id'];
							$post_title = $row['post_title'];
							$post_author = $row['post_author'];
							$post_date = $row['post_date'];
							$post_tags = $row['post_tags'];
							$post_image = $row['post_image'];
							$post_content = substr($row['post_content'], 0, 150);

							?>




							<!-- First Blog Post -->
							<h2>
								<a href="post.php?p_id=<?php echo $post_id; ?>">
									<?php echo $post_title; ?>
								</a>
							</h2>
							<p class="lead">
								by <a href="index.php">
									<?php echo $post_author ?>
								</a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span>
								<?php echo $post_date; ?>
							</p>
							<hr>
							<h3>
								<?php echo $post_tags; ?>
							</h3>
							<!-- http://source.unsplash.com/random/900x300" -->
							<img class="img-responsive" src=" images/<?php echo $post_image; ?>" alt="فيه مشكله">
							<hr>


							<p>
								<?php echo $post_content; ?>
							</p>

							<a class="btn btn-primary" href="#">Read More <span
									class="glyphicon glyphicon-chevron-right"></span></a>


							<hr>






						<?php }
					}
				} else {
					header("Location: index.php");
				} ?>


				<!-- Second Blog Post -->
				<!-- Third Blog Post -->
				<!-- are in includes/fff.php -->


				<!-- Pager -->
				<ul class="pager">

				</ul>

			</div>





			<!-- Blog Sidebar Widgets Column -->
			<?php include "includes/blogsidebar.php"; ?>


			<!-- Footer -->
			<?php include "includes/footer.php"; ?>

		</div>
		<!-- /.container -->

		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

</body>

</html>