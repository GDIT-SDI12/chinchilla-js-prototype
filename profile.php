<?php
include_once './commons/validatesession.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<div class="container">
    <?php require_once 'components/navbar.php' ?>
    <div class="row" style="padding-top: 3em;">
        <div class="col-2">
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
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <form method="" action="" style="padding : 0 15% 15%;">
                        <div class="form-group row">
                            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="username" class="form-control" id="inputUsername"
                                       placeholder="username123" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputFirstname" class="col-sm-2 col-form-label">First name</label>
                            <div class="col-sm-10">
                                <input type="firstname" class="form-control" id="inputFirstname"
                                       placeholder="Richard">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputLastname" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-10">
                                <input type="lastname" class="form-control" id="inputLastname"
                                       placeholder="Hendricks">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhonenumber" class="col-sm-2 col-form-label">Phone number</label>
                            <div class="col-sm-10">
                                <input type="phonenumber" class="form-control" id="inputPhonenumber"
                                       placeholder="0221234567">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail"
                                       placeholder="richardhendricks@piedpiper.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="input-group col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" placeholder="******"
                                       aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                            id="button-addon2">Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a href="profile.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-outline-primary col-md-3 offset-md-9">Save</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>