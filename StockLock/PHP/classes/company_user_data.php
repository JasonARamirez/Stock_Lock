<?php
  class companyUserData{
    public $company;
    public $user;

    function companyUserData($company, $user){
      $this->company = $company;
      $this->user = $user;
    }
  }

  class company{
    public $name;
    public $website;
    public $exchange;
    public $symbol;
    public $currentPrice;
    public $percentChange;

    function company($name, $website, $exchange, $symbol, $currentPrice, $percentChange){
      $this->name = $name;
      $this->website = $website;
      $this->exchange = $exchange;
      $this->symbol = $symbol;
      $this->currentPrice = $currentPrice;
      $this->percentChange = $percentChange;
    }
  }

  class user{
    public $lastBought;
    public $priceLastBought;
    public $sharesOwned;

    function user($lastBought, $priceLastBought, $sharesOwned){
      $this->lastBought = $lastBought;
      $this->priceLastBought = $priceLastBought;
      $this->sharesOwned = $sharesOwned;
    }
  }
 ?>
