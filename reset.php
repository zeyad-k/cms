<?php include "includes/dp.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "./functions.php"; ?>

<?php


if (!isset($_GET['token'])) {
    redirect('index.php');
}
?>
<?php
if (isset($_GET['token'])) {
    $token = ($_GET['token']);
    $email = ($_GET['email']);


    // $token = '24d8550ba283238cc000b67203b160e6a4f2b6b29cf9f10bcc6cfd896994ee565da0a99792ed122ca69a7403e390f541356b';
    if ($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token = ? ")) {
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

    }
    // if ($_GET['token'] == !$token || $_GET['email'] == !$user_email) {
    //     redirect('index.php');
    // }
    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {

            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost=>12'));
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='' ,user_password='{$hashed_password}' WHERE user_email=?  ")) {

                mysqli_stmt_bind_param($stmt, "s", $user_email);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) >= 1) {
                    redirect('login.php');
                }
                mysqli_stmt_close($stmt);

            }
        }
    }
}





?>


<!-- Page Content -->
<div class="container">

    <?php // if():?>
    <?php  //else():?>
    <?php // endif:?>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password.</h2>
                            <p>Enter new password</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="New Password"
                                                class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword"
                                                placeholder="Confirm Password" class="form-control" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                            <h2>Please check your email</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->