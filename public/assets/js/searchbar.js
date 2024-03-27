function accountSearch() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("accountsTable");
    tr = table.getElementsByTagName("tr");
  
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
  
      // check if any cell in the row contains the filter
      var rowContainsFilter = Array.from(td).some(function(cell) {
        txtValue = cell.textContent || cell.innerText;
        return txtValue.toUpperCase().indexOf(filter) > -1;
      });
  
      tr[i].style.display = rowContainsFilter ? "" : "none";
    }
  }
  
  