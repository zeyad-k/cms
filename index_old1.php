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
                

                // get items from categories query.
                $query = "SELECT * FROM `posts` # WHERE post_status ='published'  ";
                $select_all_posts_query = mysqli_query($connection, $query);

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


                        <h1 class="page-header">
                            Home
                            <small>Hi..</small>
                        </h1>

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
                } ?>


                <!-- Second Blog Post -->
                <!-- Third Blog Post -->
                <!-- are in includes/fff.php -->


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
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