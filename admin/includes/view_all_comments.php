<?php
if (isset($_POST['checkBoxesArray_comm'])) {
	foreach ($_POST['checkBoxesArray_comm'] as $checkBoxValue) { // السطر ده بيجيب ال id بتاع البوست
		$bulk_options_comm = $_POST['bulk_options_comm'];
		$checkBoxValue;


		switch ($bulk_options_comm) {
			case 'approved':
				$approve_query = "UPDATE `comments` SET comment_status ='{$bulk_options_comm}' WHERE comment_id ={$checkBoxValue}";
				$approve = mysqli_query($connection, $approve_query);
				confirmQuery($approve);
				break;

			case 'unapproved':
				$unapprove_query = "UPDATE `comments` SET comment_status ='{$bulk_options_comm}' WHERE comment_id =$checkBoxValue";
				$unapprove = mysqli_query($connection, $unapprove_query);
				confirmQuery($unapprove);
				break;
			case 'delete':
				$delete_query = "DELETE FROM `comments` WHERE comment_id =$checkBoxValue";
				$delete = mysqli_query($connection, $delete_query);
				confirmQuery($delete);
				break;
			case 'clone':
				$clone_query = "SELECT * FROM `comments` WHERE comment_id =$checkBoxValue";
				$clone = mysqli_query($connection, $clone_query);
				while ($row = mysqli_fetch_array($clone)) {
					$comment_post_id = $row['comment_post_id'];
					$comment_author = $row['comment_author'];
					$comment_email = $row['comment_email'];
					$comment_content = $row['comment_content'];
					$comment_status = $row['comment_status'];




					$add_comment = "INSERT INTO `comments` 
					(comment_post_id,comment_author, comment_email,comment_content,comment_status,comment_date )
					VALUES ({$comment_post_id},'{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())";
					$add_comment_query = mysqli_query($connection, $add_comment);
					if (!$add_comment_query) {
						die("QUERY FAILED ." . mysqli_error($connection));
					}
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
			<select name="bulk_options_comm" id="" class="form-control">
				<option value="">Select Option</option>
				<option value="approved">Approve</option>
				<option value="unapproved">Unapprove</option>
				<option value="delete">Delete</option>
				<option value="clone">Clone</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input class="btn btn-success" type="submit" value="apply">
		</div>
</form>
<thead>
	<tr>
		<th><input id='selectAllBoxes_comm' type='checkbox'></th>

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
	
	$query = "SELECT * FROM `comments`  ORDER BY comment_id DESC";
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
		?>
		<th><input class='checkBoxes_comm' name='checkBoxesArray_comm[]' value='<?php echo $comment_id; ?>' type='checkbox'>
		</th>
		<?php

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
		echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
		echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapproved</a></td>";
		echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

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
	header("location: comments.php"); // بص هنا 


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
	header("location: comments.php"); // بص هنا 
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
	header("location: comments.php"); // بص هنا 
}
?>

<script>

	$(document).ready(function () {
		$("#selectAllBoxes_comm").click(function (event) {
			if (this.checked) {
				$(".checkBoxes_comm").each(function () {
					this.checked = true;
				});
			} else {
				$(".checkBoxes_comm").each(function () {
					this.checked = false;
				});
			}
		});
	});

</script>