<?php
  require_once("./database/MySQL.php");
  require_once("./database/users.php");
  require_once("./api_interactions/routing_numbers.php");
  require_once("./classes/profile_data.php");
  session_start();

  function discreteBankAccount($bankAccount){
    $discreteBankAccount = "";
    $length = strlen($bankAccount);
    $maxIndex = $length - 4;
    if($maxIndex < 4){
      $maxIndex = round($length/2);
    }
    for($index = 0; $index < $length; $index++){
      if($index < $maxIndex){
        $discreteBankAccount .= "x";
      }
      else{
        $discreteBankAccount .= $bankAccount[$index];
      }
    }
    return $discreteBankAccount;
  }

  $userID = $_SESSION["userID"];
  $user = getUserData($conn, $userID);

  $fullName = $user["firstName"]." ".$user["lastName"];
  $email = $user["email"];
  $moneyInStockLock = $user["accountBalance"];
  $bankName = getBankName($user["bankRoutingNumber"]);
  $bankAccount = discreteBankAccount($user["bankAccountNumber"]);

  $profile = new profileData($fullName, $email, $moneyInStockLock, $bankName, $bankAccount);
  echo json_encode($profile);
 ?>
