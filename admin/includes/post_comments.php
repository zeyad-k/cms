<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Comment</th>
			<th>Email</th>
			<th>Status</th>
			<th>In Response to</th>
			<th>Date</th>
			<th>Approve</th>
			<th>Un Approve</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php // this script is to bring data(about posts) from tha DB an put it into containers 
		if (isset($_GET['comment_post_id'])) {
			$comment_post_id = $_GET['comment_post_id'];
			$comment_post_id = mysqli_real_escape_string($connection, $comment_post_id);

		}
		$query = "SELECT * FROM `comments`  WHERE comment_post_id = $comment_post_id ORDER BY comment_id DESC";
		$select_comments = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($select_comments)) {
			$comment_id = $row['comment_id'];
			$comment_post_id = $row['comment_post_id'];
			$comment_author = $row['comment_author'];
			$comment_email = $row['comment_email'];
			$comment_content = $row['comment_content'];
			$comment_status = $row['comment_status'];
			$comment_date = $row['comment_date'];


			echo "<tr>";
			echo "<td>$comment_id</td>";
			echo "<td>$comment_author</td>";
			echo "<td>$comment_content</td>";


			# هنربط اخيرا بين الجداول و بعض و هنا هربط الكاتيجوري بنوعها عن طريق ال id بتاعها
			// $query = "SELECT * FROM `categories` WHERE cat_id = $post_category_id ";
			// $select_categories_id = mysqli_query($connection, $query);
			// while ($row = mysqli_fetch_assoc($select_categories_id)) {
			// 	$cat_id = $row['cat_id'];
			// 	$cat_title = $row['cat_title'];
		
			// 	echo "<td>$cat_title</td>";
			// }
		
			echo "<td>$comment_email</td>";
			echo "<td>$comment_status</td>";
			$query = "SELECT * FROM `posts` WHERE post_id = $comment_post_id";
			$get_title_of_post_query = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_assoc($get_title_of_post_query)) {


				$post_id = $row['post_id'];
				$post_title = $row['post_title'];
				echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";


			}



			echo "<td>$comment_date</td>";
			echo "<td><a href='comments.php?source=post_comments&approve={$comment_id}&comment_post_id=$post_id'>Approve</a></td>";
			echo "<td><a href='comments.php?source=post_comments&unapprove={$comment_id}&comment_post_id=$post_id'>Unapproved</a></td>";
			echo "<td><a href='comments.php?source=post_comments&delete=$comment_id&comment_post_id=$post_id'>Delete</a></td>";

			echo "</tr>";

		}

		?>
	</tbody>
</table>

<!-- # delete post code  -->
<?php

if (isset($_GET['delete'])) {

	$delete_comment_id = $_GET['delete'];

	// Fetch the post ID associated with the comment
	$query = "SELECT comment_post_id FROM `comments` WHERE comment_id = {$delete_comment_id}";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$post_id = $row['comment_post_id'];

	$delete_comment_query = "DELETE FROM `comments` WHERE comment_id={$delete_comment_id}";
	$delete_comment_query_send = mysqli_query($connection, $delete_comment_query);

	if (!$delete_comment_query_send) {
		die("QUERY FAILED ." . mysqli_error($connection));
	} else {
		// $d_query = "UPDATE `posts`
		// SET post_comment_count = post_comment_count - 1 
		// WHERE post_id = $post_id ";
		// $decrease_comments_counter = mysqli_query($connection, $d_query);

	}


	// confirmQuery($delete_comment_query_send);
	header("location: comments.php?source=post_comments&comment_post_id=$post_id"); // بص هنا 


}


?>

<!-- # Approve comment code  -->
<?php

if (isset($_GET['approve'])) {

	$approved_comment_id = $_GET['approve'];

	$approved_comment_query = "UPDATE `comments`
	SET comment_status = 'approved'
	WHERE comment_id = {$approved_comment_id}";
	$approved_comment_query_send = mysqli_query($connection, $approved_comment_query);

	confirmQuery($approved_comment_query_send);
	header("location: comments.php?source=post_comments&comment_post_id=$post_id"); // بص هنا 
}
?>

<!-- # Unapprove comment code  -->

<?php

if (isset($_GET['unapprove'])) {

	$unapproved_comment_id = $_GET['unapprove'];

	$unapproved_comment_query = "UPDATE `comments`
	SET comment_status = 'unapproved'
	WHERE comment_id = {$unapproved_comment_id}";
	$unapproved_comment_query_send = mysqli_query($connection, $unapproved_comment_query);

	confirmQuery($unapproved_comment_query_send);
	header("location: comments.php?source=post_comments&comment_post_id=$post_id"); // بص هنا 
}
?>