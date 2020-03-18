<?php
include_once './commons/validatesession.php';
include_once './commons/db.php';
include_once './entity/Post.php';
include_once './dao/postDao.php';
include_once './entity/User.php';

$postDao = new PostDao();
$post = new Post();
$user = new User();
$user = unserialize($_SESSION['user']);
$post->setAuthor($user->getUsername());
$myPosts = $postDao->list($post);

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <div class="row" style="padding-top: 3em;">
        <div class="col-2">
            <ul class="nav nav-pills nav-fill flex-column">
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary" href="profile.php">Edit Profile</a>
                </li>
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary active" href="myposts.php">My Posts</a>
                </li>
                <li class="nav-item" style="margin-bottom: 1em;">
                    <a class="nav-link btn-outline-primary" href="savedposts.php">Saved Posts</a>
                </li>
            </ul>
        </div>
        
        <div class="col-10">
            <form class="form-inline" style="padding-bottom: 3em;">
                <div class="form-row ml-5">
                    <select id="typeFilter" class="form-control form-control">
                        <option>All (Default)</option>
                        <option>Jobs</option>
                        <option>Rent</option>
                    </select>
                    <select id="sortFilter" class="form-control form-control ml-2">
                        <option>Newest - Oldest (Descending)</option>
                        <option>Oldest - Newest (Ascending)</option>
                    </select>
                    <button type="button" class="btn btn-primary ml-2">Filter</button>
                    <button type="button" class="btn btn-primary ml-2">Create Post</button>
                </div>
            </form>

            <!-- contents -->
            <?php foreach($myPosts as $myPost) { ?>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title"><?= $myPost->getTitle(); ?></h5>
                                <p class="card-text"><?= $myPost->getBody(); ?></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-primary btn-block">Edit</button>
                                <button type="button" class="btn btn-outline-secondary btn-block">Disable</button>
                                <button type="button" class="btn btn-outline-danger btn-block">Delete</button>
                            </div>
                        </div>
                        <div class="card-footer col">
                            <p class="card-text text-right" style="margin-right: 1em;"><small class="text-muted">Approved <?= $myPost->getApprovedAt(); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>