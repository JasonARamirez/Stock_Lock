<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Lock</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./JavaScript/Classes/interactive_chart_data_input.js"></script>
    <script src="./JavaScript/Classes/chart_input.js"></script>
    <script src="./JavaScript/data_to_chart.js"></script>
    <script>
    $(function(){
      $("#header").load("./HTML/before_log_in_header.html");
    });
    </script>
  </head>
  <body bgcolor="#677077">
    <div id="header"></div>
    <div class="jumbotron vertical-center">
      <div class="container text-center">
        <h3>Watch Your Investments Grow!</h3>
        <p align="center">
          <canvas id="myChart" width="150" height="150"></canvas>
        </p>
      </div>
    </div>
    <script>
    retrieveGraphData("TWTR", function(data){
      console.log(data);
      var ctx = $("#myChart");
      var myChart = new Chart(ctx, dataToChartSpecifics(JSON.parse(data)));
    });
    </script>
  </body>
</html>
