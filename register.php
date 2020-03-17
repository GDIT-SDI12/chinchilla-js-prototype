<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<div class="container">
    <?php require_once 'components/navbar.php' ?>
    <form method="" action="" style="padding : 10% 15% 15%;">
        <div class="form-group row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="username" class="form-control" id="inputUsername">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputFirstname" class="col-sm-2 col-form-label">First name</label>
            <div class="col-sm-10">
                <input type="firstname" class="form-control" id="inputFirstname">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputLastname" class="col-sm-2 col-form-label">Last name</label>
            <div class="col-sm-10">
                <input type="lastname" class="form-control" id="inputLastname">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPhonenumber" class="col-sm-2 col-form-label">Phone number</label>
            <div class="col-sm-10">
                <input type="phonenumber" class="form-control" id="inputPhonenumber">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="confirmPassword" class="form-control" id="inputConfirmPassword">
            </div>
        </div>
        <div class="form-group" style="float: right;"></div>
        <button type="submit" class="btn btn-primary inline">Reset</button>
        <button type="button" class="btn btn-outline-primary inline">Create Account</button>
        <div class="form-group"></div>
    </form>
</div>
</body>

</html>