<?php
session_start();
require('../includes/connection.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `admins` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    if(mysqli_num_rows($query) > 0){ // data found
        $deleteSql = "DELETE FROM `admins` WHERE `id` = $id";
        if(mysqli_query($connection, $deleteSql)){
            // delete related image for this admin
            $admin = mysqli_fetch_assoc($query);
            $image= $admin['image'];
            if($image != 'default.png'){
                unlink('../uploads/'.$image);
            }
            $_SESSION['success'] = 'Admin deleted successfully';
            header('location: ../admins.php');
        }

    }else{
        $_SESSION['errors'] = ['data not found'];
        header('location: ../admins.php');
    }



}else{
    $_SESSION['errors'] = ['Something went wrong'];
    header('location: ../admins.php');
}
?>