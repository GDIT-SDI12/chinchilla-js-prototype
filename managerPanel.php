<?php

require_once './commons/validatesession.php';
require_once './commons/db.php';
require_once './entity/Post.php';
require_once './entity/User.php';
require_once './dao/postDao.php';

$user = new User();
$user = unserialize($_SESSION['user']);

if ($user->getRole() !== "Admin") {
    header('location: logout.php');
}

$postDao = new PostDao();
$criteria = new Post();
$criteria->setApprovedAt('NULL');
$posts = $postDao->list($criteria);

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <form class="form-inline" style="padding-top: 3em;">
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
        </div>
    </form>
    <div class="container pt-5">

        <!-- contents -->
        <?php foreach ($posts as $post) { ?>
            <div class="col shadow">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post->getTitle(); ?></h5>
                                <p class="card-text"><?= $post->getBody(); ?></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-success btn-block approve"
                                        id="<?= $post->getId(); ?>">Approve
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-block">Reject</button>
                            </div>
                        </div>
                        <div class="card-footer col">
                            <p class="card-text text-right mr-3"><small
                                        class="text-muted">Posted: <?= $post->getCreatedAt(); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>

<script type="text/javascript" src="js/js.js"></script>

</html>
