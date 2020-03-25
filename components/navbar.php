<?php
include_once './entity/User.php';
$session_user = new User();
if (isset($_SESSION['user'])) {
    $session_user = unserialize($_SESSION['user']);
}
// echo $user->getUsername();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href="/login.php">Chinchilla</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <!-- The $user variable (is/should be) declared from the php file that included this file -->
            <?php if (isset($session_user) && (null !== $session_user->getUsername())) { ?>
                <?php if ($session_user->getRole() == "Admin") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/managerPanel.php">Management Panel</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php">Login</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
