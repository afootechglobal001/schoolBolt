class Paginator {
  constructor(
    data,
    renderTableFn,
    paginationContainerId,
    tableBodyId,
    itemsPerPage = 10
  ) {
    this.data = data;
    this.renderTableFn = renderTableFn;
    this.paginationContainer = document.getElementById(paginationContainerId);
    this.tableBody = document.getElementById(tableBodyId);
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
  }

  renderPage() {
    const start = (this.currentPage - 1) * this.itemsPerPage;
    const end = start + this.itemsPerPage;
    const paginatedData = this.data.slice(start, end);

    this.tableBody.innerHTML = this.renderTableFn(paginatedData, start);
    this.renderPaginationControls();
  }

  renderPaginationControls() {
    const totalPages = Math.ceil(this.data.length / this.itemsPerPage);
    let paginationHtml = `<ul class="pagination-ul">`;

    // Prev
    paginationHtml += `
      <li>
        <button onclick="${this.getHandlerName()}(${this.currentPage - 1})"
          ${this.currentPage === 1 ? "disabled" : ""}>Prev</button>
      </li>`;

    const maxVisible = 1; // how many pages to show around current
    let startPage = Math.max(2, this.currentPage - maxVisible);
    let endPage = Math.min(totalPages - 1, this.currentPage + maxVisible);

    // Always show first page
    paginationHtml += `
      <li>
        <button class="${this.currentPage === 1 ? "active" : ""}"
          onclick="${this.getHandlerName()}(1)">1</button>
      </li>`;

    // Ellipsis if needed
    if (startPage > 2) {
      paginationHtml += `<li><span>...</span></li>`;
    }

    // Pages in the middle
    for (let i = startPage; i <= endPage; i++) {
      paginationHtml += `
        <li>
          <button class="${i === this.currentPage ? "active" : ""}"
            onclick="${this.getHandlerName()}(${i})">${i}</button>
        </li>`;
    }

    // Ellipsis if needed
    if (endPage < totalPages - 1) {
      paginationHtml += `<li><span>...</span></li>`;
    }

    // Always show last page
    if (totalPages > 1) {
      paginationHtml += `
        <li>
          <button class="${this.currentPage === totalPages ? "active" : ""}"
            onclick="${this.getHandlerName()}(${totalPages})">${totalPages}</button>
        </li>`;
    }

    // Next
    paginationHtml += `
      <li>
        <button onclick="${this.getHandlerName()}(${this.currentPage + 1})"
          ${this.currentPage === totalPages ? "disabled" : ""}>Next</button>
      </li>`;

    paginationHtml += `</ul>`;
    this.paginationContainer.innerHTML = paginationHtml;
  }

  changePage(page) {
    const totalPages = Math.ceil(this.data.length / this.itemsPerPage);
    if (page < 1 || page > totalPages) return;
    this.currentPage = page;
    this.renderPage();
  }

  getHandlerName() {
    return `__paginatorHandlers['${this.tableBody.id}'].changePage`;
  }
}

// Global object to store multiple paginator instances
window.__paginatorHandlers = {};
