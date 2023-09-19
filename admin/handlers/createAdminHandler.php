<?php

session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

    $name = strip_tags(trim($name));
    $email = strip_tags(trim($email));
    $password = strip_tags(trim($password));
    $is_active = strip_tags(trim($is_active));

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

    // Validate Password => Required | String | min:8
    if(empty($password)) {
        $errors[] = "Password is required";
    } elseif(! is_string($password)) {
        $errors[] = "Password must be a string";
    } elseif(strlen($password) < 8) {
        $errors[] = "Password length must be at least 8";
    } elseif(! preg_match("#[0-9]+#", $password)) {
        $errors[] = "Password must contain at least 1 number";
    } elseif(! preg_match("#[a-z]+#", $password)) {
        $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif(! preg_match("#[A-Z]+#", $password)) {
        $errors[] = "Password must contain at least 1 uppercase letter";
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
        $newName = 'default.png';
    }

    if(empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
        $sql = "INSERT into `admins` (`name`, `email`, `password`, `is_active`, `image`) VALUES
         ('$name', '$email', '$password', '$is_active', '$newName')";
        if(mysqli_query($connection, $sql)) {
            move_uploaded_file($image_tmp, "../uploads/$newName");
            $_SESSION['success'] = "Admin added successfully";
            header("location: ../admins.php");
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../add-admin.php");
    }

}
