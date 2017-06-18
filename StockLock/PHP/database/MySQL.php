<?php
  $servernameDB = "mysql.cs.iastate.edu";
  $usernameDB = "dbu319t11";
  $passwordDB = "crA2?bru";
  $dbname = "db319t11";

  // Create connection
  $conn = new mysqli($servernameDB, $usernameDB, $passwordDB, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
  }
 ?>
