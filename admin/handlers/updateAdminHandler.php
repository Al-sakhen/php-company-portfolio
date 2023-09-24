<?php
session_start();
require('../includes/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

    $name = strip_tags(trim($name));
    $email = strip_tags(trim($email));
    $is_active = strip_tags(trim($is_active));
    $id = $admin_id;
    $sql = "SELECT * FROM `admins` WHERE `id` = $id";
    $query = mysqli_query($connection, $sql); // num of rows
    $admin= mysqli_fetch_assoc($query);
    $oldImage = $admin['image'];
 

    $errors = [];
    // Validate Name => Required | String | min:3 | max:50
    if(empty($name)) {
        $errors[] = "Name is required";
    } elseif(! is_string($name)) {
        $errors[] = "Name must be a string";
    } elseif(strlen($name) < 3 || strlen($name) > 50) {
        $errors[] = "Name length must be between 3 and 50";
    }

    // Validate Email => Required | String | min:3 | max:50 | Email
    if(empty($email)) {
        $errors[] = "Email is required";
    } elseif(! is_string($email)) {
        $errors[] = "Email must be a string";
    } elseif(strlen($email) < 3 || strlen($email) > 50) {
        $errors[] = "Email length must be between 3 and 50";
    } elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email address";
    }

    // Validate Status => Required | String | in:active,not_active
    if(empty($is_active)) {
        $errors[] = "Status is required";
    } elseif(! is_string($is_active)) {
        $errors[] = "Status must be a string";
    } elseif(! in_array($is_active, ['active', 'not_active'])) {
        $errors[] = "Status must be active or not_active";
    }

    // Validate Image => Image | max:5MB | in:jpg,png,jpeg,webp
    if($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size']; //b

        $allowed_extensions = ['jpg', 'png', 'jpeg', 'webp'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

        $newName = uniqid().$name.'.'.$image_extension;

        if(! in_array($image_extension, $allowed_extensions)) {
            $errors[] = "Image must be jpg, png, jpeg or webp";
        } elseif($image_size > 5 * 1024 * 1024) {
            $errors[] = "Image size must be less than 5MB";
        }
    } else {
        $newName =  $oldImage;
    }

    if(empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
        $sql = "UPDATE `admins` SET `name`='$name', `email`='$email', `is_active`='$is_active', `image`='$newName' WHERE `id`=$id";
        if(mysqli_query($connection, $sql)) {
            if($_FILES['image']['name']) {
                move_uploaded_file($image_tmp, "../uploads/$newName");
                if($oldImage != 'default.png'){
                    unlink('../uploads/'.$oldImage);
                }
            }
            $_SESSION['success'] = "Admin updated successfully";
            header("location: ../admins.php");
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../add-admin.php");
    }

}
