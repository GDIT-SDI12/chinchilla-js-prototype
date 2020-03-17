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

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand mb-0 h1" href="index.php">Chinchilla</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
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