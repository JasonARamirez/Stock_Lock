<?php
  require_once("./database/MySQL.php");
  require_once("./database/symbol.php");
  require_once("./database/stocks_bought.php");
  require_once("./database/users.php");
  require_once("./database/stocks_owned.php");

  session_start();
  $userID = $_SESSION["userID"];
  $symbol = $_POST["symbol"];
  $price = $_POST["price"];
  $numberToBuy = $_POST["numberToBuy"];

  $symbolID = getSymbolID($conn, $symbol);
  $insertToStocksBoughtComplete = insertBuyStock($conn, $userID, $symbolID, $price, $numberToBuy);
  if($insertToStocksBoughtComplete){
    $moneyRemovedComplete = removeMoney($conn, $userID, ($price * $numberToBuy));
    if($moneyRemovedComplete){
      $insertToStocksOwnedComplete = insertToStocksOwned($conn, $userID, $symbolID, $numberToBuy);
      if($insertToStocksOwnedComplete){
        echo true;
        exit();
      }
    }
  }
  echo false;
?>
