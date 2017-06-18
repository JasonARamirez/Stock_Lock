<?php
  require("./api_interactions/mark_it_ondemand.php");
  require("./classes/company_data.php");

  error_reporting(0);

  $companyName = $_POST["company"];
  $companyName = str_replace(" ","%20", $companyName);

  $companies = lookUpStock($companyName);
  $companyQuotes = [];

  for($index = 0; $index < count($companies); $index++){
    $company = $companies[$index];
    $companySymbol = $company->{"Symbol"};
    $companySymbol = str_replace(" ","%20", $companySymbol);
    $quote = getStockQuote($companySymbol);
    if($quote->{"Status"} == "SUCCESS"){
      $companyData = new companyData($company, $quote);
      array_push($companyQuotes, $companyData);
    }
  }

  echo json_encode($companyQuotes);
 ?>
