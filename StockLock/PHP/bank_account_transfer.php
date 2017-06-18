<?php
  require_once("./database/MySQL.php");
  require_once("./database/users.php");
  require_once("./database/funds_transfer.php");

  session_start();
  $userID = $_SESSION["userID"];
  $amountTransfered = $_POST["amount"];
  $possiblePassword = md5($_POST["password"]);

  $password = getUserPasswordFromUserID($conn, $userID);
  $moneyAddedComplete = false;
  $moneyRemovedComplete = false;

  if($password == $possiblePassword){
    if($amountTransfered > 0){
      $moneyAddedComplete = addMoney($conn, $userID, $amountTransfered);
    }
    else if($amountTransfered < 0){
      $moneyRemovedComplete = removeMoney($conn, $userID, -1.0 * $amountTransfered);
    }

    if($moneyAddedComplete || $moneyRemovedComplete){
      $transferComplete = insertTransaction($conn, $userID, $amountTransfered);
      if($transferComplete){
        echo true;
        exit();
      }
    }
  }
    echo false;
 ?>
