<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    $(function(){
      $("#header").load("header.html");
    });
    </script>
  </head>
  <body bgcolor="#677077">
    <div id="header"></div>
    <div class="jumbotron vertical-center">
      <h3 align="center">
      <?php require_once("../PHP/database/MySQL.php");
        require_once("../PHP/database/users.php");
        session_start();
        $userID = $_SESSION["userID"];
        echo getFirstNameFromUserID($conn, $userID); ?>'s History</h3>
      <div class="container" id="parent">
        <div class="row">
          <div class="jumbotron innerJumbotron">
            <h3>Stocks Sold</h3>
            <table border='2'>
              <tbody id="stocksSold">
                <tr>
                  <th>Company Symbol</th>
                  <th>Price Sold</th>
                  <th>Shares Sold</th>
                  <th>Revenue</th>
                  <th>Date</th>
                </tr>
                <?php

                  require_once("../PHP/database/stocks_sold.php");

                  $result = getStocksSold($conn, $userID);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<th>".$row["symbol"]."</th>";
                    echo "<th>$".$row["price"]."</th>";
                    echo "<th>".$row["numberSold"]."</th>";
                    echo "<th>$".($row["price"] * $row["numberSold"])."</th>";
                    echo "<th>".$row["dateSold"]."</th>";
                    echo "</tr>";
                  }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="jumbotron innerJumbotron">
            <h3>Stocks Bought</h3>
            <table border='2'>
              <tbody id="stocksBought">
                <tr>
                  <th>Company Symbol</th>
                  <th>Price Bought</th>
                  <th>Shares Bought</th>
                  <th>Investment</th>
                  <th>Date</th>
                </tr>
                <?php
                  require_once("../PHP/database/stocks_bought.php");
                  $result = getStocksBought($conn, $userID);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<th>".$row["symbol"]."</th>";
                    echo "<th>$".$row["price"]."</th>";
                    echo "<th>".$row["numberBought"]."</th>";
                    echo "<th>$".($row["price"] * $row["numberBought"])."</th>";
                    echo "<th>".$row["dateBought"]."</th>";
                  }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="jumbotron innerJumbotron">
            <h3>Money Transfered from Bank</h3>
            <table border='2'>
              <tbody id="moneyTransfered">
                <tr>
                  <th>Bank Name</th>
                  <th>Transfered To or From</th>
                  <th>Amount Transfered</th>
                  <th>Date</th>
                </tr>
                <?php
                  require_once("../PHP/database/funds_transfer.php");
                  require_once("../PHP/api_interactions/routing_numbers.php");
                  $result = moneyTransferedHistory($conn, $userID);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<th>".getBankName($row["bankRoutingNumber"])."</th>";
                    if($row["amountTransferred"] > 0){
                        echo "<th>To</th>";
                    }
                    else {
                      echo "<th>From</th>";
                    }
                    echo "<th>".$row["amountTransferred"]."</th>";
                    echo "<th>".$row["dateTransferred"]."</th>";
                  }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
