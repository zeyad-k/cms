 
<?php include ("includes/header.php") ; ?>


    <div id="wrapper">

        <!-- Navigation -->

        <?php include ("includes/navigation.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
<?php
// add items query
if (isset($_POST['cat_title_add'])) {
    $cat_title = $_POST["cat_title_add"];

    if ($cat_title == "" || empty($cat_title) ||$cat_title == " " ) {
        echo 'This field should not be empty';
    } else {
        $query = "INSERT INTO categories (cat_title) VALUE('{$cat_title}')";

        $create_category_query = mysqli_query($connection, $query);

        if (!$create_category_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        // code to execute if condition is true
    }
}  
?>


<!-- add form  -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title"> Add Category  </label>
                                <input class="form-control" type="text" name="cat_title_add">
                              </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                              </div>
    
                        </form>

                        <?php 
                        if(isset($_GET['edit'])) {

                            $cat_id = $_GET['edit'];

                            include "includes/update.php";
                        }


                        ?>

</div>


                        <!-- table to view categories -->
                        <div class="col-xs-6">
<?php
// find all items query
$query = "SELECT * FROM `categories`";
$select_categories = mysqli_query($connection,$query);
?>

                            <div class="col-xs-12">
                                <table class="table table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php   

// View all items query
while ($row =  mysqli_fetch_assoc($select_categories)) {

$cat_id = $row ['cat_id'];
$cat_title = $row['cat_title'];

echo "<tr>
<td>$cat_id</td>
<td>$cat_title</td>
<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>

</tr>";

    }
?>

<?php 
// delete query
if(isset($_GET['delete'])){

    $the_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}" ;
    $delete_query = mysqli_query($connection,$query) ;
    header ("location: categories.php") ; // بص هنا 
    

}


?>

                                        <!-- <tr>
                                            <td>1</td>
                                            <td>Category 1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Category 2</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>






                        </div>
                       
                             
                          
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<!-- page footer -->
<?php include ("includes/footer.php") ?>