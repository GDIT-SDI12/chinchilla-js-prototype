<?php
require_once './commons/validatesession.php';
include_once './commons/db.php';
include_once './entity/Post.php';
include_once './dao/postDao.php';

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

$postDao = new PostDao();
$posts = $postDao->list($postFilter);

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php' ?>

<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container">
        <form action="feed.php" method="GET" class="form-inline" style="padding-top: 3em;">
            <div class="form-row ml-5">
                <select id="typeFilter" name="typeFilter" class="form-control form-control">
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
                <select id="sortFilter" name="sortFilter" class="form-control form-control ml-2">
                    <option value="desc" <?= $sortFilter == "desc" ? 'selected' : ''; ?>>
                        Newest - Oldest (Descending)
                    </option>
                    <option value="asc" <?= $sortFilter == "asc" ? 'selected' : ''; ?>>
                        Oldest - Newest (Ascending)
                    </option>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-2" style="padding-top: 3em;">

            <?php foreach ($posts as $post) { ?>
                <div class="col mb-4">
                    <div class="card">
                        <div>
                            <?php if (null !== $post->getImages()) { ?>
                                <img src="<?= "uploads/" . str_replace("#DS#", DIRECTORY_SEPARATOR, array_values($post->getImages())[0]) ?>" class="card-img-top p-3 p-3" alt="...">
                            <?php } else { ?>
                                <img src="http://via.placeholder.com/640x360" class="card-img-top p-3 p-3" alt="...">
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <a href="post.php?post=<?= $post->getId(); ?>">
                                <h5 class="card-title"><?= $post->getTitle(); ?></h5>
                            </a>
                            <p class="card-text"><?= $post->getBody(); ?></p>
                            <p class="card-text text-right"><small class="text-muted">Posted <?= $post->getCreatedAt(); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>