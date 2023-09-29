<?php

session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

    $title = strip_tags(trim($title));
    $body = strip_tags(trim($body));
    $admin_id = $_SESSION['admin']['id'];


    $errors = [];
    // Validate Name => Required | String | min:3 | max:50
    if(empty($title)) {
        $errors[] = "Name is required";
    } elseif(! is_string($title)) {
        $errors[] = "Name must be a string";
    } elseif(strlen($title) < 3 || strlen($title) > 50) {
        $errors[] = "Name length must be between 3 and 50";
    }

    // Validate Body => Required | String | min:3 | max:255
    if(empty($body)) {
        $errors[] = "Name is required";
    } elseif(! is_string($body)) {
        $errors[] = "Name must be a string";
    } elseif(strlen($body) < 3 || strlen($body) > 255) {
        $errors[] = "Name length must be between 3 and 255";
    }

    // Validate Image => Required | max:5MB | in:jpg,png,jpeg,webp
    if(empty($_FILES['image']['name'])){
        $errors[] = "Image is required";
    } 

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size']; //b

    $allowed_extensions = ['jpg', 'png', 'jpeg', 'webp'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

    $newName = uniqid().'blog.'.$image_extension;

    if(! in_array($image_extension, $allowed_extensions)) {
        $errors[] = "Image must be jpg, png, jpeg or webp";
    } elseif($image_size > 5 * 1024 * 1024) {
        $errors[] = "Image size must be less than 5MB";
    }


    if(empty($errors)) {
        $connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
        $sql = "INSERT into `blogs` (`title`, `body`, `admin_id`, `image`) VALUES
         ('$title', '$body', '$admin_id', '$newName')";
        if(mysqli_query($connection, $sql)) {
            move_uploaded_file($image_tmp, "../uploads/blogs/$newName");
            $_SESSION['success'] = "blog added successfully";
            header("location: ../blogs.php");
        } else {
            header("location: ../blogs.php");
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../add-blog.php");
    }

}
