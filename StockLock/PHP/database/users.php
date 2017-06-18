<?php
  function createUser($conn, $password, $firstName, $lastName, $email,  $routing, $bankAccount){
    $sql = "INSERT INTO users(firstName, lastName, email, password, bankRoutingNumber, bankAccountNumber, accountBalance)
            VALUES ('$firstName', '$lastName', '$email', '$password', '$routing', '$bankAccount', 0)";

    if (mysqli_query($conn, $sql)) {
      return true;
    }
    else{
      return false;
    }
  }

  function removeMoney($conn, $userID, $toBeRemoved){
    $userData = getUserData($conn, $userID);

    if($userData != null){
      $totalMoney = $userData["accountBalance"];
      $updatedAccountBalance = $totalMoney - $toBeRemoved;

      if($toBeRemoved <= $totalMoney){
        $sql = "UPDATE users SET accountBalance='$updatedAccountBalance' WHERE userID='$userID'";

        if (mysqli_query($conn, $sql)) {
          return true;
        }
        else {
          return mysqli_error($conn);
        }
      }
    }
    return false;
  }

  function addMoney($conn, $userID, $toAdd){
    $userData = getUserData($conn, $userID);

    if($userData != null){
      $totalMoney = $userData["accountBalance"];
      $updatedAccountBalance = $totalMoney + $toAdd;

      $sql = "UPDATE users SET accountBalance='$updatedAccountBalance' WHERE userID='$userID'";

      if (mysqli_query($conn, $sql)) {
        return true;
      }
      else {
        return mysqli_error($conn);
      }
    }
    return false;
  }

  function getUserData($conn, $userID){
    $sql = "SELECT * FROM users WHERE userID='$userID'";
    $result =  mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
  }

  function getUserPasswordFromEmail($conn, $email){
    $sql = "SELECT password FROM users WHERE email='$email'";
    $result =  mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user["password"];
  }

  function getUserPasswordFromUserID($conn, $userID){
    $sql = "SELECT password FROM users WHERE userID='$userID'";
    $result =  mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user["password"];
  }

  function getUserIDFromEmail($conn, $email){
    $sql = "SELECT userID FROM users WHERE email='$email'";
    $result =  mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user["userID"];
  }

  function getFirstNameFromUserID($conn, $userID){
    $sql = "SELECT firstName FROM users WHERE userID='$userID'";
    $result =  mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user["firstName"];
  }

  function checkIfEmailExists($conn, $email){
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    return (mysqli_num_rows($result) > 0);
  }
 ?>
