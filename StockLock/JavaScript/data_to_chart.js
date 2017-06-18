var retrieveGraphData = function(symbol, callback){
  var elements = [];
  elements.push(new Element(symbol));

  var sendData = JSON.stringify(new InteractiveChartDataInput(10, "Day", "Day", elements));
  console.log(sendData);
  $.post("/StockLock/PHP/api_interactions/get_graph_data.php", {specifics:sendData}, function(data,status) {
    callback(data);
  });
}

var dataToChartSpecifics = function(data){
  var datasets = [];
  var element = data.Elements[0];
  var labels = data.Labels.x.text;

  for(var index = 0; index < labels.length; index++){
    labels[index] = labels[index].replace(' 00:00:00 UTC+00:00', '').substring(4);
    console.log(labels[index]);
  }

  datasets.push(new Dataset(element.Symbol, element.DataSeries.close.values));
  return new ChartInput(new Data(labels, datasets));
}
