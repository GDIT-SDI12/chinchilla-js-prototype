<?php
include_once './commons/validatesession.php';

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
                <a class="nav-link btn-outline-primary" href="profile.php">Edit Profile</a>
            </li>
            <li class="nav-item" style="margin-bottom: 1em;">
                <a class="nav-link btn-outline-primary" href="myposts.php">My Posts</a>
            </li>
            <li class="nav-item" style="margin-bottom: 1em;">
                <a class="nav-link btn-outline-primary active" href="savedposts.php">Saved Posts</a>
            </li>
        </ul>
    </div>
    <div class="container col-md-10">
        <div class="col-10 shadow">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4 p-2">
                        <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Posted March 11, 2020</small></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-danger btn-block">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>