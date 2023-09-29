<?php
require('./includes/head.php')
?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Blog</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <!-- alerts -->
                        <?php require('./includes/alerts.php')?>
                        <form method="post" action="./handlers/createBlogHandler.php" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Title</label>
                              <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Body</label>
                              <input type="text" name="body" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" name="image" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>