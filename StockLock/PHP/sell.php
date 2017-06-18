<?php
  require_once("./database/MySQL.php");
  require_once("./database/symbol.php");
  require_once("./database/stocks_sold.php");
  require_once("./database/users.php");
  require_once("./database/stocks_owned.php");
  session_start();

  $userID = $_SESSION["userID"];
  $symbol = $_POST["symbol"];
  $price = $_POST["price"];
  $numberToSell = $_POST["numberToSell"];

  $stockID = getSymbolID($conn, $symbol);
  $insertToStocksSoldComplete = insertSellStock($conn, $userID, $stockID, $numberToSell, $price);
  if($insertToStocksSoldComplete){
    $moneyAddedComplete = addMoney($conn, $userID, ($price * $numberToSell));
    if($moneyAddedComplete){
      $removeFromStocksOwnedComplete = removeFromStocksOwned($conn, $userID, $stockID, $numberToSell);
      if($removeFromStocksOwnedComplete){
        echo true;
        exit();
      }
    }
  }
  echo false;
?>
