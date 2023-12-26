<?php include("includes/header.php"); ?>


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
						Welcome to Post
						<small>Author</small>
					</h1>

					<?php
					if (isset($_GET['source'])) {
						$source = $_GET['source'];
					} else {
						$source = '';
					}

					switch ($source) {
						case 'add_post':
							include "includes/add_post.php";
							break;

						case 'post_comments':
							include "includes/post_comments.php";
							break;

						case '200':
							echo 'Nice 200!';
							break;

						default:
							include "includes/view_all_comments.php";
							break;
					}


					?>




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