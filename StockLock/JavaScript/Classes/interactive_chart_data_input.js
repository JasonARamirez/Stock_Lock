function InteractiveChartDataInput(NumberOfDays, DataPeriod, LabelPeriod, Elements) {
    this.Normalized = false;
    this.NumberOfDays = NumberOfDays;
    this.DataPeriod = DataPeriod;
    this.LabelPeriod = LabelPeriod;
    this.Elements = Elements;
}

function Element(Symbol){
  this.Symbol = Symbol;
  this.Type = "price";
  this.Params = ["c"];
}
