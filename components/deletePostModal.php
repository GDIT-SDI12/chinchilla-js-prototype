<?php

$postDao = new PostDao();
$postTypes = $postDao->getTypes();

?>

<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalTitle">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="./deletePost.php">
                        <input type="hidden" id="deletePostId" name="postId" value=""/>
                        <p>Are you sure you want to delete post <b><span id="post-title"></span></b>?</p>
                        <p>There is no undo for this</p>
                        <input type="submit" class="btn btn-danger" name="deletePost" value="Delete"/>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
