<?php
  try{
    echo file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters=".$_POST["specifics"]);
  }catch(Exception $e){
    echo "{\"Labels\":{\"x\":{\"text\":[\"Fri Oct 28 00:00:00 UTC+00:00 2016\",\"Mon Oct 31 00:00:00 UTC+00:00 2016\",\"Tue Nov 1 00:00:00 UTC+00:00 2016\",\"Wed Nov 2 00:00:00 UTC+00:00 2016\",\"Thu Nov 3 00:00:00 UTC+00:00 2016\",\"Fri Nov 4 00:00:00 UTC+00:00 2016\"],\"dates\":[\"2016-10-28T00:00:00\",\"2016-10-31T00:00:00\",\"2016-11-01T00:00:00\",\"2016-11-02T00:00:00\",\"2016-11-03T00:00:00\",\"2016-11-04T00:00:00\"],\"utcDates\":[\"2016-10-28T00:00:00\",\"2016-10-31T00:00:00\",\"2016-11-01T00:00:00\",\"2016-11-02T00:00:00\",\"2016-11-03T00:00:00\",\"2016-11-04T00:00:00\"],\"pos\":[0,0.2,0.4,0.6,0.8,1],\"priorities\":[0.001,0.002,0.003,0.004,0.005,0.006]}},\"Positions\":[0,0.2,0.4,0.6,0.8,1],\"Dates\":[\"2016-10-28T00:00:00\",\"2016-10-31T00:00:00\",\"2016-11-01T00:00:00\",\"2016-11-02T00:00:00\",\"2016-11-03T00:00:00\",\"2016-11-04T00:00:00\"],\"Elements\":[{\"Currency\":\"USD\",\"TimeStamp\":null,\"Symbol\":\"TWTR\",\"Type\":\"price\",\"DataSeries\":{\"close\":{\"min\":17.49,\"max\":18.02,\"maxDate\":\"2016-11-04T00:00:00\",\"minDate\":\"2016-11-01T00:00:00\",\"values\":[17.66,17.95,17.49,17.61,17.58,18.02]}}}]}";
  }
 ?>