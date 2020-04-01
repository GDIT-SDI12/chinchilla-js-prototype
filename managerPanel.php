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

$postFilter = new Post();
$typeFilter = "";
$sortFilter = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["typeFilter"])) {
        $typeFilter = $_GET["typeFilter"];
    }

    if (isset($_GET["sortFilter"])) {
        $sortFilter = $_GET["sortFilter"];
    }

    if ($typeFilter == "job") {
        $postFilter->setType(1);
    } else if ($typeFilter == "rent") {
        $postFilter->setType(2);
    }

    if ($sortFilter == "asc") {
        $postFilter->setOrderBy($sortFilter);
    }
}

$postFilter->setApprovedAt('NULL');
$postDao = new PostDao();
$posts = $postDao->list($postFilter);

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <form action="managerPanel.php" method="GET" style="padding-top: 3em;">
        <div class="form-row">
            <div class="form-group col-md-3">
                <select id="typeFilter" name="typeFilter" class="form-control">
                    <option value="all" <?= $typeFilter == "all" ? 'selected' : ''; ?>>
                        All (Default)
                    </option>
                    <option value="job" <?= $typeFilter == "job" ? 'selected' : ''; ?>>
                        Jobs
                    </option>
                    <option value="rent" <?= $typeFilter == "rent" ? 'selected' : ''; ?>>
                        Rent
                    </option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <select id="sortFilter" name="sortFilter" class="form-control">
                    <option value="desc" <?= $sortFilter == "desc" ? 'selected' : ''; ?>>
                        Newest - Oldest (Descending)
                    </option>
                    <option value="asc" <?= $sortFilter == "asc" ? 'selected' : ''; ?>>
                        Oldest - Newest (Ascending)
                    </option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>
    <div class="container pt-5">

        <!-- contents -->
        <?php foreach ($posts as $post) { ?>
            <div class="col shadow">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <!-- <img src="http://via.placeholder.com/640x360" class="card-img" alt="..."> -->
                            <?php if (null !== $post->getImages()) { ?>
                                <img src="<?= "uploads/" . str_replace("#DS#", DIRECTORY_SEPARATOR, array_values($post->getImages())[0]) ?>" class="card-img" alt="...">
                            <?php } else { ?>
                                <img src="http://via.placeholder.com/640x360" class="card-img-top p-3 p-3" alt="...">
                            <?php } ?>
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
