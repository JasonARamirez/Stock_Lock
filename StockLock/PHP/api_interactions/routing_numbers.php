<?php
  function getBankName($routingNumber){
    $rn = null;
    if(count($routingNumber) < 9){
      $rn = json_decode(file_get_contents("https://www.routingnumbers.info/api/data.json?rn="."0".$routingNumber));
    }
    else{
      $rn = json_decode(file_get_contents("https://www.routingnumbers.info/api/data.json?rn=".$routingNumber));
    }

    if($rn->{"code"} == 200){
      return $rn->{"customer_name"};
    }
    else {
      return "Generic Bank Name";
    }
  }
 ?>
