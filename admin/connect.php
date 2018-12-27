<?php
    include 'autoload/autoload.php';

    $conn = connect('localhost', 'elearning1', 'postgres', 'kien1998') or die(pg_errormessage($conn));
?>