<?php
    require_once 'Function.php';
    function connect($host, $dbname, $user, $password)
        {
            $conn_string = "host={$host} dbname={$dbname} user={$user} password={$password}";
            return pg_connect($conn_string);
        }
?>