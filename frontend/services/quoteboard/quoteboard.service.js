app.service('quoteboardSvc', function($http) {
    this.getData = function() {
        return $http.get('http://127.0.0.1:8000/api/quotes/rand');
    }
    this.addQuote = function(symbol) {
        return $http.post('http://127.0.0.1:8000/api/quotes/save', { symbol })
    }
})