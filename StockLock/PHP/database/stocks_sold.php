<?php
  function insertSellStock($conn, $userID, $stockID, $numberSold, $price){
    date_default_timezone_set("America/Chicago");
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO stocksSold(userID, stockID, price, numberSold, dateSold)
            VALUES ('$userID', '$stockID', '$price', $numberSold, '$now')";

    if (mysqli_query($conn, $sql)) {
      return true;
    }
    else{
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      return false;
    }
  }

  function getStocksSold($conn, $userID){
    $sql = "SELECT * FROM stocksSold INNER JOIN symbols ON stocksSold.stockID=symbols.stockID
            WHERE userID ='$userID' ORDER BY dateSold DESC";
    return mysqli_query($conn, $sql);
  }
 ?>
