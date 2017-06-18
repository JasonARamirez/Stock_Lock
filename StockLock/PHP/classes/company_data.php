<?php
  class companyData{
    public $Name;
    public $Symbol;
    public $Exchange;
    public $currentPrice;
    public $percentChange;

    function companyData($company, $quote){
      $this->Name = $company->{"Name"};
      $this->Symbol = $company->{"Symbol"};
      $this->Exchange = $company->{"Exchange"};
      $this->currentPrice = $quote->{"LastPrice"};
      $this->percentChange = $quote->{"ChangePercent"};
    }
  }
 ?>
