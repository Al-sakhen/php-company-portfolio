<?php
require('./includes/head.php');

$connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
$limit = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1; // ternary operator
if($page < 1){
    header('location:sliders.php?page=1');
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM `sliders` limit $limit offset $offset";
$query = mysqli_query($connection, $sql);
$sliders = mysqli_fetch_all($query, MYSQLI_ASSOC);


// get pagesCount
$countSql = "SELECT count(id) as count FROM `sliders`";
$countQuery = mysqli_query($connection, $countSql);
$count = mysqli_fetch_assoc($countQuery)['count'];
$pagesCount = ceil($count / $limit);
?>
<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">
            <!-- alerts -->
            <?php require('./includes/alerts.php') ?>


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Sliders</h3>
                <a href="./add-slider.php" class="btn btn-secondary">Add Slider</a>

            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Status</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($sliders) > 0) : ?>
                        <?php
                        foreach ($sliders as $slider) :
                            ?>
                            <tr>
                                <th scope="row">
                                    <?= $slider['id'] ?>
                                </th>
                                <td>
                                    <?= $slider['title'] ?>
                                </td>
                                <td>
                                    <?= $slider['body'] ?>
                                </td>
                                <td>
                                    <?= $slider['status'] ?>
                                </td>
                                <td>
                                    <img src="./uploads/sliders/<?= $slider['image'] ?>" alt="" style="width: 150px;">
                                </td>
                                <td>
                                    <?= $slider['created_at'] ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="./edit-slider.php?id=<?= $slider['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- query params  ==> 'route?key=value'    -->
                                    <a class="btn btn-sm btn-danger" href="./handlers/deleteSlideHandler.php?id=<?= $slider['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">No sliders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (count($sliders) > 0) : ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="sliders.php?page=<?= $page-1 ?>">Previous</a>
                    </li>
                    <?php for($i = 1 ; $i <= $pagesCount ; $i++) :?>
                    <li class="page-item"><a class="page-link" href="sliders.php?page=<?=$i?>"><?= $i?></a></li>
                    <?php endfor;?>
                    <li class="page-item <?= $page == $pagesCount || $page > $pagesCount ? 'disabled' : '' ?> ">
                        <a class="page-link" href="sliders.php?page=<?= $page+1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
            <?php endif;?>
        </div>

    </div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>