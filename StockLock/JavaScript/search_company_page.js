
var resetPage = function(){
  $('#parent').empty();
}

var attachNewCompany= function(parent, company, totalMoney){
  var newOuterRow = $('<div class="row"></div>');
  var newJumbotron = $('<div class="jumbotron verical-center innerJumbotron"></div>');
  var newInnerRow = $('<div class="row"></div>');
  var dataSide = $('<div class="col-sm-6"></div>');
  var chartSide = $('<div class="col-sm-6"></div>');
  var chartJumbo = $('  <div class="jumbotron"><p align="center"></p></div>');
  dataSide.append($('<h3>' + company.Name + '</h3>'));
  dataSide.append($('<h4>' + company.Exchange + ': ' + company.Symbol +'</h4>'));
  dataSide.append($('<h4>$' + company.currentPrice + ' USD</h4>'));
  dataSide.append($('<h4>' + company.percentChange + '%</h4>'))
  var buyButton = $('<input type="button" value="Buy">');
  buyButton.click(function(){
    buy(company.Symbol, company.currentPrice, totalMoney, function(data){
      if(data == 1){
        alert("Stock: " + company.Symbol + "bought!");
      }
      else{
        alert("An Error occuered");
      }
    });
  });
  dataSide.append(buyButton);
  newInnerRow.append(dataSide);
  var ctx = $('<canvas width="150" height="150"></canvas>');
  chartJumbo.append(ctx)
  chartSide.append(chartJumbo);
  newInnerRow.append(chartSide);
  newJumbotron.append(newInnerRow);
  newOuterRow.append(newJumbotron);
  parent.append(newOuterRow);

  retrieveGraphData(company.Symbol, function(data){
    console.log(data);
    var chartSpecifics = dataToChartSpecifics(JSON.parse(data));
    var myChart = new Chart(ctx, chartSpecifics);
    $('#loading').hide();
  });
}

var searchCompanies = function(){
    var companyName = $('#getCompanyName').val();
    if(companyName.length > 0){
      $('#loading').show();
      $.post("../PHP/search_company.php", {company:companyName}, function(data,status){
        console.log(data);
        var companyDataArray = JSON.parse(data);
        if(companyDataArray.length > 0){
          $.post('../PHP/get_total_money.php', {}, function(totalMoney, status){
            resetPage();


            companyDataArray.forEach(function(company){
              console.log(JSON.stringify(company));
              attachNewCompany($('#parent'), company, parseFloat(totalMoney));
            });
          });
        }
        else {
          $('#loading').hide();
          alert('Company does not appear to exist');
        }
      });
    }
    else {
      alert('Write a company name in the search bar.');
    }
}


$( document ).ready(function(){
  $('#loading').hide();
  $('#searchBtn').click(function(){
    searchCompanies()
  });
});
