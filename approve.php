<?php
require_once 'commons/validatesession.php';
require_once 'commons/db.php';
require_once 'entity/User.php';
require_once 'entity/Post.php';
require_once 'dao/userDao.php';
require_once 'dao/postDao.php';

$user = new User();
$user = unserialize($_SESSION['user']);
$post = new Post();

if ($user->getRole() !== "Admin") {
    http_response_code(403);
} else {
    $postDao = new PostDao();
    $post = $postDao->find($_POST['id']);
    $post->setApprovedAt(date('Y-m-d H:i:s'));
    $postDao->update($post);
}
