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
                        <a class="nav-link btn-outline-primary active" href="#">Edit Profile</a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 1em;">
                        <a class="nav-link btn-outline-primary" href="myposts.php">My Posts</a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 1em;">
                        <a class="nav-link btn-outline-primary" href="savedposts.php">Saved Posts</a>
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <form method="" action="" style="padding : 0 15% 15%;">
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="username" class="form-control" id="inputUsername"
                                        placeholder="username123" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFirstname" class="col-sm-2 col-form-label">First name</label>
                                <div class="col-sm-10">
                                    <input type="firstname" class="form-control" id="inputFirstname"
                                        placeholder="Richard">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputLastname" class="col-sm-2 col-form-label">Last name</label>
                                <div class="col-sm-10">
                                    <input type="lastname" class="form-control" id="inputLastname"
                                        placeholder="Hendricks">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPhonenumber" class="col-sm-2 col-form-label">Phone number</label>
                                <div class="col-sm-10">
                                    <input type="phonenumber" class="form-control" id="inputPhonenumber"
                                        placeholder="0221234567">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail"
                                        placeholder="richardhendricks@piedpiper.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="input-group col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="******"
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="button-addon2">Change Password</button>
                                    </div>
                                </div>
                            </div>
                            <a href="profile.php" style="text-decoration: none;">
                                <button type="button" class="btn btn-outline-primary col-md-3 offset-md-9">Save</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>