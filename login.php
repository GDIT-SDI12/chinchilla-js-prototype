<?php

require_once 'dao/userDao.php';
require_once 'commons/db.php';
require_once 'entity/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userDao = new UserDao();
    // username and password sent from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $userDao->find($username);

    // If user with such username does not exist or
    // has different password
    if (!$user || $user->getPassword() !== $password) {
        $error = "Invalid credentials";
    } else {
        $_SESSION['user'] = $user;
        if ($user->getRole() == 1) {
            header("location: /managerPanel.php");
        } else {
            header("location: /feed.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<div class="container">
    <?php require_once 'components/navbar.php' ?>
    <div class="logo" style="text-align: center;">
        <img src="images/android-chrome-384x384.png" alt="logo"/>
    </div>
    <form method="POST" action="" style="padding : 0 35% 35%;">
        <h5><?php echo isset($error) ? $error : ""; ?></h5>
        <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <a class="nav-link" href="forgotpassword.php" style="text-align: center;">Forgot Password?</a>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Sign In">
        <div class="form-group"></div>
        <a href="register.php" style="text-decoration: none;">
            <button type="button" class="btn btn-outline-primary btn-block">Sign Up</button>
        </a>
    </form>
</div>
</body>

</html>