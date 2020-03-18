<?php

require_once 'dao/userDao.php';
require_once 'commons/db.php';
require_once 'entity/User.php';

if (isset($_SESSION)) {
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);
    $email = trim($_POST['email']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phoneNumber = trim($_POST['phoneNumber']);

    $userDao = new UserDao();
    $user = new User();
    $errors = array();
    // Collect data from form
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif ($userDao->find($username)) {
        $errors[] = "Username " . $username . " is already used";
    } else {
        $user->setUsername($username);
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif ($password !== $passwordConfirmation) {
        $errors[] = "Password is not confirmed";
    } else {
        $user->setPassword($password);
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } else {
        $user->setEmail($email);
    }
    if (!empty($firstName)) {
        $user->setFirstName($firstName);
    }
    if (!empty($lastName)) {
        $user->setLastName($lastName);
    }
    if (!empty($phoneNumber)) {
        $user->setPhoneNumber($phoneNumber);
    }

    if (empty($errors)) {
        $user->setRole('user');
        $userDao->create($user);
        header("location: /login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <form method="POST" action="" style="padding : 10% 15% 15%;">
        <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username *</label>
            <div class="col-sm-9">
                <input type="text" name="username" class="form-control" id="username">
            </div>
        </div>
        <div class="form-group row">
            <label for="firstName" class="col-sm-3 col-form-label">First name</label>
            <div class="col-sm-9">
                <input type="text" name="firstName" class="form-control" id="firstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="lastName" class="col-sm-3 col-form-label">Last name</label>
            <div class="col-sm-9">
                <input type="text" name="lastName" class="form-control" id="lastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone number</label>
            <div class="col-sm-9">
                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email *</label>
            <div class="col-sm-9">
                <input type="text" name="email" class="form-control" id="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password *</label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>
        <div class="form-group row">
            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm Password *</label>
            <div class="col-sm-9">
                <input type="password" name="passwordConfirmation" class="form-control" id="passwordConfirmation">
            </div>
        </div>
        <?php if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error)
                echo '<p>' . $error . '</p>';
            echo '</div>';
        } ?>
        <div class="form-group" style="float: right;">
            <button class="btn btn-primary inline">Reset</button>
            <button type="submit" class="btn btn-outline-primary inline">
            Create Account</button>
        </div>
    </form>
</div>
</body>
</html>
