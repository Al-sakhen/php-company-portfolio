<?php

session_start();
require('../includes/connection.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `sliders` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    if(mysqli_num_rows($query) > 0) { // data found
        $deleteSql = "DELETE FROM `sliders` WHERE `id` = $id";
        if(mysqli_query($connection, $deleteSql)) {
            // delete related image for this admin
            $slider = mysqli_fetch_assoc($query);
            $image = $slider['image'];
            unlink('../uploads/sliders/'.$image);
            $_SESSION['success'] = 'Slider deleted successfully';
            header('location: ../sliders.php');
        }

    } else {
        $_SESSION['errors'] = ['data not found'];
        header('location: ../sliders.php');
    }



} else {
    $_SESSION['errors'] = ['Something went wrong'];
    header('location: ../sliders.php');
}
