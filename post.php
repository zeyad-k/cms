<?php include "includes/header.php"; ?>
<?php
function confirmQuery($qu)
{
    if (!$qu) {
        global $connection;
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}
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
                if (isset($_GET['p_id'])) {
                    $selected_post_id = $_GET['p_id'];
                    $view_query = "UPDATE `posts` 
                    SET post_views_count = post_views_count+1 
                    WHERE post_id =   $selected_post_id ";
                    $view = mysqli_query($connection, $view_query);
                    confirmQuery($view);

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $query = "SELECT * FROM `posts` WHERE post_id = $selected_post_id ";
                    } else {
                        $query = "SELECT * FROM `posts` WHERE post_id = $selected_post_id AND post_status = 'published' ";

                    }
                    $select_all_posts_query = mysqli_query($connection, $query);
                    if (mysqli_num_rows($select_all_posts_query) < 1) {
                        echo "<h1>No posts available</h1>";
                    } else {





                        // get items from categories query.
                
                        // View all items
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_tags = $row['post_tags'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                            ?>


                            <h1 class="page-header">
                                Home
                                <small>Hi..</small>
                            </h1>

                            <!-- First Blog Post -->
                            <h2>
                                <a href="#">
                                    <?php echo $post_title; ?>
                                </a>
                            </h2>
                            <p class="lead">
                                by <a href="author.php?author=<?php echo $post_author ?>&p_id=<?php echo $selected_post_id ?>">
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
                            <a href="post.php?p_id=<?php echo $selected_post_id; ?>">
                                <img class="img-responsive" src=" images/<?php echo $post_image; ?>" alt="فيه مشكله">
                            </a>
                            <hr>

                            <p>
                                <?php echo $post_content; ?>
                            </p>



                            <hr>






                        <?php }
                    }
                } else {
                    header("location: index.php"); // بص هنا 
                }
                ?>
                <!-- #الجديد -->
                <!-- Blog Comments -->
                <?php
                if (isset($_POST['create_comment'])) {

                    $selected_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        $add_comment = "INSERT INTO `comments` 
                        (comment_post_id,comment_author, comment_email,comment_content,comment_status,comment_date )
                        VALUES ({$selected_post_id},'{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                        $add_comment_query = mysqli_query($connection, $add_comment);
                        if (!$add_comment_query) {
                            die("QUERY FAILED ." . mysqli_error($connection));
                        } else {
                            // $query = "UPDATE `posts`
                            // SET post_comment_count = post_comment_count + 1 
                            // WHERE post_id = $selected_post_id ";
                            // $increase_comments_counter = mysqli_query($connection, $query);
                
                        }

                        // confirmQuery($add_comment);  // عايز حل لانها مش قاريه هنا 
                    } else {
                        echo "<script>alert('These fields can`t be empty')</script>";

                    }
                    // header("location: post.php?p_id=$selected_post_id"); // بص هنا 
                
                }

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
                
                $query = "SELECT * FROM `comments` WHERE comment_post_id = {$selected_post_id}  AND comment_status = 'approved' ORDER BY  comment_id DESC ";
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
                <?php } ?>
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