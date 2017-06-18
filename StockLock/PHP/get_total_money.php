<?php
  require_once("./database/MySQL.php");
  require_once("./database/users.php");
  session_start();

  $userID = $_SESSION["userID"];
  $userData = getUserData($conn, $userID);

  if($userData != null){
    echo $userData["accountBalance"];
  }
  else {
    echo null;
  }
 ?>
