<?php
    session_start();
    ob_start();
    include '../admin/connect.php';

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $name = $request->name;
    $fee = $request->fee;
    $category = $request->category;
    $archievement = $request->archievement;
    $requirement = $request->requirement;
    $description = $request->description;

    /* add to table Course */ 
    $table = '"Course"';
    $query = "INSERT INTO $table(name, price, created_at) VALUES ($1, $2, $3) RETURNING course_id";
    pg_prepare($conn, "course_info", $query);
    $result = pg_execute($conn, "course_info", array($name, $fee, 'now()'));
    $id = pg_fetch_array($result);
    $inserted_id = $id[0];
    $_SESSION['last_id'] = $inserted_id;

    /* add to category */
    $temp = explode("| ", $category);
    // convert to uppercase first letter
    foreach($temp as $value) {
        $uced = ucfirst($value);
        $value = $uced;
    }
    $table = '"Category"';
    $query = "SELECT * FROM $table";
    $result = pg_query($conn, $query);
    $cat_list = pg_fetch_all($result);
    $cat = array();
    foreach($cat_list as $row) {
        $cat[$row['category_id']] = $row['category'];
    }

    // query to insert category
    $table = '"Category"';
    $query_add_cat = "INSERT INTO {$table}(category) VALUES ($1) RETURNING category_id";
    pg_prepare($conn, "add_cat", $query_add_cat);
    // query to insert to course category
    $cattable = '"CourseCategory"';
    $query = "INSERT INTO $cattable(course_id, category_id) VALUES ($1, $2)";
    pg_prepare($conn, "course_cat", $query);
    // check each category posted by teacher has been added to database if not add to database 
    // then process adding function
    foreach($temp as $key => $value) {
        $id = array_search(ucfirst($value), $cat);
        if($id) { // if this category existed 
            pg_execute($conn, "course_cat", array($inserted_id, $id));
        } else { // if not
            $result = pg_execute($conn, "add_cat", array($value));
            // get previous inserted category
            $id = pg_fetch_array($result);
            $oid = $id[0];
            pg_execute($conn, "course_cat", array($inserted_id, $oid));
        }
    } 

    /* add to table archievement */
    $temp = explode("| ", $archievement);
    $table = '"CourseArchievemnt"';
    $query = "INSERT INTO $table(course_id, description) VALUES ($1, $2)";
    pg_prepare($conn, "course_arc", $query);
    foreach($temp as $value) {
        pg_execute($conn, "course_arc", array($inserted_id, $value));
    }

    /* add to table archievement */
    $temp = explode("| ", $requirement);
    $table = '"CourseRequirement"';
    $query = "INSERT INTO $table(course_id, description) VALUES ($1, $2)";
    pg_prepare($conn, "course_req", $query);
    foreach($temp as $value) {
        pg_execute($conn, "course_req", array($inserted_id, $value));
    }


    /* add to table archievement */
    $temp = explode(", ", $description);
    $table = '"CourseDescription"';
    $query = "INSERT INTO $table(course_id, description) VALUES ($1, $2)";
    pg_prepare($conn, "course_des", $query);
    foreach($temp as $value) {
        pg_execute($conn, "course_des", array($inserted_id, $value));
    }

    /* add reference with teacher */
    $table = '"AssignTeacher"';
    $query = "INSERT INTO $table(teacher_id, course_id, assigned_date) VALUES ($1, $2, $3)";
    pg_prepare($conn, "teacher_course", $query);
    pg_execute($conn, "teacher_course", array($_SESSION['id'], $inserted_id, 'now()'));
?>