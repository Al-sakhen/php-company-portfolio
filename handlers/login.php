<?php
session_start();
require('../admin/includes/connection.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $email = strip_tags(trim($email));
    $password = strip_tags(trim($password));

    $errors = [];
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
    }


    if(empty($errors)) {
        $sql ="SELECT * FROM `users` WHERE `email` = '$email'";
        $query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($query)){
            // ---------- admin is found => email is correct ----------
            $user = mysqli_fetch_assoc($query);
            $userPassword = $user['password'];
            if( password_verify($password , $userPassword) ){
                $_SESSION['user_id'] = $user['id'];
                header("location: ../index.php");
            }else{
                // ---------- admin is found => email is correct => password is incorrect ----------
                $_SESSION['errors'] = ['Email or password is incorrect'];
                header("location: ../login.php");
            }

        }else{
            // ---------- admin is not found => email is incorrect ----------
            $_SESSION['errors'] = ['Email or password is incorrect'];
        header("location: ../login.php");

        }

    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../login.php");
    }
} else {

}
