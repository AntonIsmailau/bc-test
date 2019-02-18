function  QuoteboardController(quoteboardSvc, $interval) {
  var vm = this;

  vm.newSymbol = '';
  vm.rows = [];

  function getData() {
    quoteboardSvc.getData()
      .then(function(response) {
        vm.rows = response.data.data;
      });
  }

  getData();

  vm.addSymbol = function() {
    quoteboardSvc.addQuote(vm.newSymbol)
      .then(function() {
        getData();
      })
  }

  $interval(() => {
    getData();
  }, 2000);
  
}

app.component('quoteboard', {
  templateUrl: './components/quoteboard/quoteboard.html',
  controller: QuoteboardController,
  controllerAs: 'vm'
})