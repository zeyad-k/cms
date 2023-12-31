<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                // link the database
                include "dp.php";
                session_start();


                // get items from categories query.
                $query = "SELECT * FROM `categories`";
                $selectAllItemsFromCategories = mysqli_query($connection, $query);

                // View all items
                while ($row = mysqli_fetch_assoc($selectAllItemsFromCategories)) {
                    $catTitle = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    if (isset($cat_id) && isset($catTitle)) {
                        echo "<li><a href='category.php?category={$cat_id}'>{$catTitle}</a></li>";
                    } else {
                        echo "<li><a href='#'>Category not available</a></li>";

                    }
                }

                ?>

                <li>
                    <a class="active" href="admin">Admin</a>
                </li>
                <li>
                    <a class="active" href="registration.php">Registration</a>
                </li>
                <li>
                    <a class="active" href="contact.php">Contact</a>
                </li>

                <?php
                if (isset($_SESSION['user_role'])) {
                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        echo "<li>
                        <a href='admin/posts.php?source=edit_post&p_id=$the_post_id '>
                        Edit Post
                        </a>
                                 </li>
                                            ";
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>