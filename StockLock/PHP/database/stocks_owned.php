<?php
  require_once("stocks_bought.php");
  function removeFromStocksOwned($conn, $userID, $stockID, $numberToRemove){

    $numShares = getNumShares($conn, $userID, $stockID);

    if($numShares > $numberToRemove){
      $toUpdate = $numShares - $numberToRemove;
      $sql = "UPDATE stocksOwned SET numberOfSharesOwned='$toUpdate' WHERE userID=$userID AND stockID=$stockID";

      if (mysqli_query($conn, $sql)) {
        return true;
      }
      else {
        return mysqli_error($conn);
      }
    }
    else if($numShares == $numberToRemove){
      $sql = "DELETE stocksOwned WHERE ownershipID='$ownershipID'";

      if (mysqli_query($conn, $sql)) {
        return true;
      }
      else {
        return mysqli_error($conn);
      }
    }
    else {
      return false;
    }
  }

  function insertToStocksOwned($conn, $userID, $stockID, $numberToAdd){

    $numShares = getNumShares($conn, $userID, $stockID);

    if($numShares > 0){
      $numShares += $numberToAdd;
      $sql = "UPDATE stocksOwned SET numberOfSharesOwned=$numShares WHERE userID=$userID AND stockID=$stockID";

      if (mysqli_query($conn, $sql)) {
        return true;
      }
      else {
        return mysqli_error($conn);
      }
    }
    else {
      $sql = "INSERT INTO stocksOwned(numberOfSharesOwned, stockID, userID)
              VALUES($numberToAdd, $stockID, $userID)";

      if (mysqli_query($conn, $sql)) {
        return true;
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return mysqli_error($conn);
      }
    }
  }

  function getCurrentStockData($conn, $userID){
    //returns each stock owned with $symbolID, $lastBoughtDate, $lastBoughtPrice, $sharesOwned
    $sql = "SELECT * FROM stocksOwned INNER JOIN symbols ON stocksOwned.stockID=symbols.stockID WHERE userID=$userID";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      $nullVal = null;
      $stocksArray = array();
      while($row = mysqli_fetch_assoc($result)){
        $stockID = $row["stockID"];
        $lastPurchaseData = getLastBought($conn, $userID, $stockID);
        array_push($row, $lastPurchaseData);
        array_push($stocksArray, $row);
      }
      return $stocksArray;
    }
  }

  function getNumShares($conn, $userID, $stockID){
    $sql = "SELECT numberOfSharesOwned FROM stocksOwned WHERE userID='$userID' AND stockID = $stockID";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      return mysqli_fetch_assoc($result)["numberOfSharesOwned"];
    }
    else{
      return 0;
    }
  }
 ?>
