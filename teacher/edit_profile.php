<?php
        session_start();
        include '../admin/connect.php';

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $user_id = $_SESSION['id'];
        $name = $request->name;
        $emai = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->address;
        $certificates = $request->certificates;

        //test variables: file_put_contents("hello.txt",array($user_id, $emai, $password, $phone, $address, $certificates));
        
        $table = '"Teacher"';
        $query = "UPDATE {$table} SET name=$1, phone=$2, email=$3, password=$4, address=$5, certificate=$6 WHERE teacher_id=$7";
        pg_prepare($conn, "update", $query);
        $result = pg_execute($conn, "update", array($name, $email, $password, $phone, $address, $certificates, $user_id));
?>