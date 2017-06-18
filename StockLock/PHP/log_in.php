<?php
  require_once("./database/MySQL.php");
  require_once("./database/users.php");

  $email = $_POST["email"];
  $possiblePassword = md5($_POST["password"]);

  $actualPassword = getUserPasswordFromEmail($conn, $email);

  if($actualPassword == $possiblePassword){
    $userID = getUserIDFromEmail($conn, $email);
     session_start();
     $_SESSION["userID"] = $userID;
     header('Location: ../HTML/home.html');
     exit();
  }
  header('Location: ../HTML/log_in.html');
 ?>
