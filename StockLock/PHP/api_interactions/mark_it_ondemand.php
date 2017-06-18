<?php
  function getStockQuote($symbol){
    return json_decode(file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=".$symbol));
  }

  function lookUpStock($company){
    return json_decode(file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/Lookup/json?input=".$company));
  }

  function getStockGraph($symbol){
    return json_decode(file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters=".$symbol));
  }

  function getStockExchange($symbol){
    $companyArrays = lookUpStock($symbol);

    for($index = 0; $index < count($companyArrays); $index++){
      $company = $companyArrays[$index];
      $companySymbol = $company->{"Symbol"};
      if(strcmp($companySymbol, $symbol) == 0){
        return $company->{"Exchange"};
      }
    }
    return null;
  }
 ?>
