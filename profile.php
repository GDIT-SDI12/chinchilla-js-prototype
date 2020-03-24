<?php
require_once 'commons/validatesession.php';
require_once 'commons/db.php';
require_once 'entity/User.php';
require_once 'dao/userDao.php';

$user = new User();
$user = unserialize($_SESSION['user']);
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $user->getUsername();
    //Password in db
    $password = $user->getPassword();
    //Entered current password for check
    $currentPassword = trim($_POST['currentPassword']);
    $newPassword = trim($_POST['newPassword']);
    $newPasswordConfirmation = trim($_POST['newPasswordConfirmation']);

    $email = empty(trim($_POST['email'])) ? $user->getEmail() : trim($_POST['email']);
    $firstName = empty(trim($_POST['firstName'])) ? $user->getFirstName() : trim($_POST['firstName']);
    $lastName = empty(trim($_POST['lastName'])) ? $user->getLastName() : trim($_POST['lastName']);
    $phoneNumber = empty(trim($_POST['phoneNumber'])) ? $user->getPhoneNumber() : trim($_POST['phoneNumber']);

    $userDao = new UserDao();

    // Set new data
    $updatedUser = new User();
    $updatedUser->setUsername($username);
    $updatedUser->setEmail($email);
    $updatedUser->setFirstName($firstName);
    $updatedUser->setLastName($lastName);
    $updatedUser->setPhoneNumber($phoneNumber);

    if (!empty($currentPassword) || !empty($newPassword)) {
        if ($currentPassword !== $password) {
            $errors[] = "Incorrect current password";
        }
        if (empty($newPassword)) {
            $errors[] = "Password cannot be empty";
        } elseif ($newPassword !== $newPasswordConfirmation) {
            $errors[] = "New password must be confirmed";
        } else {
            $updatedUser->setPassword($newPassword);
        }
    } else {
        $updatedUser->setPassword($password);
    }

    if (empty($errors)) {
        $userDao->update($updatedUser);
        $_SESSION['user'] = serialize($userDao->find($username));
        header("location: /profile.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>

<div class="row pt-5">
    <div class="col-md-2">
        <ul class="nav nav-pills nav-fill flex-column">
            <li class="nav-item" style="margin-bottom: 1em;">
                <a class="nav-link btn-outline-primary active" href="profile.php">Edit Profile</a>
            </li>
            <li class="nav-item" style="margin-bottom: 1em;">
                <a class="nav-link btn-outline-primary" href="myposts.php">My Posts</a>
            </li>
            <li class="nav-item" style="margin-bottom: 1em;">
                <a class="nav-link btn-outline-primary" href="savedposts.php">Saved Posts</a>
            </li>
        </ul>
    </div>
    <div class="container col-md-10">
        <form method="POST" action="" style="padding : 0 25% 5% 5%;">
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
                       href="#changePasswordDialog" onclick="this.blur();">Change Password</a>
                </p>
            </div>
            <div class="row">
                <div class="col collapse" id="changePasswordDialog">
                    <div class="form-group row">
                        <label for="currentPassword" class="col-sm-3 col-form-label">Current
                            Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="currentPassword"
                                   name="currentPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPasswordConfirmation"
                               class="col-sm-3 col-form-label">Confirmation</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newPasswordConfirmation"
                                   name="newPasswordConfirmation">
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($errors)) {
                echo '<div class="alert alert-danger">';
                foreach ($errors as $error)
                    echo '<p>' . $error . '</p>';
                echo '</div>';
            } ?>
            <div>
                <input type="submit" class="btn btn-default btn-outline-primary inline float-right" value="Save">
            </div>
        </form>
    </div>
</div>
</body>

</html>
