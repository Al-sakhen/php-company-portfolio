<?php
session_start();
// if(isset($_SESSION['admin'])){
//     header("location: ./index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Portfolio</title>

    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
</head>
<body>
    

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Register</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="handlers/register.php" method="post">
                            <?php
                                require('./admin/includes/alerts.php');
?>
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Register</button>
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