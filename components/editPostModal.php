<?php
$postDao = new PostDao();
$postTypes = $postDao->getTypes();
?>
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editodalTitle">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="postType" class="col-sm-3 col-form-label">Post type</label>
                            <div id="typeSelect" class="col-sm-9">
                                <select class="form-control" name="postType" id="postType">
                                    <?php foreach ($postTypes as $postType) {
                                        echo '<option>' . $postType . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title *</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                        </div>
                        <!-- TODO change image
                        <div class="form-group">
                            <input id="fileToUpload" name="fileToUpload" type="file" class="file" data-show-upload="true" data-show-caption="true">
                            <img id="image" />
                        </div> -->
                        <?php if (!empty($errors)) {
                            echo '<div class="alert alert-danger">';
                            foreach ($errors as $error)
                                echo '<p>' . $error . '</p>';
                            echo '</div>';
                        } ?>
                        <hr/>
                        <input type="hidden" id="editPostId" name="postId" value=""/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="btn_save" class="btn btn-primary" name="EditPost" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>