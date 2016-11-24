(function(document) {
 'use strict';
 
 var LightTableFilter = (function(Arr) {
 
  var _input;
 
  function _onInputEvent(e) {
   _input = e.target;
   var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
   Arr.forEach.call(tables, function(table) {
    Arr.forEach.call(table.tBodies, function(tbody) {
     Arr.forEach.call(tbody.rows, _filter);
    });
   });
  }
 
  function _filter(row) {
   var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
   row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
  }
 
  return {
   init: function() {
    var inputs = document.getElementsByClassName('light-table-filter');
    Arr.forEach.call(inputs, function(input) {
     input.oninput = _onInputEvent;
    });
   }
  };
 })(Array.prototype);
 
 document.addEventListener('readystatechange', function() {
  if (document.readyState === 'complete') {
   LightTableFilter.init();
  }
 });
 
})(document);


Sumber : http://jintoples.blogspot.co.id/2014/08/cara-membuat-tabel-search-dengan.html#ixzz4PmDaWjSA 
Follow us: @jin_toples on Twitter | JinToplesBlogger on Facebook