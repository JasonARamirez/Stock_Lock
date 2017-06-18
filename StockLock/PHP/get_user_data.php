<?php
   require_once("./database/MySQL.php");
   require_once("./database/users.php");
   require_once("./database/stocks_owned.php");
   require_once("./classes/company_user_data.php");
   require_once("./classes/user_data.php");
   require_once("./api_interactions/mark_it_ondemand.php");
   session_start();

   $userID = $_SESSION["userID"];
   $userData = getUserData($conn, $userID);

   if($userData != null){
    $toSend = new userData($userData["firstName"], $userData["lastName"], $userData["accountBalance"]);
    $userStocks = getCurrentStockData($conn, $userID);

    for($index = 0; $index < count($userStocks); $index++){
      $userStock = $userStocks[$index];
      $symbol = $userStock["symbol"];
      $stockQuote = getStockQuote($symbol);
      $stockExchange = getStockExchange($symbol);

      $error = strstr($stockQuote->{"Status"}, "FAILURE");
      if(!$error){
        $name = $stockQuote->{"Name"};
        $website = $name.".com";
        $lastPrice = $stockQuote->{"LastPrice"};
        $percentChange = $stockQuote->{"ChangePercent"};
        $company = new company($name, $website, $stockExchange, $symbol, $lastPrice, $percentChange);

        $lastBoughtData = $userStock[0];
        $lastBought = $lastBoughtData["dateBought"];
        $priceLastBought = $lastBoughtData["price"];
        $sharesOwned = $userStock["numberOfSharesOwned"];
        $user = new user($lastBought, $priceLastBought, $sharesOwned);

        $companyUserData = new companyUserData($company, $user);
        $toSend->insertCompany($companyUserData);
      }
    }
    echo json_encode($toSend);
    exit();
   }
   echo "Error";
 ?>
