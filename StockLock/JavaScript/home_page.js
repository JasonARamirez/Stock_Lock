var attachNewCompany= function(parent, data, chartSpecifics, totalMoney){
  var newOuterRow = $('<div class="row"></div>');
  var newJumbotron = $('<div class="jumbotron verical-center innerJumbotron"></div>');
  var newInnerRow = $('<div class="row"></div>');
  var dataSide = $('<div class="col-sm-6"></div>');
  var chartSide = $('<div class="col-sm-6"></div>');
  var chartJumbo = $('  <div class="jumbotron"><p align="center"></p></div>');
  dataSide.append($('<h3>' + data.company.name + '</h3>'));
  dataSide.append($('<h4>' + data.company.exchange + ': ' + data.company.symbol +'</h4>'));
  dataSide.append($('<h4>Current Price: ' + data.company.currentPrice + ' USD</h4>'));
  dataSide.append($('<h4>Change Percent: ' + + data.company.percentChange + '%</h4>'))
  dataSide.append($('<h4>Last Bought on: ' + data.user.lastBought + '</h4>'));
  dataSide.append($('<h4>Price Last Bought: ' + data.user.priceLastBought + '</h4>'));
  dataSide.append($('<h4>Shares Owned: ' + data.user.sharesOwned + '</h4>'));
  var sellButton = $('<input type="button" value="Sell">');
  sellButton.click(function(){
    sell(data.company.symbol, data.company.currentPrice, data.user.sharesOwned, function(isSold){
      console.log(isSold);
      if(isSold == '1'){
        getUserData(function(data){
          extractUserData(data);
        });
      }
    });
  });
  dataSide.append(sellButton);
  var buyButton = $('<input type="button" value="Buy">');
  buyButton.click(function(){
    buy(data.company.symbol, data.company.currentPrice, totalMoney, function(isBought){
      if(isBought == '1'){
        getUserData(function(data){
          extractUserData(data);
        });
      }
    });
  });
  dataSide.append(buyButton);
  newInnerRow.append(dataSide);

  var ctx = $('<canvas width="150" height="150"></canvas>');
  chartJumbo.append(ctx);
  chartSide.append(chartJumbo);
  newInnerRow.append(chartSide);
  newJumbotron.append(newInnerRow);
  newOuterRow.append(newJumbotron);
  parent.append(newOuterRow);
  var myChart = new Chart(ctx, chartSpecifics);
}

var resetPage = function(){
  $('#loading').show();
  $('#parent').empty();
}

var extractUserData = function(data){
  var container = $('#parent');
  container.append($('<h2 align="center">Hello ' + data.firstName + ' ' + data.lastName + '!</h2>'));
  container.append($('<h3 align="center">Here are your current investments</h3>'));
  var allCompanies = data.companies;

  for(var index = 0; index < allCompanies.length; index++){
    var insertInfo = function(companyUserData){
      retrieveGraphData(companyUserData.company.symbol, function(chartData){
        var chartSpecifics = dataToChartSpecifics(JSON.parse(chartData));
        attachNewCompany(container, companyUserData, chartSpecifics, data.totalMoney);
      });
    }
    insertInfo(allCompanies[index]);
  }
  $('#loading').hide();
}

var getUserData = function(callback){
  resetPage();
  $.post("../PHP/get_user_data.php", {}, function(data,status) {
    console.log(data);
    callback(JSON.parse(data));
  });
}

$( document ).ready(function() {
  getUserData(function(data){
    extractUserData(data);
  });
});
