<?php include "./includes/dp.php"; ?>
<?php include "includes/header.php"; ?>
<?php
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];


	if (!empty($subject) && !empty($email) && !empty($body)) {
		$subject = mysqli_real_escape_string($connection, $subject);
		$email = mysqli_real_escape_string($connection, $email);
		$body = mysqli_real_escape_string($connection, $body);

		$to = "zxzazz77@gmail.com";
		$headers = "From: " . $email;
		if (mail($to, $subject, $body, $headers)) {
			$message = "Email sent successfully!";
		} else {
			$message = "Failed to send email.";
		}

	} else {
		$message = "Fields cannot be empty.";
	}

} else {
	$message = "";
}

?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

	<section id="login">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<div class="form-wrap">
						<h1>Contact</h1>
						<form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
							<h6 class="text-center">
								<?php echo $message; ?>
							</h6>
							<div class="form-group">
								<label for="email" class="sr-only"> Email</label>
								<input type="email" name="email" id="email" class="form-control"
									placeholder="Enter Your Email">
							</div>
							<div class="form-group">
								<label for="subject" class="sr-only">subject</label>
								<input type="text" name="subject" id="subject" class="form-control"
									placeholder="Email Subject">
							</div>


							<div class="form-group">
								<textarea class="form-control" id="body" name="body" rows="10">
 </textarea>
							</div>

							<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
								value="Send">
						</form>

					</div>
				</div> <!-- /.col-xs-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section>


	<hr>



	<?php include "includes/footer.php"; ?>