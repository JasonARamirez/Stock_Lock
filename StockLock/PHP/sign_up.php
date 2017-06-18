<?php
  require_once("./database/MySQL.php");
  require_once("./database/users.php");

  $firstName = $_POST["first_name"];
  $lastName = $_POST["last_name"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
  $confirmPassword = md5($_POST["confirm_password"]);
  $routing = $_POST["bank_routing"];
  $bankAccount = $_POST["bank_account"];

  if($password == $confirmPassword){
    $emailExists = checkIfEmailExists($conn, $email);
    if(!$emailExists){
      $userCreated = createUser($conn, $password, $firstName, $lastName, $email, $routing, $bankAccount);
      if($userCreated){
        header('Location: ../HTML/log_in.html');
        exit();
      }
    }
  }
  header('Location: ../HTML/sign_up.html');
 ?>
