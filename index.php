<?php
require_once './entity/User.php';

if (isset($_SESSION['user'])){
    header("location: feed.php");
} else {
    header("location: login.php");
}