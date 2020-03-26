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

$postDao = new PostDao();
$userDao = new UserDao();
$post = $postDao->find($_POST['id']);
$user->addPosts($post->getId());
$userDao->savePost($user->getUsername(), $post->getId());
$_SESSION['user'] = serialize($userDao->find($user->getUsername()));
