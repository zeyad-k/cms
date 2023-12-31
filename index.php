<?php include "includes/header.php"; ?>

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
				$per_page = 3;

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				} else {
					$page = '';
				}
				if ($page == '' || $page == 1) {
					$page_1 = 0;
				} else {
					$page_1 = ($page * $per_page) - $per_page;

				}

				if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

					$query_c = "SELECT * FROM `posts`  ";
				} else {
					$query_c = "SELECT * FROM `posts`  WHERE post_status = 'published'   ";
				}
				$find_count_query = mysqli_query($connection, $query_c);
				$count = mysqli_num_rows($find_count_query);
				if ($count < 1) {
					echo "<H2 class='text-center' >NO POSTS AVAILABLE</H2>";
				} else {
					$count = ceil($count / 2);
					$query = "SELECT * FROM `posts`  LIMIT $page_1,$per_page # WHERE post_status ='published'  ";
					$select_all_posts_query = mysqli_query($connection, $query);
					?>
					<h1 class="page-header">
						Home
						<small>Hi..</small>
						<?php // echo $count; ?>

					</h1>
					<?php
					// View all items
					while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
						$post_id = $row['post_id'];
						$post_title = $row['post_title'];
						$post_author = $row['post_author'];
						$post_date = $row['post_date'];
						$post_tags = $row['post_tags'];
						$post_image = $row['post_image'];
						$post_content = substr($row['post_content'], 0, 150);
						$post_status = $row['post_status'];
						if ($post_status == 'published') {

							?>



							<!-- First Blog Post -->
							<h2>
								<a href="post.php?p_id=<?php echo $post_id; ?>">
									<?php echo $post_title; ?>
								</a>
							</h2>
							<p class="lead">
								by <a href="author.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>">
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
							<a href="post.php?p_id=<?php echo $post_id; ?>">
								<img class="img-responsive" src=" images/<?php echo $post_image; ?>" alt="فيه مشكله">
							</a>
							<hr>


							<p>
								<?php echo $post_content; ?>
							</p>

							<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
									class="glyphicon glyphicon-chevron-right"></span></a>


							<hr>


						<?php }
					}
				} ?>


				<!-- Second Blog Post -->
				<!-- Third Blog Post -->
				<!-- are in includes/fff.php -->


				<!-- Pager -->
				<ul class="pager">

					</li>
					<?php
					for ($i = 1; $i < $count; $i++) {
						if ($i == $page) {
							echo "<li><a class='active-link' href='index.php?page=$i'>{$i}</a></li>";
						} else {
							echo "<li><a href='index.php?page=$i'>{$i}</a></li>";

						}
						# code...
					}
					?>

				</ul>


			</div>





			<!-- Blog Sidebar Widgets Column -->
			<?php include "includes/blogsidebar.php"; ?>

			<!-- <ul class="pager">
				<?php
				for ($i = 1; $i <= $count; $i++) {
					echo "<li><a href='index.php?page=$i'>{$i}</a></li>";
					# code...
				}
				?>

			</ul> -->
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