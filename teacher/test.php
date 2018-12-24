<?php 
    require('header.php');
    include '../admin/connect.php';
    include 'autoload/autoload.php';

    $inserted_id = 24;
    $table = '"Category"';
    $query = "SELECT * FROM $table";
    $result = pg_query($conn, $query);
    $cat_list = pg_fetch_all($result);
    $cat = array();
    foreach($cat_list as $row) {
        $cat[$row['category_id']] = $row['category'];
    }
    $temp = array('IT', 'Japanese');
    $table = '"Category"';
    $query_add_cat = "INSERT INTO {$table}(category) VALUES ($1) RETURNING category_id";
    pg_prepare($conn, "add_cat", $query_add_cat);
    $cattable = '"CourseCategory"';
    $query = "INSERT INTO $cattable(course_id, category_id) VALUES ($1, $2)";
    pg_prepare($conn, "course_cat", $query);
    // check each category posted by teacher has been added to database if not add to database 
    // then process adding function
    foreach($temp as $key => $value) {
        $id = array_search(ucfirst($value), $cat);
        if($id) {
            pg_execute($conn, "course_cat", array($inserted_id, $id));
            echo 'add exist <br>';
        } else {
            $result = pg_execute($conn, "add_cat", array($value));
            $id = pg_fetch_array($result);
            $oid = $id[0];
            pg_execute($conn, "course_cat", array($inserted_id, $oid));
            echo 'add non exist <br>';
        }
    } 

?>

