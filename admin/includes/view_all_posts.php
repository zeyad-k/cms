<?php
if (isset($_POST['checkBoxesArray'])) {
    foreach ($_POST['checkBoxesArray'] as $checkBoxValue) { // السطر ده بيجيب ال id بتاع البوست
        $bulk_options = $_POST['bulk_options'];

        # code...
        switch ($bulk_options) {
            case 'published':
                $publish_query = "UPDATE `posts` SET post_status ='{$bulk_options}' WHERE post_id =$checkBoxValue";
                $publish = mysqli_query($connection, $publish_query);
                confirmQuery($publish);
                # code...
                break;

            case 'draft':
                $draft_query = "UPDATE `posts` SET post_status ='{$bulk_options}' WHERE post_id =$checkBoxValue";
                $draft = mysqli_query($connection, $draft_query);
                confirmQuery($draft);
                # code...
                break;
            case 'delete':
                $delete_query = "DELETE FROM `posts` WHERE post_id =$checkBoxValue";
                $delete = mysqli_query($connection, $delete_query);
                confirmQuery($delete);
                # code...
                break;
            case 'reset_views':
                $reset_query = "UPDATE  `posts` 
                SET post_views_count = 0
                WHERE post_id =$checkBoxValue";
                $reset = mysqli_query($connection, $reset_query);
                confirmQuery($reset);
                # code...
                break;
            case 'clone':
                $clone_query = "SELECT * FROM `posts` WHERE post_id =$checkBoxValue";
                $clone = mysqli_query($connection, $clone_query);
                while ($row = mysqli_fetch_array($clone)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];

                    $post_image = $row['post_image'];

                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = date('d-m-y');



                    $query_create_post = "INSERT INTO `posts`(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
                        VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                    $create_post_query = mysqli_query($connection, $query_create_post);
                    confirmQuery($create_post_query);
                    // $the_post_id_to_edit = mysqli_insert_id($connection);
                    echo "<p class='bg-success'>Clone is done. </p>";

                    # code...
                }
                confirmQuery($clone);
                # code...
                break;

            default:
                # code...
                break;
        }
    }
}
?>
<form action="" method="post">

    <table class="table table-bordered table-hover">

        <div style="padding:0;" id="bulkOptionContainer" class="col-xs-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="reset_views">Reset Views</option>
                <option value="clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input class="btn btn-success" type="submit" value="apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
</form>

<thead>
    <tr>

        <th><input id='selectAllBoxes' type='checkbox'></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Views</th>


    </tr>
</thead>
<tbody>
    <?php // this script is to bring data(about posts) from tha DB an put it into containers 
    
    $query = "SELECT * FROM `posts`  ORDER BY post_id DESC ";
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views = $row['post_views_count'];

        echo "<tr>";
        ?>
        <th><input class='checkBoxes' name='checkBoxesArray[]' value='<?php echo $post_id; ?>' type='checkbox'></th>
        <?php
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";
        # هنربط اخيرا بين الجداول و بعض و هنا هربط الكاتيجوري بنوعها عن طريق ال id بتاعها
        $query = "SELECT * FROM `categories` WHERE cat_id = $post_category_id ";
        $select_categories_id = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>$cat_title</td>";
        }

        echo "<td>$post_status</td>";
        echo "<td><img width='150' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_tags</td>";

        $query = "SELECT* FROM `comments` WHERE comment_post_id= $post_id";
        $query_send = mysqli_query($connection, $query);
        $post_comment_count = mysqli_num_rows($query_send);

        echo "<td><a href='comments.php?source=post_comments&comment_post_id=$post_id'>$post_comment_count</a></td>";


        echo "<td>$post_date</td>";

        echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td>$post_views</td>";
        echo "</tr>";

    }

    ?>
</tbody>
</table>

<!-- # delete post code  -->
<?php

if (isset($_GET['delete'])) {

    $delete_post_id = $_GET['delete'];

    $delete_post_query = "DELETE FROM `posts` WHERE post_id={$delete_post_id}";
    $delete_post_query_send = mysqli_query($connection, $delete_post_query);

    confirmQuery($delete_post_query_send);
    header("location: posts.php"); // بص هنا 


}


?>