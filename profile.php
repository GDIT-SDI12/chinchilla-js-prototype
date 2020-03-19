<?php
include_once './commons/validatesession.php';
include_once './entity/User.php';
$user = new User();
$user = unserialize($_SESSION['user']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $user->getUsername();
    $password = trim($_POST['password']);
    $oldPassword = trim($_POST['password']);
    $newPassword = trim($_POST['newPassword']);
    $newPasswordConfirmation = trim($_POST['newPasswordConfirmation']);
    $email = trim($_POST['email']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phoneNumber = trim($_POST['phoneNumber']);

    $userDao = new UserDao();
    $user = new User();
    $errors = array();
    // Collect data from form
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif ($password !== $newPasswordConfirmation) {
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
    <div class="row" style="padding-top: 3em;">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-fill flex-column">
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary active" href="#">Edit Profile</a>
                </li>
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary" href="myposts.php">My Posts</a>
                </li>
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary" href="savedposts.php">Saved Posts</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <form method="" action="" style="padding : 0 15% 15%;">
                        <div class="form-group row">
                            <label for="inputUsername" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="<?= $user->getUsername(); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">First name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                       placeholder="<?= $user->getFirstName(); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 col-form-label">Last name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                       placeholder="<?= $user->getLastName(); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                       placeholder="<?= $user->getPhoneNumber(); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="<?= $user->getEmail(); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <p>
                                <a class="btn btn-primary float-right" data-toggle="collapse"
                                   href="#changePasswordDialog">Change Password</a>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col collapse" id="changePasswordDialog">
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPasswordConfirmation" class="col-sm-3 col-form-label">Confirm New
                                        Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newPasswordConfirmation"
                                               name="newPasswordConfirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default btn-outline-primary inline float-right">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
