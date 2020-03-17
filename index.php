<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location: feed.php");
} else {
    header("location: login.php");
}