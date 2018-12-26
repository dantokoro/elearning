<?php
        session_start();
        require 'login/db.php';
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $email = $_SESSION['email'];
        $name = pg_escape_literal($request->name);
        $emai = pg_escape_literal($request->email);
        $password = pg_escape_literal($request->password);
        $address = pg_escape_literal($request->address);
        $DOB = pg_escape_literal($request->DOB);
        $balance=$request->balance;
        //file_put_contents("hello.txt",array($name,$emai,$email, $password,$address,$DOB));
        
        $table = '"Student"';
        $query = "UPDATE {$table} SET name=$name, email=$emai , password=$password, address=$address, date_of_birth=$DOB, buget=$balance WHERE email=$email";
        $result = pg_query($con,$query) or die(pg_errormessage($con));
?>