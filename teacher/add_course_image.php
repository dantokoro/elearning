<?php
    session_start();
    include 'autoload/autoload.php';
    include '../admin/connect.php';

    $id = $_SESSION['last_id'];
    $cover = upload_image($_FILES['cover']);
    $avatar = upload_image($_FILES['avatar']);

    $table = '"Course"';
    $query = "UPDATE $table SET cover=$1, avatar=$2 WHERE course_id=$3";
    pg_prepare($conn, "add_img", $query);
    pg_execute($conn, "add_img", array($cover, $avatar, $id));
    header('Location: index.php');
?>