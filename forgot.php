<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>
<?php include "includes/dp.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "./functions.php"; ?>

<?php
require './vendor/autoload.php';
require './classes/config.php';


if (!isset($_GET['forgot'])) {
    redirect('index.php');
}

if (ifItIsMethod('post')) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
    }
    if (email_exists($email)) {
        if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // CONFIGER PHPMAILER
            $mail = new PHPMailer();


            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';                    //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'a86e9f7b7dea34';                    //SMTP username
            $mail->Password = '6f24dc76f63f07';   //SMTP password
            //  $mail->SMTPSecure = 'ssl';
            // $mail->SMTPSecure = 'tls';                           
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            //Enable implicit TLS encryption
            $mail->Port = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('zeyadcms@zeyadschool.net', 'Zeyad');
            $mail->addAddress($email);
            //Add a recipient
            $mail->Subject = 'Reset Password';
            $mail->Body = 'If you are trying to reset your password : <br>
            Please, Click this button... <br>
            
            <h2><a href="http://localhost/cms/reset.php?email=' . $email . '&token=' . $token . '">Reset</a></h2>
            <b>in bold!</b>';
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            if ($mail->send()) {
                $emailSent = true;
            } else {
                echo "Not sent";
            }



        }
    }
}
?>

<!-- Page Content -->
<div class="container">


    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <?php if (!isset($emailSent)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">





                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address"
                                                    class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                                value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else: ?>


                                <h2>Please check your email</h2>


                            <?php endif; ?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->