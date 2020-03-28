<?php
require_once 'commons/validatesession.php';
require_once 'commons/db.php';
require_once 'entity/User.php';
require_once 'entity/Post.php';
require_once 'dao/userDao.php';
require_once 'dao/postDao.php';

$user = new User();
$user = unserialize($_SESSION['user']);

$postId = null;
if (isset($_GET['post'])) {
    $postId = $_GET['post'];
} else {
    header('location: /unavailablePost.php');
    exit;
}
$postDao = new PostDao();
$userDao = new UserDao();
$post = $postDao->find($postId);
$author = $userDao->find($post->getAuthor());

$phoneNumber = $author->getPhoneNumber();
$email = $author->getEmail();

if ($post == null) {
    header('location: /unavailablePost.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'components/head.php' ?>
<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-4 my-5">
            <div>
                <?php if (null !== $post->getImages()) { ?>
                    <img src="<?= "uploads" . DIRECTORY_SEPARATOR . str_replace("#DS#", DIRECTORY_SEPARATOR, array_values($post->getImages())[0]) ?>"
                         class="card-img-top p-3 p-3">
                <?php } else { ?>
                    <img src="http://via.placeholder.com/640x360" class="card-img-top p-3 p-3" alt="...">
                <?php } ?>
            </div>
            <form class="mt-5">
                <div class="form-group row mb-0">
                    <label for="email" class="col-sm-3 col-form-label-sm">Phone:</label>
                    <div class="col-sm-9">
                        <label class="form-control-sm"
                               id="email"><?= ($phoneNumber) ? $phoneNumber : "hidden" ?></label>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <label for="email" class="col-sm-3 col-form-label-sm">Email:</label>
                    <div class="col-sm-9">
                        <label class="form-control-sm" id="email"><?= $email ?></label>
                    </div>
                </div>
                <?php if ($user->getSavedPosts() && in_array($postId, $user->getSavedPosts())) { ?>
                    <input type="button" class="btn btn-outline-secondary btn-block"
                           onclick="unsubscribePost(<?= $postId ?>);" value="Remove"/>
                <?php } else { ?>
                    <input type="button" class="btn btn-outline-primary btn-block" onclick="subscribePost(<?= $postId ?>);"
                           value="Save"/>
                <?php } ?>
            </form>
        </div>
        <div class="col-md-7 ml-3">
            <div class="row my-5">
                <h1><?= $post->getTitle(); ?></h1>
            </div>
            <div class="row mb-3">
                <?= $post->getBody(); ?>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="js/js.js"></script>

</html>
