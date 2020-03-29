<?php
include_once './commons/validatesession.php';
include_once './commons/db.php';
include_once './entity/Post.php';
include_once './entity/User.php';
include_once './entity/Image.php';
include_once './dao/postDao.php';
include_once './dao/imageDao.php';

$user = new User();
$user = unserialize($_SESSION['user']);

$postFilter = new Post();
$typeFilter = "";
$sortFilter = "";

$postDao = new PostDao();
$savedPosts = [];
if (!empty($user->getSavedPosts())) {
    foreach ($user->getSavedPosts() as $savedPostId) {
        $savedPosts[] = $postDao->find($savedPostId);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    function filterByType($posts, $typeFilter)
    {
        $filteredArray = [];
        foreach ($posts as $post) {
            if (strtolower($post->getType()) == $typeFilter) {
                $filteredArray[] = $post;
            }
        }
        return $filteredArray;
    }

    ;

    function sortDateDesc($postA, $postB)
    {
        if ($postA->getCreatedAt() == $postB->getCreatedAt()) {
            return 0;
        }
        return ($postA->getCreatedAt() < $postB->getCreatedAt()) ? 1 : -1;
    }

    if (isset($_GET["typeFilter"])) {
        $typeFilter = $_GET["typeFilter"];
        if ($typeFilter != "all") {
            $savedPosts = filterByType($savedPosts, $typeFilter);
        }
    }

    if (isset($_GET["sortFilter"])) {
        $sortFilter = $_GET["sortFilter"];
    }

    if ($sortFilter == "desc") {
        usort($savedPosts, 'sortDateDesc');
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
        <form action="savedposts.php" method="GET" class="form-inline" style="padding-bottom: 3em;">
            <div class="form-row ml-5">
                <select id="typeFilter" name="typeFilter" class="form-control form-control">
                    <option value="all" <?= $typeFilter == "all" ? 'selected' : ''; ?>>
                        All (Default)
                    </option>
                    <option value="job" <?= $typeFilter == "job" ? 'selected' : ''; ?>>
                        Jobs
                    </option>
                    <option value="accommodation" <?= $typeFilter == "accommodation" ? 'selected' : ''; ?>>
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

        <!-- contents -->
        <?php foreach ($savedPosts as $savedPost) { ?>
            <div class="col-10 shadow card mb-3 <?= strtolower($savedPost->getType()) ?>">
                <!--                <div class="card mb-3">-->
                <div class="row no-gutters">
                    <div class="col-md-4 p-2">
                        <?php $src = (null == $savedPost->getImages()) ?
                            'http://via.placeholder.com/640x360' :
                            'uploads/' . str_replace("#DS#", '/', array_values($savedPost->getImages())[0]); ?>
                        <div class="p-3 preview" style="background-image: url('<?= $src ?>');height: 200px"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title"><?= $savedPost->getTitle(); ?></h5>
                            <p class="card-text short-body"><?= $savedPost->getBody(); ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <input type="button" class="btn btn-outline-secondary btn-block"
                                   onclick="unsubscribePost(<?= $savedPost->getId() ?>);" value="Remove"/>
                        </div>
                    </div>
                </div>
                <!--                </div>-->
            </div>
        <?php } ?>
    </div>
</div>
</body>

<script type="text/javascript" src="js/js.js"></script>

</html>