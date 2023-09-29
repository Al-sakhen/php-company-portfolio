<?php
require('./includes/head.php');
require('./includes/connection.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `blogs` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    if(mysqli_num_rows($query) > 0) { // data found
        $blog = mysqli_fetch_assoc($query);
    } else {
        $_SESSION['errors'] = ['data not found'];
        header('location: ./blogs.php');
    }
} else {
    $_SESSION['errors'] = ['You are not allowed to access this page'];
    header('location: ./blogs.php');
}


?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Edit Blog</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <!-- alerts -->
                        <?php require('./includes/alerts.php')?>
                        <form method="post" action="./handlers/updateBlogHandler.php" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>title</label>
                              <input type="text" value="<?=  $blog['title']?>" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>body</label>
                              <input type="text" value="<?=  $blog['body']?>" name="body" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" name="image" class="form-control">
                              <img src="./uploads/blogs/<?= $blog['image'] ?>" style="width: 100px; height: 100px;" >
                            </div>
                            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
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