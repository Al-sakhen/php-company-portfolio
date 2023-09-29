<?php

session_start();
require('../includes/connection.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `blogs` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    if(mysqli_num_rows($query) > 0) { // data found
        $deleteSql = "DELETE FROM `blogs` WHERE `id` = $id";
        if(mysqli_query($connection, $deleteSql)) {
            // delete related image for this admin
            $blog = mysqli_fetch_assoc($query);
            $image = $blog['image'];
            unlink('../uploads/blogs/'.$image);
            $_SESSION['success'] = 'Blog deleted successfully';
            header('location: ../blogs.php');
        }

    } else {
        $_SESSION['errors'] = ['data not found'];
        header('location: ../blogs.php');
    }



} else {
    $_SESSION['errors'] = ['Something went wrong'];
    header('location: ../blogs.php');
}
