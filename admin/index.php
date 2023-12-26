<?php include("includes/header.php"); ?>
<?php
$session = session_id();
$time = time();
$time_out_in_secondes = 30;
$time_out = $time - $time_out_in_secondes;

$query = "SELECT * FROM `online_users` WHERE session = '$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);
if ($count == null) {
    mysqli_query($connection, "INSERT INTO `online_users`(session,time)
  VALUES('{$session}','{$time}')  ");
} else {
    mysqli_query($connection, "UPDATE `online_users` SET time ='{$time}'
    WHERE session = '{$session}' ");
}
$users_online = mysqli_query($connection, "SELECT * FROM `online_users` WHERE time > '{$time_out}'");
$count_users = mysqli_num_rows($users_online);
?>
<?php
function getRowCount($table, $connection)
{
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}



?>

<?php
if (!isset($_SESSION['user_role'])) {

    header("location: ../index.php");
}
?>



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
                        <?php echo $count_users; ?>
                        <small>
                            <?php echo $_SESSION['username']; ?>
                        </small>
                    </h1>



                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $gey_all_posts_query = "SELECT * FROM `posts`";
                                    $gey_all_posts = mysqli_query($connection, $gey_all_posts_query);
                                    $posts_count = mysqli_num_rows($gey_all_posts);
                                    echo " <div class='huge'>$posts_count</div>"
                                        ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $gey_all_comments_query = "SELECT * FROM `comments`";
                                    $gey_all_comments = mysqli_query($connection, $gey_all_comments_query);
                                    $comments_count = mysqli_num_rows($gey_all_comments);
                                    echo " <div class='huge'>$comments_count</div>"
                                        ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $users_count = getRowCount('users', $connection);
                                    echo "<div class='huge'>$users_count</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $categories_count = getRowCount('categories', $connection);
                                    echo "<div class='huge'>$categories_count</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row  -->
            <!-- code of charts -->
            <?php
            // posts            
            $active_posts_query = "SELECT * FROM `posts` WHERE post_status ='published' ";
            $gey_active_posts = mysqli_query($connection, $active_posts_query);
            $active_posts_count = mysqli_num_rows($gey_active_posts);

            $draft_posts_query = "SELECT * FROM `posts` WHERE post_status ='draft' ";
            $gey_draft_posts = mysqli_query($connection, $draft_posts_query);
            $draft_posts_count = mysqli_num_rows($gey_draft_posts);
            // comments
            $approved_comments_query = "SELECT * FROM `comments` WHERE comment_status ='approved' ";
            $approved_comments = mysqli_query($connection, $approved_comments_query);
            $approved_comment_count = mysqli_num_rows($approved_comments);

            $unapproved_comments_query = "SELECT * FROM `comments` WHERE comment_status ='unapproved' ";
            $unapproved_comments = mysqli_query($connection, $unapproved_comments_query);
            $unapproved_comment_count = mysqli_num_rows($unapproved_comments);
            // users
            $admin_users_query = "SELECT * FROM `users` WHERE user_role ='admin' ";
            $admin_users = mysqli_query($connection, $admin_users_query);
            $admin_count = mysqli_num_rows($admin_users);

            $subscriber_users_query = "SELECT * FROM `users` WHERE user_role ='subscriber' ";
            $subscriber_users = mysqli_query($connection, $subscriber_users_query);
            $subscriber_count = mysqli_num_rows($subscriber_users);

            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['bar'] });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = [
                                'All Posts', 'Active Posts', 'Draft Posts',
                                'All Comments', 'Approved Comments', 'Unapproved Comm',
                                'All Users', 'Admins', 'Subscriber',
                                'Categories'];
                            $element_count = [
                                $posts_count, $active_posts_count, $draft_posts_count,
                                $comments_count, $approved_comment_count, $unapproved_comment_count,
                                $users_count, $admin_count, $subscriber_count,
                                $categories_count,
                            ];
                            for ($i = 0; $i < 10; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                            ?>
                            //  ['Posts', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: ' ',
                                subtitle: ' ',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>

            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- page footer -->
<?php include("includes/footer.php") ?>