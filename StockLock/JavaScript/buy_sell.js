var buy = function(symbol, price, totalMoney, callback){
  var num = prompt('How many shares would you like to buy from ' + symbol + ' for: $' + price + ' a share?');
  if(num != null){
    if(price * num < totalMoney){
      $.post("/StockLock/PHP/buy.php", {symbol:symbol, price:price, numberToBuy:num}, function(data,status) {
        console.log(data);
        callback(data);
      });
    }
    else {
      alert('You do not have enough money to buy all those shares.');
    }
  }
}

var sell = function(symbol, price, totalShares, callback){
  var num = prompt('How many shares would you like to sell from ' + symbol + ' for: $' + price + ' a share?');
  if(num != null){
    if(parseInt(num) <= totalShares){
      $.post("/StockLock/PHP/sell.php", {symbol:symbol, price:price, numberToSell:num}, function(data,status) {
        callback(data);
      });
    }
    else {
      alert('You do not have that many shares to sell');
    }
  }
}
