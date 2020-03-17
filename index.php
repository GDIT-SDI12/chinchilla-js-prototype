<?php
require_once 'entity/User.php';

if (isset($_SESSION['user'])){
    header("location: feed.html");
} else {
    header("location: login.html");
}