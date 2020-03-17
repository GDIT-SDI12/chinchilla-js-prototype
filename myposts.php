<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand mb-0 h1" href="feed.php">Chinchilla</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row" style="padding-top: 3em;">
            <div class="col-2">
                <ul class="nav nav-pills nav-fill flex-column">
                    <li class="nav-item" style="margin-bottom: 1em;">
                        <a class="nav-link btn-outline-primary" href="profile.php">Edit Profile</a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 1em;">
                        <a class="nav-link btn-outline-primary active" href="myposts.php">My Posts</a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 1em;">
                        <a class="nav-link btn-outline-primary" href="savedposts.php">Saved Posts</a>
                    </li>
                </ul>
            </div>
            <!-- contents -->
            <div class="col-10">
                <form class="form-inline" style="padding-bottom: 3em;">
                    <div class="form-row ml-5">
                        <select id="typeFilter" class="form-control form-control">
                            <option>All (Default)</option>
                            <option>Jobs</option>
                            <option>Rent</option>
                        </select>
                        <select id="sortFilter" class="form-control form-control ml-2">
                            <option>Newest - Oldest (Descending)</option>
                            <option>Oldest - Newest (Ascending)</option>
                        </select>
                        <button type="button" class="btn btn-primary ml-2">Filter</button>
                        <button type="button" class="btn btn-primary ml-2">Create Post</button>
                    </div>
                </form>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Posted March 11, 2020</small></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-primary btn-block">Edit</button>
                                <button type="button" class="btn btn-outline-secondary btn-block">Disable</button>
                                <button type="button" class="btn btn-outline-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Posted March 11, 2020</small></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-primary btn-block">Edit</button>
                                <button type="button" class="btn btn-outline-secondary btn-block">Disable</button>
                                <button type="button" class="btn btn-outline-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-2">
                            <img src="http://via.placeholder.com/640x360" class="card-img" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Posted March 11, 2020</small></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-primary btn-block">Edit</button>
                                <button type="button" class="btn btn-outline-secondary btn-block">Disable</button>
                                <button type="button" class="btn btn-outline-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>