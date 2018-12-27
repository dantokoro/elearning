<?php
    include 'autoload/autoload.php';

    $conn = connect('localhost', 'postgres', 'postgres', '123456') or die(pg_errormessage($conn));
?>