<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

require_once 'commons/db.php';
require_once 'entity/Mailer.php';
require_once 'entity/User.php';
require_once 'dao/mailerDao.php';
require_once 'dao/userDao.php';
require_once 'commons/emailsender.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userDao = new UserDao();
    $username = $_POST['username'];
    $user = $userDao->find($username);
    
    if(isset($user)) {
        $emailsender = new EmailSender();
        $is_success = $emailsender->send(
            $user->getEmail(), 
            $user->getUsername(),
            'Password Recovery',
            'Your password for account <b>' . $user->getUsername() . '</b> is: ' . $user->getPassword());
    }

    $response = "We've sent an email to your account for instructions to recover your password.";
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <div class="logo" style="text-align: center;">
        <img src="images/android-chrome-384x384.png" alt="logo"/>
    </div>

    <?php if(isset($response)) { ?>
        <div style="padding : 0 35% 35%;">
            <h5><?= $response ?></h5>
            <a href="login.php" style="text-decoration: none;">
                <button type="button" class="btn btn-primary btn-block">Go to Login</button>
            </a>
        </div>
    <?php } else { ?>
        <form method="POST" action="" style="padding : 0 35% 35%;">
            <h5><?php echo isset($error) ? $error : ""; ?></h5>
            <div class="form-group" style="text-align: center;">
                <h6>Forgot your password?</h6>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username here" required>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Continue">
            <div class="form-group"></div>
        </form>
    <?php } ?>
</div>
</body>

</html>
<?php
unset($_POST);
?>