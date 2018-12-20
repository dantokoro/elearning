<?php 
  include '../admin/connect.php';
  include 'autoload/autoload.php';

  $query = 'SELECT * FROM "Teacher" WHERE teacher_id = 5';
  $result = pg_query($conn, $query);
  print_r(pg_fetch_all($result));
?>