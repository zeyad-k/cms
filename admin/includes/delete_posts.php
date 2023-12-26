<!-- # delete post code  -->
<?php 

    if (isset($_GET['delete'])) {

        $delete_post_id = $_GET['delete'];

        $delete_post_query = "DELETE FROM `posts` WHERE post_id={$delete_post_id}";
        $delete_post_query_send = mysqli_query($connection,$delete_post_query);

        confirmQuery($delete_post_query_send);
        header ("location: posts.php") ; // بص هنا 
    
 
    }


?>