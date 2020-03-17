<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location: feed.php");
    exit;
} else {
    header("location: login.php");
    exit;
}
?>