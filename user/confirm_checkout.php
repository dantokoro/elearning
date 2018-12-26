<?php
        session_start();
        require 'login/db.php';
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $email = $_SESSION['email'];
        $abalance=$request->abalance;
        $sid=$request->student_id;
        $cid=$request->course_id;
        //file_put_contents("hello.txt",array($name,$emai,$email, $password,$address,$DOB));
        
        $table = '"Student"';
        $query = "UPDATE {$table} SET buget=$abalance WHERE student_id=$sid";
        $result = pg_query($con,$query) or die(pg_errormessage($con));
        $table = '"Enrolled"';
        $query = "INSERT INTO $table(student_id,course_id,enrolled_date) VALUES ($sid,$cid,CURRENT_TIMESTAMP)";
        $result = pg_query($con,$query) or die(pg_errormessage($con));
?>