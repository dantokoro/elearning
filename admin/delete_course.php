<?php
    include 'connect.php';
    $get_id = $_GET['id'];
    $query_str = 'DELETE FROM "Course" WHERE course_id = ' . $get_id;
    pg_query($query_str) or die(pg_errormessage());
    header('location: course.php');
?>