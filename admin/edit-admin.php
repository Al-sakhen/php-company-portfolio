<?php
session_start();
require('./includes/head.php');
require('./includes/connection.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `admins` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    if(mysqli_num_rows($query) > 0) { // data found
        $admin = mysqli_fetch_assoc($query);
    } else {
        $_SESSION['errors'] = ['data not found'];
        header('location: ./admins.php');
    }
} else {
    $_SESSION['errors'] = ['You are not allowed to access this page'];
    header('location: ./admins.php');
}


?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Edit Admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <!-- alerts -->
                        <?php require('./includes/alerts.php')?>
                        <form method="post" action="./handlers/updateAdminHandler.php" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" value="<?=  $admin['name']?>" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email"  value="<?=  $admin['email']?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                  <option value="active" <?= $admin['is_active'] == 'active' ? 'selected' : '' ?> >active</option>
                                  <option value="not_active" <?= $admin['is_active'] == 'not_active' ? 'selected' : '' ?> >not active</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" name="image" class="form-control">
                              <img src="./uploads/<?= $admin['image'] ?>" style="width: 100px; height: 100px;" >
                            </div>
                            <input type="hidden" name="admin_id" value="<?= $admin['id'] ?>">
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