<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username *</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" id="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstName" class="col-sm-3 col-form-label">First name</label>
                            <div class="col-sm-9">
                                <input type="text" name="firstName" class="form-control" id="firstName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastName" class="col-sm-3 col-form-label">Last name</label>
                            <div class="col-sm-9">
                                <input type="text" name="lastName" class="form-control" id="lastName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone number</label>
                            <div class="col-sm-9">
                                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email *</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password *</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm Password *</label>
                            <div class="col-sm-9">
                                <input type="password" name="passwordConfirmation" class="form-control" id="passwordConfirmation">
                            </div>
                        </div>
                        <?php if (!empty($errors)) {
                            echo '<div class="alert alert-danger">';
                            foreach ($errors as $error)
                                echo '<p>' . $error . '</p>';
                            echo '</div>';
                        } ?>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Post</button>
            </div>
        </div>
    </div>
</div>