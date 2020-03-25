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
$post = $postDao->find($postId);

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
    <div class="row">
        <div class="col">
            <div>
                <?php if (null !== $post->getImages()) { ?>
                    <img src="<?= DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . str_replace("#DS#", DIRECTORY_SEPARATOR, array_values($post->getImages())[0]) ?>" class="card-img-top p-3 p-3">
                <?php } else { ?>
                    <img src="http://via.placeholder.com/640x360" class="card-img-top p-3 p-3" alt="...">
                <?php } ?>
            </div>
        </div>
        <div class="col">
            <?php
                echo "<pre>";
                var_dump($post);
            ?>
        </div>
    </div>
</div>
</body>
</html>
