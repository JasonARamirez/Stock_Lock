<?php
  function getSymbolID($conn, $symbol){
    $sql = "SELECT stockID FROM symbols WHERE symbol='$symbol'";
    $result =  mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) == 0){
      $inserted = insertSymbol($conn, $symbol);
      return getSymbolID($conn, $symbol);
    }
    else {
      return mysqli_fetch_assoc($result)["stockID"];
    }
  }

  function insertSymbol($conn, $symbol){
    $sql = "INSERT INTO symbols(symbol)
            VALUES ('$symbol')";

    if (mysqli_query($conn, $sql)) {
      return true;
    }
    else{
      return false;
    }
  }
 ?>
