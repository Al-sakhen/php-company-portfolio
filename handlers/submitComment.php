<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_SESSION['user_id'];
        $comment = $_POST['comment'];
        $blog_id = $_POST['blog_id'];

        $connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
        $sql = "INSERT INTO `comments`(`user_id`, `blog_id`, `comment`) VALUES ($user_id,$blog_id,'$comment')";
        if (mysqli_query($connection, $sql)) {
            header("Location: ". $_SERVER['HTTP_REFERER'] );
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

    }else {
        header("Location: ". $_SERVER['HTTP_REFERER'] );
    }


?>