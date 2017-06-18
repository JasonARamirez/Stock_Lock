<?php
  function insertBuyStock($conn, $userID, $stockID, $price, $numberToBuy){
    date_default_timezone_set("America/Chicago");
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO stocksBought(userID, stockID, price, numberBought, dateBought)
            VALUES ('$userID', '$stockID', '$price', $numberToBuy, '$now')";

    if (mysqli_query($conn, $sql)) {
      return true;
    }
    else{
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      return false;
    }
  }

  function getStocksBought($conn, $userID){
    $sql = "SELECT * FROM stocksBought INNER JOIN symbols ON stocksBought.stockID=symbols.stockID
            WHERE userID='$userID' ORDER BY dateBought DESC";
    return mysqli_query($conn, $sql);
  }

  function getLastBought($conn, $userID, $stockID){
    $sql = "SELECT * FROM stocksBought WHERE userID=$userID AND stockID=$stockID
            ORDER BY dateBought DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
  }
 ?>
