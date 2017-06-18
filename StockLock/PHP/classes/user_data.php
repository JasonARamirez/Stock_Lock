<?php
  class userData{
    public $firstname;
    public $lastName;
    public $totalMoney;
    public $companies;
    function userData($firstName, $lastName, $totalMoney){
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->companies = [];
      $this->totalMoney = $totalMoney;
    }

    function insertCompany($companyUserData){
      array_push($this->companies, $companyUserData);
    }
  }
 ?>
