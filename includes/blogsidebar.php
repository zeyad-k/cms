<!-- blog side bar search widgets Columns -->




<?php
if (ifItIsMethod('post')) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        login_user($_POST['username'], $_POST['password']);
    } else {
        redirect('index');
    }
}
?>

<div class="col-md-4">





    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <!--  search form -->
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- log in form -->
    <div class="well">
        <?php if (isset($_SESSION['user_role'])): ?>
            <h4>Logged in as
                <?php echo $_SESSION['username']; ?>
            </h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>

        <?php else: ?>
            <h4>LOG-IN</h4>
            <!--  search form -->
            <!-- <form action="includes/login.php" method="post"> -->
            <form method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter password">

                    <span class="input-group-btn">
                        <button name="login" type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </span>
                </div>
            </form>


        <?php endif; ?>

        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <?php

        $query = "SELECT * FROM `categories`";
        $select_categories_sidebar = mysqli_query($connection, $query);

        ?>

        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php

                    // View all items
                    
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $catTitle = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li>
                                <a href='category.php?category={$cat_id}'>{$catTitle}</a>
                                  </li>";
                        # code...c
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include("includes/sideWidget.php") ?>