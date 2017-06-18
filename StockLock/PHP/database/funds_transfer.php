<?php
  function insertTransaction($conn, $userID, $amountChanged){
    date_default_timezone_set("America/Chicago");
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO fundsTransfer(userID, amountTransferred, dateTransferred)
            VALUES ($userID, $amountChanged, '$now')";

    if (mysqli_query($conn, $sql)) {
      return true;
    }
    else{
      return false;
    }
  }

  function moneyTransferedHistory($conn, $userID){
    $sql = "SELECT fundsTransfer.dateTransferred, fundsTransfer.amountTransferred, users.bankRoutingNumber
            FROM fundsTransfer INNER JOIN users ON users.userID=fundsTransfer.userID
            WHERE fundsTransfer.userID=$userID ORDER BY dateTransferred DESC";
    return mysqli_query($conn, $sql);
  }
 ?>
