<?php
  class profileData{
    public $fullName;
    public $email;
    public $moneyInStockLock;
    public $bankName;
    public $bankAccount;

    function profileData($fullName, $email, $moneyInStockLock, $bankName, $bankAccount){
      $this->fullName = $fullName;
      $this->email = $email;
      $this->moneyInStockLock = $moneyInStockLock;
      $this->bankName = $bankName;
      $this->bankAccount = $bankAccount;
    }
  }
 ?>
