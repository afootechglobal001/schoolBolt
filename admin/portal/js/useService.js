/// Fetch Service Data ///
// function _fetchServiceData() {
// 	try {
// 		//// call endpoint //////
// 		_callFetchEndPoints({
// 			url: `admin/pages/fetch-page?pageCategory=SERVICE`,
// 			accessKey: true,
// 		})
// 		.then((response) => {
//             _initFetchServiceData(response.data);
// 		 })
// 		.catch((error) => {
// 			_staffValidationCheck(error.response);
// 			console.error("Error:", error);
// 			if (error.status==0) {
// 				_showEmptyState({
// 					container: "servicePageContent",
// 					message: "Check your internet connection and try again",
// 					paginationContainer: "serviceContentPaginationControls",
// 				});
// 				_callAjaxError(() => _fetchServiceData(), error.message); // retry if needed
// 			} else {
// 				_showEmptyState({
// 					container: "servicePageContent",
// 					message: error.message,
// 					button: `
// 						<button class="btn" title="ADD NEW SERVICE" onclick="sessionStorage.removeItem('useEachPageSession'); _getForm({page: 'editPagesForm', pageCategory: 'SERVICE', url: adminPortalMiddlewareUrl});">
// 							<i class="bi-plus-square"></i> ADD NEW SERVICE
// 						</button>
// 					`,
// 					paginationContainer: "serviceContentPaginationControls",
// 				});
// 			}
// 		});
// 	} catch (error) {
// 		console.error("Error:", error);
// 		_callCatchError(() => _fetchServiceData());
//   	}
// }

function _fetchServiceData() {
    const response = {
        data: [
            {
                pageId: "SRV001",
                pageCategory: "SERVICE",
                pageTitle: "Residential",
                seoDescription: "Professional residential HVAC maintenance and repair services to keep your home comfortable.",
                seoFlyer: `service-1.jpeg`,
                updatedTime: "2026-08-04 09:15:22",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                pageId: "SRV002",
                pageCategory: "SERVICE",
                pageTitle: "Corporate",
                seoDescription: "Expert corporate electrical solutions for businesses, ensuring reliable power and efficient operations.",
                seoFlyer: `service-2.jpeg`,
                updatedTime: "2026-08-03 14:30:10",
                statusData: {
                    statusName: "ACTIVE"
                }
            }
        ]
    };

    _initFetchServiceData(response.data);
}
/// Initialize Service Data ///
function _renderServiceData(data) {
  return data.map((item) => `
  	<div class="grid-div">
		<div class="status-div ${item.statusData?.statusName}">${item.statusData?.statusName}</div>
		<div class="img-div">
			<img src="${servicePixPath}/${item.seoFlyer}" alt="${item.pageTitle}" />
		</div>

		<div class="text-div">
			<div class="text-in">
				<div class="text">UPDATED ON: <span>${_fetchFormatDate(item.updatedTime)}</span></div>
			</div>
			<h2 title="Edit Service" onclick="_fetchEachPageContent('${item.pageCategory}', '${item.pageId}');">${item.pageTitle}</h2>
			<p>${item.seoDescription}</p>  
		</div>
	</div>`).join("");
}

//// Initialize Service Data Pagination ////
function _initFetchServiceData(data) {
  const paginator = new Paginator(
    data,
    _renderServiceData,
    "serviceContentPaginationControls",
    "servicePageContent",
    8
  );
  __paginatorHandlers["serviceContentPaginationControls"] = paginator;
  paginator.renderPage();
}

//// Filter Service Data ////
function _filtersService(value) {
  $("#servicePageContent .grid-div").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}