<?php
session_start();
require('./includes/head.php');

$connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
$sql = "SELECT * FROM admins";
$query = mysqli_query($connection, $sql);
$admins = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">
                <?php if(isset($_SESSION['success'])):?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']?>
                </div>
                <?php
                unset($_SESSION['success']);
                endif;?>
                

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Admins</h3>
                <a href="./add-admin.php" class="btn btn-secondary">Add Admin</a>

                </div>
                <table class="table table-hover">
                    <thead>
                      <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($admins) > 0) :?>
                      <?php
                      foreach($admins as $admin):
                          ?>
                      <tr>
                        <th scope="row">
                          <?= $admin['id']?>
                        </th>
                        <td>
                          <?= $admin['name']?>
                        </td>
                        <td>
                          <?= $admin['email']?>
                        </td>
                        <td>
                          <?= $admin['is_active']?>
                        </td>
                        <td>
                          <?= $admin['created_at']?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="#">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                      </tr>
                      <?php
                      endforeach;
                          ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">No admins found</td>
                      </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>