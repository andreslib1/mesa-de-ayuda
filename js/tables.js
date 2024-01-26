
  function truncateTableCell(elementId, limit) {
    var tableCell = document.getElementById(elementId);
    var originalText = tableCell.textContent;

    if (originalText.length > limit) {
      tableCell.textContent = originalText.substring(0, limit) + "...";
    }
  }


  truncateTableCell("limitar_texto", 10);